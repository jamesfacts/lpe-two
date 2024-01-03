<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ConferenceTemplate extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-conference'
    ];

    public static $placeholderArr = [1, 4, 8, 10, 13, 15, 17, 20];
    public static $placeholders_to_add = [];

    /**
     * Return the values from a panel repeater
     */

    public function get_panel_items()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        $conference_events_list = get_field('conference_events');

        if (!is_int(count($conference_events_list))) {
            return false;
        }

        $conf_count = count($conference_events_list);
        self::$placeholders_to_add = collect(array_filter(self::$placeholderArr, function ($value) use ($conf_count) {
            return $value < $conf_count;
        }));

        $conference_events_panels = [];

        if(is_array($conference_events_list)) {
            $conference_events_panels = collect($conference_events_list)->map(function($item){
                $date_str = $item['conf_event_time_picker'];
                $date_obj = \DateTime::createFromFormat( 'Y-m-d H:i:s', $date_str );

                $slug_data = str_replace  ("'", "", $item['conf_event_title']);
                $slug_data = preg_replace ('/[^\p{L}\p{N}]/u', '_', $slug_data);
                
                return (object)[
                    'placeholder' => false,
                    'date_obj' => $date_obj,
                    'date' => $date_obj->format('l, F j, g:iA'),
                    'title' => $item['conf_event_title'],
                    'panelists' => $item['conf_event_speakers'],
                    'content' => $item['conference_copy'],
                    'future' => false,
                    'registration_url' => '#',
                    'conference_video' => $item['conference_video'],
                    'slug' => $slug_data,
                ];
            })->sortBy('date_obj')->values();
        }

        if( $conference_events_panels->count() > 0 ) {
            // $placeholderItem = (object)['placeholder' => true];
            
            $all_panels = [];

            foreach ($conference_events_panels as $key => $item) {
                if( $key == self::$placeholders_to_add->first() ) {
                    self::$placeholders_to_add->shift();
                    $all_panels[] = (object)['placeholder' => true];
                }

                $all_panels[] = $item;
            }

            // TODO this should figure out how many placeholders are needed at the bottom
            $all_panels[] = (object)['placeholder' => true];
            $all_panels[] = (object)['placeholder' => true];
            return $all_panels;
        }

        return false;
    }

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'title' => get_the_title(),
            'panel_items' =>$this->get_panel_items(),
            'placeholder_positions' => [1, 4, 8, 10, 13, 15, 17, 20],
        ];
    }
}
