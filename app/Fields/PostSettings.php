<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostSettings extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $postSettings = new FieldsBuilder('post_settings', ['title' => 'Blog Settings', 'position' => 'side']);

        $postSettings
            ->setLocation('post_type', '==', 'post');

        $postSettings
            ->addTrueFalse('top_post', [
                'label' => 'Top Post',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ]);

        $postSettings
            ->addTrueFalse('sticky_zone', [
                'label' => 'Sticky Zone',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ]);

        $postSettings
            ->addPostObject('_author', [
                'label' =>  'Select Contributors',
                'post_type' => ['lpe_author'],
                'multiple' => 1,
                'return_format' => 'integer',
            ]);

        return $postSettings->build();
    }
}
