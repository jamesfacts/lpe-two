<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Home extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'home',
    ];

    public function homeFeaturedBlog()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        $featuredPost = get_posts([
            'post_status' => 'publish',
            'post_type' => ['post'],
            'numberposts' => '1',
            'order_by' => 'date',
            'meta_query' => [
                ['key' => 'allow_featured', 'value' => 1] ]
            ]);

            // 'authors' => App::postAuthors(),

        return collect($featuredPost)->map(function ($post) {
                setup_postdata($post);

                $contributors = [];
                $contributorsInArticle = get_field('_author', $post->ID);

                if(is_array($contributorsInArticle)) {
                    foreach ($contributorsInArticle as $contributorID) {
                        $contributors[] = (object)[
                            'name' => get_the_title($contributorID),
                            'url' => get_permalink($contributorID),
                        ];
                    }
                }

                $blog_post = (object) [
                    'title' => get_the_title($post),
                    'url' => get_permalink($post),
                    'img_url' => get_the_post_thumbnail_url($post->ID, 'w680')
                                ? get_the_post_thumbnail_url($post->ID, 'w680')
                                                    : \App\filler_image(),
                    'image_alt' => get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true),
                    'authors' => $contributors,
                    'excerpt' => get_field('featured_post_excerpt', $post->ID) ?
                                 get_field('featured_post_excerpt', $post->ID) : get_the_excerpt($post),
                    'post_id' => $post->ID
                ];
                wp_reset_postdata();
                return $blog_post;
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
            'homeFeaturedBlog' => $this->homeFeaturedBlog(),
        ];
    }
}
