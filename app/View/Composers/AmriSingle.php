<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class AmriSingle extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-single-amri_course'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'this_course_week' => $this->thisCourseWeek(),
            'faculty_list' => $this->facultyList(),
            'required_reading' => $this->requiredReading(),
            'lecture_oembed' => $this->lectureOembed(),
            'lecture_description' => $this->lectureDescription(),
            'optional_reading' => $this->optionalReading(),
        ];
    }

    public function thisCourseWeek()
    {
        $all_courses = \App\amri_weeks();

        $this_course = get_the_ID();

        $this_position = array_search( get_the_ID(), $all_courses ) + 1;

        return \App\read_number($this_position);
    }

    public function facultyList()
    {
        if (!function_exists('get_field')) {
            return false;
        }
        return strip_tags(get_field('faculty_listing'), '<a>');
    }

    public function requiredReading()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        $reading_list = get_field('required_reading');

        if(is_array($reading_list)) {
            return collect($reading_list)->map(function($item){
                $data_value = urlencode( $item['req_title'] );

                return (object)[
                    'is_hed' => $item['is_heading'],
                    'data_tag' => $data_value,
                    'title' => $item['req_title'],
                    'subtitle' => $item['req_subtitle'],
                    'authors' => $item['req_authors'],
                    'notes' => $item['req_notes'],
                    'url' => $item['req_url']
                ];
            });
        }

        return false;
    }

    public function optionalReading()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        $reading_list = get_field('optional_reading');

        if(is_array($reading_list)) {
            return collect($reading_list)->map(function($item){
                $data_value = urlencode( $item['req_title'] );

                return (object)[
                    'is_hed' => $item['optional_reading_heading'],
                    'data_tag' => $data_value,
                    'title' => $item['optional_reading_title'],
                    'subtitle' => $item['optional_reading_subtitle'],
                    'authors' => $item['optional_reading_authors'],
                    'notes' => $item['optional_reading_notes'],
                    'url' => $item['optional_reading_url']
                ];
            });
        }

        return false;
    }

    public function lectureOembed()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        $embededVid = get_field('recorded_lecture');

        return $embededVid;
    }

    public function lectureDescription()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        $lectureDescription = get_field('lecture_description');

        return $lectureDescription;
    }

}
