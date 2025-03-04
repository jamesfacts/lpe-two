<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Masthead extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'home',
    ];

    /**
    * Return a Laravel collection of authors (if any)
    * that match a certain category type
    *         'editorial_board' => ' Editorial Board',
    *         'managing_editor' => 'Managing Editor',
    *         'student_editors' => 'Student Editor',
    *         'student_editor_emeriti' => 'Student Editor Emeriti',
    * @param string single masthead cat
    * @return object
    */
    public function getMastheadOfType($masthead_category)
    {
        return collect(get_posts([
        'post_type' => 'lpe_author',
        'numberposts' => '-1',
        'post_status' => 'publish',
        'meta_query' => [
          [ 'key' => '_masthead_category',
            'value' => $masthead_category ]
        ]
      ]))->map(function ($post) {
          setup_postdata($post);
          $masthead_author = (object) [
          'name' => get_the_title($post),
          'url' => get_permalink($post),
          'position' => get_post_meta($post->ID, '_position_title', true),
          'category' => get_post_meta($post->ID, '_masthead_category', true)
        ];
          wp_reset_postdata();
          return $masthead_author;
      })->sortBy(function ($masthead_author) {
          $fullname = explode(' ', $masthead_author->name);
          $surname = end($fullname);
          return $surname;
      });
    }

    public function mastheadMembers()
    {
        return $this->getMastheadOfType('editorial_board');
    }

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return false;
        // the false return is temporary
        return [
            'mastheadMembers' => (object) [
                'board' => $this->getMastheadOfType('editorial_board'),
                'managing' => $this->getMastheadOfType('managing_editor'),
                'students' => $this->getMastheadOfType('student_editors'),
                'emeriti' => $this->getMastheadOfType('student_editor_emeriti'),
                'emeriti_count' => intval(count($this->getMastheadOfType('student_editor_emeriti')) / 2),
            ],
        ];
    }
}
