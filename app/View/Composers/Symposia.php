<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class Symposia extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'page-symposia',
    ];

    public static $max_pages;

    public function fetchSymposia()
    {
        $paged = get_query_var('work') ?? 1;

        // return get_terms('symposia');

        $symposia = collect(get_terms('symposia'))->map(function($symposia_term) {

            $args = [
                'post_status'       => 'publish',
                'posts_per_page' => 1,
                'tax_query' => [
                    [ 
                        'taxonomy' => 'symposia',
                        'field' => 'slug',
                        'terms' => $symposia_term->slug,
                    ],
                ],   
                'order'             => 'DESC',
            ];

            wp_reset_query();
            $newestQuery = new WP_Query($args);
            $newestPost = $newestQuery->posts;
            $newestDate = $newestPost[0]->post_date;
            $dateObj = \DateTime::createFromFormat( 'Y-m-d H:i:s', $newestDate );


            $symposia_term = (object)[
                'title' => $symposia_term->name,
                'url' => home_url('/symposia') . '/' . $symposia_term->slug,
                'excerpt' => 'Why focus on what we call law and political economy, and why now? In the last decade, inequality has become impossible to ignore.',
                'newest_post' => $dateObj->format('F Y'),
                'term_date' => '',
            ];
            return $symposia_term;
        });



        return $symposia;
        
    }

     public function getSymposia()
     {
        $symposia = get_terms('symposia');

        return $symposia;
     }

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'allSymposia' => $this->fetchSymposia(),
        ];
    }
}
