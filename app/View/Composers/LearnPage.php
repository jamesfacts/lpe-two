<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class LearnPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-learn',
    ];
    
    public static $lpeFeaturedVideoId;

    public static $lpeFeaturedVideo;

    public static $lpeVideoCollection;

    public function __construct()
    {
        $videoArgs = [
        'post_type' => ['lpe_video'],
        'posts_per_page'    => '250',
        'post_status' => 'publish',
        'orderby'     => 'date',
        'order'       => 'DESC'
      ];

        $allVideos = new \WP_Query($videoArgs);
        $allVideoPosts = $allVideos->posts;

        if (count($allVideoPosts) > 0) {
            self::$lpeVideoCollection = collect($allVideoPosts)->map(function ($post) {
                setup_postdata($post);
                $featured_value = false;

                if (function_exists('get_field') && get_field('main_featured_video', $post->ID)) {
                    $featured_value = true;
                }

                //only set the featured video if there is no featured vid already
                if (empty(self::$lpeFeaturedVideoId) && $featured_value) {
                    self::$lpeFeaturedVideoId = $post->ID;
                }

                $lpe_video = (object) [
              'name' => get_the_title($post),
              'url' => get_post_meta($post->ID, '_youtube_url', true)
                      ? get_post_meta($post->ID, '_youtube_url', true) :
                      home_url('/videos'),
              'alt' => get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) ?
                      get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) : get_the_title($post),
              'img_url' => get_the_post_thumbnail_url($post->ID, 'w450') ?
                           get_the_post_thumbnail_url($post->ID, 'w450') : \App\filler_image(),
              'subtitle' => get_post_meta($post->ID, '_subtitle', true),
              'excerpt' => get_the_excerpt($post),
              'ID' => $post->ID
            ];
                wp_reset_postdata();
                return $lpe_video;
            });
        }

        if (self::$lpeFeaturedVideoId) {
            self::$lpeFeaturedVideo = self::$lpeVideoCollection->filter(function ($video) {
                return $video->ID === self::$lpeFeaturedVideoId;
            })->first();
        } else {
            self::$lpeFeaturedVideo = self::$lpeVideoCollection->first();
        }
    }

    /**
    * Return a Laravel collection of syllabi posts (if any)
    * @return object
    */
    public function getSyllabiPosts()
    {
        return collect(get_posts([
            'post_type' => 'syllabi',
            'numberposts' => '6',
            'post_status' => 'publish'
          ]))->map(function ($post) {
              setup_postdata($post);

              $syllabi = (object) [
              'name' => get_the_title($post->ID),
              'url' => get_the_permalink($post->ID),
              'img_url' => get_the_post_thumbnail_url($post->ID, 'w450'),
              'excerpt' => get_the_excerpt($post),
              'professor' => get_post_meta($post->ID, 'syllabus_professor', true),
              'school' => get_post_meta($post->ID, 'syllabus_school', true),
              'download_url' => get_field('syllabus_attachment', $post->ID)
            ];
              wp_reset_postdata();
              return $syllabi;
          });
    }

    /**
    * Return a Laravel collection of primer posts (if any)
    * @return object
    */
    public function getPrimerPosts()
    {
        return collect(get_posts([
            'post_type' => 'primers',
            'numberposts' => '6',
            'post_status' => 'publish'
          ]))->map(function ($post) {
              setup_postdata($post);

              $primer = (object) [
              'name' => get_the_title($post->ID),
              'url' => get_the_permalink($post->ID),
              'img_url' => get_the_post_thumbnail_url($post->ID, 'w450'),
              'excerpt' => get_the_excerpt($post),
              'professor' => get_post_meta($post->ID, 'syllabus_professor', true),
              'school' => get_post_meta($post->ID, 'syllabus_school', true),
              'download_url' => get_field('syllabus_attachment', $post->ID)
            ];
              wp_reset_postdata();
              return $primer;
          });
    }

    public function getLpeVideos()
    {
        // always return the
        if (self::$lpeFeaturedVideoId) {
            return self::$lpeVideoCollection->reject(function ($video) {
                return $video->ID === self::$lpeFeaturedVideoId;
            })->take(3);
        } else {
            // if no post is featured... the first post goes in the featured slot
            return self::$lpeVideoCollection->slice(1)->take(3);
        }
    }

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'lpeFeaturedVideo' => self::$lpeFeaturedVideo ?? false,
            'lpeVideos' => $this->getLpeVideos(),
            'lpeSyllabi' => $this->getSyllabiPosts(),
            'primerPosts' => $this->getPrimerPosts(),
        ];
    }
}
