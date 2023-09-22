<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AmriOverview extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $amriOverview = new FieldsBuilder('amri_overview');

        $amriOverview
        ->setLocation('page_template', '==', 'template-amri-overview.blade.php');

        $amriOverview
            ->addText('amri_overview_subhead', [
                'label' => 'AMRI Overview Subhead',
                'instructions' => 'An optional subhead to appear under the AMRI overview title',
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

        $amriOverview
            ->addWysiwyg('org_resources_copy', [
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
        ]);

        $amriOverview
            ->addFile('organizational_pdf', [
                'label' => 'Organizational PDF',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'url',
                'library' => 'all',
                'min_size' => '',
                'max_size' => '',
                'mime_types' => 'pdf',
            ]);

        $amriOverview
            ->addWysiwyg('exp_reading_copy', [
                'label' => 'Expanded Reading Copy',
                'instructions' => 'A brief excerpt explaining what to expect in the Reading List PDF',
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
        ]);

        $amriOverview
            ->addFile('reading_list_pdf', [
                'label' => 'Reading List PDF',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'url',
                'library' => 'all',
                'min_size' => '',
                'max_size' => '',
                'mime_types' => 'pdf',
            ]);

        $amriOverview
            ->addWysiwyg('amri_part_two', [
                'label' => 'AMRI Part Two',
                'instructions' => '',
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
        ]);

        return $amriOverview->build();
    }
}
