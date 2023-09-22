<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LearnPage extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $learnPage = new FieldsBuilder('learn_page');

        $learnPage
            ->setLocation('page_template', '==', 'template-learn.blade.php');

        $learnPage
            ->addWysiwyg('syllabi_blurb', [
                'label' => 'Syllabi Blurb',
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

        $learnPage
            ->addWysiwyg('primers_blurb', [
                'label' => 'Primers Blurb',
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

        return $learnPage->build();
    }
}
