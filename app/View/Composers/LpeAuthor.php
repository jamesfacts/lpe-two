<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class LpeAuthor extends Composer
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

    public function lpeAuthorWork()
    {
        $paged = get_query_var('work') ?? 1;
        $args = [
            'post_type' => ['post'],
            'post_status' => 'publish',
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

        $author_work = new WP_Query($args);
        
        if ($author_work->post_count > 0) {

            // need to pass this to the navigation class
            self::$max_pages = $author_work->max_num_pages;
            
            return collect($author_work->posts)->map(function ($lpe_author_post) {
                setup_postdata($lpe_author_post);
                $lpe_author_post = (object) [
                    'title' => get_the_title($lpe_author_post),
                    'url' => get_permalink($lpe_author_post),
                    'img_url' => get_the_post_thumbnail_url($lpe_author_post->ID, 'w450')
                                ? get_the_post_thumbnail_url($lpe_author_post->ID, 'w450')
                                            : \App\filler_image()['url'],
                    'alt' => get_post_meta(get_post_thumbnail_id($lpe_author_post->ID), '_wp_attachment_image_alt', true),
                    'excerpt' => get_the_excerpt($lpe_author_post),
                    'post_id' => $lpe_author_post->ID
                ];
                wp_reset_postdata();
                return $lpe_author_post;
            });
        } else {
            return false;
        }
    }
    
    public function lpeAuthorWorkNav()
    {
        $paged = get_query_var('work') ? intval(get_query_var('work')) : 1;
        $nav = (object)[];

        if (self::$max_pages > 1) {
            if ($paged < self::$max_pages) { // we're not at the final page
                $nav->previous = trailingslashit(get_post_permalink(get_the_ID()) . 'work/' . ($paged + 1));
                $nav->next = false;
            }
            if ($paged > 1) {
                if ($paged === 2) {
                    $nav->next = get_permalink(get_the_ID());
                } else {
                    $nav->next = trailingslashit(get_post_permalink(get_the_ID()) . 'work/' . ($paged - 1));
                }
            }
            return $nav;
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
            'lpeAuthorWork' => $this->lpeAuthorWork(),
            'lpeAuthorWorkNav' => $this->lpeAuthorWorkNav(),
        ];
    }
}
