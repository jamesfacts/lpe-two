<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AmriSingle extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $amriSingle = new FieldsBuilder('amri_single');

        $amriSingle
            ->setLocation('post_type', '==', 'amri_course');

        $amriSingle
            ->addWysiwyg('faculty_listing', [
                'label' => 'Faculty Listing',
                'instructions' => 'Here you can edit and link the list of faculty members who appear in a single AMRI course',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
        ]);

        $amriSingle
            ->addRepeater('required_reading')
                ->addText('req_title', [
                    'label' => 'Required Reading Item Title',
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
                ->addText('req_subtitle', [
                    'label' => 'Required Reading Item Subtitle',
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
                ->addUrl('req_url', [
                    'label' => 'Required Reading Item Field',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => '',
                    'placeholder' => '',
                ])
                ->addText('req_authors', [
                    'label' => 'Required Reading Item Authors',
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
                ->addText('req_notes', [
                    'label' => 'Required Reading Item Notes',
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
                ->addTrueFalse('is_heading', [
                    'label' => 'Is This a Heading?',
                    'instructions' => 'Flip this switch to display a reading item as a heading break',
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
                ])
            ->endRepeater();

        return $amriSingle->build();
    }
}
