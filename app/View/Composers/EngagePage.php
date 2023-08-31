<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class EngagePage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-engage'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'lpeSpeakers' => $this->getLpeSpeakers(),
            'lpeStudentGroups' => $this->getStudentGroups(),
        ];
    }

    /**
    * Return a Laravel collection of student groups (if any)
    * @return object
    */
    public function getStudentGroups()
    {
        return collect(get_posts([
        'post_type' => 'student_group',
        'numberposts' => '6',
        'post_status' => 'publish',
      ]))->map(function ($post) {
          setup_postdata($post);
          $img = get_post_thumbnail_id($post->ID);
          $student_group = (object) [
          'name' => get_the_title($post),
          'url' => get_permalink($post),
          'img_url' => $img ? get_the_post_thumbnail_url($post->ID, 'w450') : \App\filler_image('thumb', 'w450'),
          'alt' => $img ? get_post_meta($img, '_wp_attachment_image_alt', true) : get_the_title($post),
          'school' => get_field('school_affiliation', $post->ID)
        ];
          wp_reset_postdata();
          return $student_group;
      });
    }

    /**
    * Return a Laravel collection of LPE speakers (if any)
    * @return object
    */
    public function getLpeSpeakers()
    {
        return collect(get_posts([
        'post_type' => 'lpe_speaker',
        'numberposts' => '12',
        'post_status' => 'publish',
      ]))->map(function ($post) {
          setup_postdata($post);
          $speaker = (object) [
          'name' => get_the_title($post),
          'url' => get_permalink($post),
          'home_base' => get_post_meta($post->ID, 'home_base', true),
          'speaker_topic' => get_post_meta($post->ID, 'speaker_topic', true)
        ];
          wp_reset_postdata();
          return $speaker;
      });
    }
}
