<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'front-page'
    ];

    /**
     * URL from customizer for the big hero image on homepage
     * @return string
     */

     public function getHero()
     { 
         if(function_exists('get_field') && get_field('lpe_hero_image')) {
            $hero = get_field('lpe_hero_image');

            if( is_array( $hero ) ) {
                return (object) [
                    'url' => $hero['url'],
                    'alt' => $hero['alt']
                ];
            }
        }
 
         // Always return
         return false;
     }


     public function pageBlurbs()
     {
        if(function_exists('get_field')) {
            return collect([
                (object)['title' => 'Learn', 'text' => get_field('learn_blurb') ],
                (object)['title' => 'Engage', 'text' => get_field('engage_blurb')],
                (object)['title' => 'Events', 'text' => get_field('events_blurb')],
            ]);
        }
 
         // Always return
         return false;
     }

    /**
     * Return set of objects representing blog posts for the homepage
     * @return array
     */

    public function blogFeed()
    {
        return collect(get_posts([
            'post_type' => ['post', 'lpe_event'],
            'numberposts' => '4',
            'post_status' => 'publish',
            'orderby'     => 'date',
            'order'       => 'DESC',
        ]))->map(function ($post) {
            setup_postdata($post);
            $blog_post = (object) [
                'title' => wp_trim_words(get_the_title($post), 11, '...'),
                'post_id' => $post->ID,
                'img_url' => get_the_post_thumbnail_url($post->ID, 'w450')
                             ? get_the_post_thumbnail_url($post->ID, 'w450')
                             : \App\filler_image(),
                'alt' =>    get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) ?
                            get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) : get_the_title($post),
                'url' => get_permalink($post),
                'content_type' => (get_post_type($post) === 'post' ? 'article' : 'event'),
                'excerpt' => get_the_excerpt($post)
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
            'frontHero' => $this->getHero(),
            'blogFeed' => $this->blogFeed(),
            'pageBlurbs' => $this->pageBlurbs(),
        ];
    }
}
