<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class SingleLpe_author extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'single-lpe_author'
    ];

    public static $max_pages;

    public function contributorWork()
    {
        $paged = get_query_var('work') ?? 1;
        $args = [
            'post_type' => ['post'],
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'order' => 'DESC',
            'orderby' => 'post_date',
            'posts_per_page' => 6,
            'paged' => $paged,
            'meta_query' => [
              'relation' => 'OR',
              [
                'key' => '_author',
                'value' => '"' . get_the_ID() . '"',
                'compare' => 'LIKE'
              ], [
                'key' => '_author',
                'value' => get_the_ID(),
                'compare' => '='
              ]
            ]
          ];

        $contributor_work = new WP_Query($args);

        if ($contributor_work->post_count > 0) {

            // need to pass this to the navigation class
            self::$max_pages = $contributor_work->max_num_pages;

            return collect($contributor_work->posts)->map(function ($post) {
                setup_postdata($post);
                $contributor_post = (object) [
                    'title' => get_the_title($post),
                    'url' => get_permalink($post),
                    'img_url' => get_the_post_thumbnail_url($post->ID, 'w450')
                                ? get_the_post_thumbnail_url($post->ID, 'w450')
                                            : \App\filler_image(),
                    'alt' => get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true),
                    'excerpt' => get_the_excerpt($post),
                    'post_id' => $post->ID
                ];
                wp_reset_postdata();
                return $contributor_post;
            });
        } else {
            return false;
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
            'hello' => 'world',
            'contributorWork' => $this->contributorWork(),
        ];
    }
}
