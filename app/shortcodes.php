<?php

namespace App;

use App\Controllers\App;

/**
 * Return if Shortcodes already exists.
 */
if (class_exists('Shortcodes')) {
    return;
}

/**
 * Shortcodes
 */
class Shortcodes
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $shortcodes = [
            'event_newsletter',
            'content_category_dropdown',
            'content_topic_dropdown',
            'author_search_dropdown',
            'symposia_taxonomy_dropdown',
            'day',
            'year',
            'masthead'
        ];

        return collect($shortcodes)
            ->map(function ($shortcode) {
                return add_shortcode($shortcode, [$this, strtr($shortcode, ['-' => '_'])]);
            });
    }

    /**
     * Event newsletter signup form
     * Insert a newsletter form specific to the events list
     *
     */

    public function event_newsletter($atts)
    {
        $atts = shortcode_atts(
            ['hed' => ''],
            $atts
        );

        $html = \App\template('partials.events-mailpoet', ['hed' => $atts['hed']]);

        return $html;
    }

    /**
     * Content Category Dropdown
     * Returns a Bootstrap <div> dropdown with all categories (except
     * 'uncategorized') that have at least three posts
     *
     * @param  array  $atts
     * @return string
     */
    public function content_category_dropdown($atts)
    {
        $atts = shortcode_atts(
            ['default_hed' => 'Content Type'],
            $atts
        );
        $args = ['taxonomy' => 'category'];

        $categories = get_terms($args);
        // minimum posts in category to display category
        $min_count = 3;

        $html = '<div class="dropdown">';
        $html .= '<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $html .= $atts['default_hed'];
        $html .= '</button>';
        $html .= ' <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonCategory">';

        foreach ($categories as $category):
         if (($category->count > $min_count) && ($category->slug !== "uncategorized")) {
             $html .='<a class="dropdown-item" href="' . home_url('/') . $category->taxonomy . '/' . $category->slug . '">' . $category->name . '</a>';
         }
        endforeach;

        $html .= '</div></div>';

        return $html;
    }

    /**
     * Content Topic Dropdown
     * Returns a Bootstrap <div> dropdown with all topics that meet a min
     * post count condition
     *
     * @param  array  $atts
     * @return string
     */
    public function content_topic_dropdown($atts)
    {
        $atts = shortcode_atts(
            ['default_hed' => 'Topic'],
            $atts
        );
        $args = ['taxonomy' => 'post_tag'];

        $topics = get_terms($args);
        // minimum posts in category to display category
        $min_count = 5;

        $html = '<div class="dropdown">';
        $html .= '<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonTopics" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $html .= $atts['default_hed'];
        $html .= '</button>';
        $html .= ' <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonTopics">';

        foreach ($topics as $topic):
        if (($topic->count > $min_count)) {
            $html .='<a class="dropdown-item" href="' . home_url('/topics/') . $topic->slug . '">' . $topic->name . '</a>';
        }
        endforeach;

        $html .= '</div></div>';

        return $html;
    }

    /**
     * Symposia taxonomy Dropdown
     * Returns a Bootstrap <div> dropdown with all symposia that meet a min
     * post count condition
     *
     * @param  array  $atts
     * @return string
     */
    public function symposia_taxonomy_dropdown($atts)
    {
        $atts = shortcode_atts(
            ['default_hed' => 'Symposia'],
            $atts
        );
        $args = ['taxonomy' => 'symposia'];

        $symposia = get_terms($args);
        // minimum posts in category to display category
        $min_count = 0;

        $html = '<div class="dropdown">';
        $html .= '<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonSymposia" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $html .= $atts['default_hed'];
        $html .= '</button>';
        $html .= ' <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSymposia">';

        foreach ($symposia as $symposium):
        if (($symposium->count > $min_count)) {
            $html .='<a class="dropdown-item" href="' . home_url('/symposia/') . $symposium->slug . '">' . $symposium->name . '</a>';
        }
        endforeach;

        $html .= '</div></div>';

        return $html;
    }

    /**
    * LPE Author Ajax Dropdown
    * Returns a Bootstrap Dropdown combined with an input targeting a custom
    * WP API route to query for LPE authors.
    *
    * @param  array  $atts
    * @return string
    */

    public function author_search_dropdown($atts)
    {
        $atts = shortcode_atts(
            ['results_count' => 5],
            $atts
        );

        $html = '<div class="input-group dropdown">';
        $html .= '<input type="text" class="form-control" placeholder="Search for an author" aria-label="Search for an author" name="s" data-action="' . home_url('/') . '" id="author-search">';
        $html .= '<div class="input-group-append"><span class="dropdown-menu">';
        $html .= '&nbsp;</span></div>';
        $html .= '<ul class="dropdown-menu author-results" id="authorSearchList" aria-labelledby="author-search">';
        $html .= '</ul></div>';

        return $html;
    }

    /**
    * Masthead
    * Inserts a block that outputs the masthead module
    *
    * @param  array  $atts
    * @param  string $content
    * @return string
    */
    public function masthead($atts, $content = null)
    {
        $atts = shortcode_atts(
            ['hed' => 'LPE Masthead'],
            $atts
        );

        // https://discourse.roots.io/t/filter-get-search-form-to-return-sage-10-view/24051/2
        $html = \App\template('partials.masthead', ['hed' => $atts['hed']]);

        return $html;
    }

    /**
    * Day
    * Returns the current day.
    *
    * @param  array  $atts
    * @param  string $content
    * @return string
    */
    public function day($atts, $content = null)
    {
        return date('d');
    }

    /**
     * Year
     * Returns the current year.
     *
     * @param  array  $atts
     * @param  string $content
     * @return string
     */
    public function year($atts, $content = null)
    {
        return date('Y');
    }
}

new Shortcodes();
