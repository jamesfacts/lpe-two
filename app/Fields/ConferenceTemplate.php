<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ConferenceTemplate extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $conferenceTemplate = new FieldsBuilder('conference_template');

        $conferenceTemplate
            ->setLocation('page_template', '==', 'template-conference.blade.php');

        $conferenceTemplate
            ->addText('conference_subtitle', [
                'label' => 'Text below conference title',
                'instructions' => 'Often the season of the event',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ]);

        $conferenceTemplate
            ->addRepeater('conference_events', ['layout' => 'row'])
                ->addDateTimePicker('conf_event_time_picker', [
                    'label' => 'Date and time of conference event',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'display_format' => 'Y-m-d H:i:s',
                    'return_format' => 'Y-m-d H:i:s',
                    'default_value' => '',
                ])
                ->addText('conf_event_title', [
                    'label' => 'Conference Event Title',
                    'instructions' => '',
                    'required' => 1,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ])
                ->addText('conf_event_speakers', [
                    'label' => 'Featured speakers',
                    'instructions' => '',
                    'required' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ])
                ->addWysiwyg('conference_copy', [
                    'label' => 'Organizational Resources Copy',
                    'instructions' => 'A brief excerpt explaining what to expect in the organizational PDF',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ])
                ->addOembed('conference_video', [
                    'label' => 'Is there a video that belongs to this event?',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'width' => '732',
                    'height' => '412',
                ]);

        return $conferenceTemplate->build();
    }
}
