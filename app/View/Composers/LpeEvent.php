<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class LpeEvent extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'archive-lpe_event'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'upcomingEvents' => $this->getUpcomingEvents(),
            'featuredEvents' => self::$featuredEvents,
            'pastEvents' => $this->getPastEvents(),
            'pastEventUrl' => home_url('/events/page/2'),
        ];
    }

    public static $featuredEventExclusion = [];

    public static $featuredEvents;

    public function __construct()
    {
        $featuredArgs = [
            'post_status' => 'publish',
                    'post_type' => ['lpe_event'],
                    'posts_per_page' => '-1',
                    'meta_query' => [
                        ['key' => 'featured_event', 'value' => '1']],
                ];

        $featuredEvents = new WP_Query($featuredArgs);
        
        $allFeaturedEvents = collect($featuredEvents->posts)->map(function ($post) {
            setup_postdata($post);

            $future_candidate = false;
            $modified_date_wp = get_the_modified_date('m/d/Y', $post->ID);
            $modified_date = \DateTime::createFromFormat('m/d/Y', $modified_date_wp)->format('U');

            // now we need to start boiling down our results to see what qualifies

            // if an ongoing event has not ended, it is certainly a candidate
            if (get_field('event_end_date', $post->ID)) {
                $end_date_utc = \DateTime::createFromFormat('m/d/Y', get_field('event_end_date', $post->ID))->format('U');
                if ((\App\future_date($end_date_utc)) && (get_field('ongoing_event', $post->ID))) {
                    $future_candidate = true;
                }
            }
            
            if (get_field('event_start_date', $post->ID)) {
                $start_date_utc = \DateTime::createFromFormat('m/d/Y', get_field('event_start_date', $post->ID))->format('U');
                if (\App\future_date($start_date_utc)) {
                    $future_candidate = true;
                }
            }

            $eventStartDate = get_field('event_start_date', $post->ID) ? get_field('event_start_date', $post->ID) : '';
            if ( $eventStartDate ) {
                $eventStartDate = \DateTime::createFromFormat( 'm/d/Y', $eventStartDate )->format('M j, Y');
            }

            $featured_event = (object) [
                    'title' => get_the_title($post),
                    'url' => get_permalink($post),
                    'img_url' => get_the_post_thumbnail_url($post->ID, 'w680')
                                ? get_the_post_thumbnail_url($post->ID, 'w680')
                                                    : \App\filler_image(),
                    'alt' => get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) ?
                             get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) : get_the_title($post),
                    'event_end_date' => get_field('event_end_date', $post->ID) ? get_field('event_end_date', $post->ID) : '',
                    'event_start_date' => $eventStartDate,
                    'event_time' => get_field('event_time', $post->ID) ? get_field('event_time', $post->ID) : '',
                    'event_day_of_the_week' => get_field('event_day_of_the_week', $post->ID) ? get_field('event_day_of_the_week', $post->ID) : '',
                    'venue_title' => get_field('venue_title', $post->ID) ? get_field('venue_title', $post->ID) : '',
                    'venue_street_address' => get_field('venue_street_address', $post->ID) ? get_field('venue_street_address', $post->ID) : '',
                    'venue_city_state' => get_field('venue_city_state', $post->ID) ? get_field('venue_city_state', $post->ID) : '',
                    'excerpt' => get_the_excerpt($post),
                    'ongoing_event' => get_field('ongoing_event', $post->ID) ? get_field('ongoing_event', $post->ID) : '',
                    'updated_time' => $modified_date,
                    'future_candidate' => $future_candidate,
                    'ID' => $post->ID
                ];

            wp_reset_postdata();
            return $featured_event;
        })->filter(function ($event) {
            return $event->future_candidate;
        })->sortByDesc('updated_time');

        self::$featuredEvents = $allFeaturedEvents->take(2);
        
        foreach (self::$featuredEvents as $event) {
            self::$featuredEventExclusion[] = $event->ID;
        }
    }

    public function getFeaturedEvents()
    {
        // just tryna be explicit about what happened in the controller
        if (count(self::$featuredEvents) < 0) {
            return false;
        }

        return self::$featuredEvents;
    }

    public function getUpcomingEvents()
    {
        $args = [
            'post_status'       => 'publish',
            'post_type'         => ['lpe_event'],
            'posts_per_page'    => '3',
            'post__not_in'      => self::$featuredEventExclusion,
            'orderby'           => 'meta_value_num',
            'order'             => 'ASC',
            'meta_query'        => [
                ['key'       => 'event_start_date',
                 'compare'   => '>=',
                 'value'     => (intval(date('Ymd')) - 1),
                 'type'      => 'numeric']
            ]
        ];

        $upcomingEvents = new WP_Query($args);

        return collect($upcomingEvents->posts)->map(function ($post) {
            setup_postdata($post);

            $eventStartDate = get_field('event_start_date', $post->ID) ? get_field('event_start_date', $post->ID) : '';
            if ( $eventStartDate ) {
                $eventStartDate = \DateTime::createFromFormat( 'm/d/Y', $eventStartDate )->format('M j, Y');
            }

            $upcoming_event = (object) [
                    'title' => get_the_title($post),
                    'url' => get_permalink($post),
                    'img_url' => get_the_post_thumbnail_url($post->ID, 'w680')
                                ? get_the_post_thumbnail_url($post->ID, 'w680')
                                                    : null,
                    'alt' => get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) ?
                             get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) : get_the_title($post),

                    'event_end_date' => get_field('event_end_date', $post->ID),
                    'event_start_date' => $eventStartDate,
                    'event_time' => get_field('event_time', $post->ID),
                    'event_day_of_the_week' => get_field('event_day_of_the_week', $post->ID),
                    'venue_title' => get_field('venue_title', $post->ID),
                    'venue_street_address' => get_field('venue_street_address', $post->ID),
                    'venue_city_state' => get_field('venue_city_state', $post->ID),
                    'excerpt' => get_the_excerpt($post),
                    'ID' => $post->ID
                     ];

            wp_reset_postdata();
            return $upcoming_event;
        });
    }

    public function getPastEvents()
    {
        $args = [
            'post_status'       => 'publish',
            'post_type'         => ['lpe_event'],
            'posts_per_page'    => '6',
            'orderby'           => 'meta_value_num',
            'order'             => 'DESC',
            'meta_query'        => [
                ['key'       => 'event_start_date',
                 'compare'   => '<',
                 'value'     => (intval(date('Ymd')) - 1),
                 'type'      => 'numeric']
            ]
        ];

        $pastEvents = new WP_Query($args);

        return collect($pastEvents->posts)->map(function ($post) {
            setup_postdata($post);
            $past_event = (object) [
                    'title' => get_the_title($post),
                    'url' => get_permalink($post),
                    'img_url' => get_the_post_thumbnail_url($post->ID, 'w450')
                                ? get_the_post_thumbnail_url($post->ID, 'w450')
                                                    : \App\filler_image()["url"],
                    'alt' => get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) ?
                             get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) : get_the_title($post),
                    'event_start_date' => get_field('event_start_date', $post->ID),
                    'event_end_date' => get_field('event_end_date', $post->ID),
                    'venue_title' => get_field('venue_title', $post->ID),
                    'excerpt' => get_the_excerpt($post),
                    'ID' => $post->ID
                     ];
        
            wp_reset_postdata();
            return $past_event;
        });
    }
}
