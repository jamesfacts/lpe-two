<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FrontPage extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $frontPage = new FieldsBuilder('Home Page Details', ['position' => 'normal']);

        $frontPage
            ->setLocation('post_type', '==', 'page')
                ->and('page_type', '==', 'front_page');

        $frontPage
            ->addImage('lpe_hero_image', [
                'label' => 'Home Hero',
                'instructions' => 'Select a photo to display on the homepage. Ideally 1820 x 1080 px!',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '1800',
                'min_height' => '1070',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ]);

        $frontPage
            ->addTextarea('learn_blurb', [
                'label' => 'Blurb for Learn',
                'instructions' => '',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
            ]);

            $frontPage
            ->addTextarea('engage_blurb', [
                'label' => 'Blurb for Engage',
                'instructions' => '',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
            ]);

            $frontPage
            ->addTextarea('events_blurb', [
                'label' => 'Blurb for Events',
                'instructions' => '',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
            ]);

        return $frontPage->build();
    }
}
