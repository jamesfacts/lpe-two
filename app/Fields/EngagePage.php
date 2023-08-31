<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class EngagePage extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $engagePage = new FieldsBuilder('engage_page');

        $engagePage
            ->setLocation('page_template', '==', 'template-engage.blade.php');

        $engagePage
            ->addWysiwyg('speakers_blurb', [
                'label' => 'Speakers Blurb',
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

        $engagePage
            ->addWysiwyg('student_groups_blurb', [
                'label' => 'Start a Student Group',
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

        $engagePage
            ->addUrl('student_group_form', [
                'label' => 'Student Group Form URL',
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
            ]);

        return $engagePage->build();
    }
}
