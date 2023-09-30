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

    /**
     * Return the values from a panel repeater
     */

    public function get_panel_items()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        $conference_events_list = get_field('conference_events');

        if(is_array($conference_events_list)) {
            return collect($conference_events_list)->map(function($item){
                return (object)[
                    'date' => $item['conf_event_time_picker'],
                    'title' => $item['conf_event_title'],
                    'panelists' => $item['conf_event_speakers'],
                    'content' => $item['conference_copy'],
                    'future' => false,
                    'registration_url' => '#',
                ];
            });
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
        ];
    }
}
