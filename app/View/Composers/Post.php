<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
        'partials.content',
        'partials.content-*',
        'partials.static-authors',
        'single',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => $this->title(),
            'contributor' => $this->contributor(),
            'postCategories' => $this::postCategories(),
            'staticContributors' => $this->staticContributors(),
            'relatedPosts' => $this->relatedSymposiaPosts() ? $this->relatedSymposiaPosts() : $this->relatedPosts(),
            'conference_symposia' => self::$conferencePost,
            'related_symposia_posts' => false,
            'eventStartDate' => $this->niceFormatEventStart(),
        ];
    }

    public static $conferencePost;

    public function __construct()
    {
        if (is_numeric(get_the_ID()) && function_exists('get_field')) {
            $symposia = get_the_terms(get_the_ID(), 'symposia');

            $conferenceValues = collect($symposia)->map(function ($symposium) {
                if (get_field('conference_year', $symposium)) {
                    return $symposium;
                }
            })->reject(function ($symposium) {
                return empty($symposium);
            });

            if (count($conferenceValues) > 0) {
                $postsInThisSymposium = count(get_posts(['symposia' => $conferenceValues->first()->slug]));
                self::$conferencePost =
                    (object)[
                        'slug' => $conferenceValues->first()->slug,
                        'name' => $conferenceValues->first()->name,
                        'term_id' => $conferenceValues->first()->term_id,
                        'count' => $postsInThisSymposium ];
            }
        }
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function title()
    {
        if ($this->view->name() !== 'partials.page-header') {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Latest Posts', 'sage');
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf(
                /* translators: %s is replaced with the search query */
                __('Search Results for %s', 'sage'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }

    /**
     * 
     */

     public function homeBase() 
     {
        if (!function_exists('get_field')) {
            return false;
        }

        return get_post_meta( get_the_ID(), 'home_base', true);
     }

    /**
     * Are there any contributors available here?
     */

     public function contributor()
     {
         if (!function_exists('get_field')) {
             return false;
         }
 
         $contributors = [];
 
         $contributorsInArticle = get_field('_author', get_the_ID());
             if(is_array($contributorsInArticle)) {
                 foreach ($contributorsInArticle as $contributorID) {
                     $contributors[] = (object)[
                         'name' => get_the_title($contributorID),
                         'url' => get_permalink($contributorID),
                     ];
                 }
 
                 return $contributors;
             }
 
         return false;
     }

    public function staticContributors() {

        if (!function_exists('get_field')) {
            return false;
        }

        $contributors = [];

        $contributorsInArticle = get_field('_author', $this->data['static_post_id'] ? $this->data['static_post_id'] : get_the_ID());
            if(is_array($contributorsInArticle)) {
                foreach ($contributorsInArticle as $contributorID) {
                    setup_postdata($contributorID);
                    $contributors[] = (object)[
                        'name' => get_the_title($contributorID),
                        'url' => get_permalink($contributorID),
                        'excerpt' => get_the_content( $contributorID ),
                    ];
                    wp_reset_postdata();
                }

                return $contributors;
            }

        return false;
    }

    /**
    * Return a Laravel collection of categories that a post belongs to.
    * @return object
    */

    public static function postCategories()
    {
        if (is_archive()) {
            // no category output inside archive pages
            return false;
        } else {
            $categories = collect(get_the_category())->filter(
                function ($category) {
                    return $category->slug !== 'uncategorized';
                }
            )
        ->map(function ($category) {
            $lpeCategory = (object) [
             'name' => $category->name,
             'slug' => $category->slug,
             'link' => home_url('/') . $category->taxonomy . '/' . $category->slug
           ];
            return $lpeCategory;
        });

            wp_reset_postdata();

            return $categories->isEmpty() ? false : $categories;
        }
    }
 
    public function relatedPosts()
    {
        if (isset(self::$conferencePost->slug)) {
            return false;
        }

        if (get_post_type() == 'amri_course') {
            return false;
        }

        $category_selection = collect(self::postCategories())->first();

        $cat_string = (!empty($category_selection->slug)) ? $category_selection->slug : false;

        $cat_items = get_category(get_cat_ID($cat_string));

        $args = [
            'post_type' => 'post',
            'posts_per_page' => '15',
            'offset'        => '1',
            'post_status' => 'publish',
            'orderby'     => 'date',
            'order'       => 'DESC'
        ];

        // make sure we have at least three posts in the same category
        // otherwise don't restrict query to same category
        if ($cat_items->count > 3) {
            $args['category'] = $cat_string;
        }

        $relatedPostQuery = new WP_Query($args);
        $relatedPosts = $relatedPostQuery->posts;

        return collect($relatedPosts)->map(function ($post) {
            setup_postdata($post);
            $filler_image = \App\filler_image();

            $related_post = (object) [
                'title' => wp_trim_words(get_the_title($post), 11, '...'),
                'img_url' => get_the_post_thumbnail_url($post->ID, 'w450') ? get_the_post_thumbnail_url($post->ID, 'w450') : $filler_image['sizes']['w450'],
                'url' => get_permalink($post),
                'alt' => get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) ?
                         get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) : false,
                'id'=> $post->ID,
            ];

            wp_reset_postdata();
            return $related_post;
        })->shuffle()->take(3);
    }

    public function niceFormatEventStart() {
        if (!get_post_type(get_the_id()) === 'event') {
            return false;
        }

        $eventStartDate = get_field('event_start_date') ? get_field('event_start_date') : '';
        if ( $eventStartDate ) {
            $eventStartDate = \DateTime::createFromFormat( 'm/d/Y', $eventStartDate )->format('M j, Y');
        }

        return $eventStartDate;
    }

    public function relatedSymposiaPosts()
    {
        // first check if this post belongs to a symposium
        if (!isset(self::$conferencePost->slug)) {
            return false;
        }

        // check that we have ACF
        if (!function_exists('get_field')) {
            return false;
        }

        $postsInSymposium = count(get_posts(['symposia' => self::$conferencePost->slug]));

        $confSymposia = [];
        $allSymposia = get_terms('symposia');

        foreach ($allSymposia as $symposium) {
            if (get_field('conference_year', $symposium)) {
                $confSymposia[] = $symposium->slug;
            }
        }
        
        $exclude = get_the_ID();

        $args = [
            'post_type' => 'post',
            'post__not_in'  => array($exclude),
            'posts_per_page' => '15',
            'post_status' => 'publish',
            'orderby'     => 'date',
            'order'       => 'DESC',
        ];

        if ($postsInSymposium >= 2) {
            $args['symposia'] = self::$conferencePost->slug;
        } else {
            $args['symposia'] = $confSymposia;
        }

        $relatedSymposiaQuery = new \WP_Query($args);
        $relatedSymposiaPosts = $relatedSymposiaQuery->posts;

        return collect($relatedSymposiaPosts)->map(function ($post) {
            setup_postdata($post);

            $related_post = (object) [
                'title' => get_the_title($post),
                'img_url' =>  \App\filler_image('thumb')['url'],
                'url' => get_permalink($post),
                'alt' => false,
                'id'=> $post->ID
            ];

            wp_reset_postdata();
            return $related_post;
        });
    }

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'homeBase' => $this->homeBase(),
        ];
    }
}
