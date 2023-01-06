<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LPEOptions extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'LPE Options';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'LPE Options';

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $FillerOptions = new FieldsBuilder('filler_options');

        $FillerOptions
            ->addRepeater('header_filler_images')
                ->addImage('filler_header_image', [
                    'label' => 'All images to be displayed as page headers',
                    'instructions' => 'Add header filler images, at least 1790px wide and 415px tall.',
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
                    'min_width' => '1789',
                    'min_height' => '414',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ])
            ->endRepeater();

        return $FillerOptions->build();
    }
}
