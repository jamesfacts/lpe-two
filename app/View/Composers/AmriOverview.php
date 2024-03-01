<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class AmriOverview extends Composer
{
    public static $amri_course_list;
    public static $first_count;
    public static $week = 1;

    public function __construct()
    {
        $args = [
            'post_type' => 'amri_course',
            'post_status' => 'publish',
            'posts_per_page' => -1
          ];

        $query = new \WP_Query($args);
        $all_amri_posts = collect($query->posts)->reverse()->map(function($post){
            setup_postdata($post);
            $blog_post = (object) [
                'title' => get_the_title($post),
                'post_id' => $post->ID,
                'url' => get_permalink($post),
                'excerpt' => get_the_excerpt($post),
                'course_week' => 'Week ' . self::$week,
                'faculty' => wp_strip_all_tags(get_field('faculty_listing', $post->ID))
            ];
            self::$week++;
            wp_reset_postdata();
            return $blog_post;
        });

        self::$first_count = floor($all_amri_posts->count() / 2);

        self::$amri_course_list = $all_amri_posts;
    }

    public function amriOverviewSubhed()
    {
        if (!function_exists('get_field')) {
            return false;
        }
        return get_field('amri_overview_subhead');
    }

    public function amriOverviewImage()
    {
        $post_ID = get_the_ID();
        $post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'w680') ?
                        wp_get_attachment_image_src(get_post_thumbnail_id(), 'w680')[0]
                        : \App\filler_image('thumb');
        $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)?
                  get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)
                : get_the_title();

        return (object)[
            'src' => $post_thumb,
            'alt' => $alt
        ];
    }

    public function part_one()
    {
        return self::$amri_course_list->slice(0, self::$first_count);
    }

    public function part_two()
    {
        return self::$amri_course_list->slice(self::$first_count);
    }

    public function part_one_copy()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        return get_field('amri_part_one');
    }

    public function part_two_copy()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        return get_field('amri_part_two');
    }

    public function org_copy()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        return get_field('org_resources_copy');
    }

    public function orgPdf()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        return get_field('organizational_pdf');
    }

    public function reading_copy()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        return get_field('exp_reading_copy');
    }

    public function readingPdf()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        return get_field('reading_list_pdf');
    }

    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-amri-overview'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'part_one_copy' => $this->part_one_copy(),
            'part_two_copy' => $this->part_two_copy(),
            'amri_overview_subhed' => $this->amriOverviewSubhed(),
            'amri_overview_image' => $this->amriOverviewImage(),
            'part_one' => $this->part_one(),
            'part_two' => $this->part_two(),
            'org_copy' => $this->org_copy(),
            'org_pdf' => $this->orgPdf(),
            'reading_copy' => $this->reading_copy(),
            'readingPdf' => $this->readingPdf()
        ];
    }
}
