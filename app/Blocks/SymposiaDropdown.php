<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class SymposiaDropdown extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Symposia Dropdown';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Symposia Dropdown block.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'formatting';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'editor-ul';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [
        [
            'name' => 'light',
            'label' => 'Light',
            'isDefault' => true,
        ],
        [
            'name' => 'dark',
            'label' => 'Dark',
        ]
    ];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'items' => [
            ['item' => 'Item one'],
            ['item' => 'Item two'],
            ['item' => 'Item three'],
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'topics' => $this->archiveTaxDropdown(),
            'title' => $this->title,
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $symposiaDropdown = new FieldsBuilder('symposia_dropdown');

        $symposiaDropdown
            ->addText('symposia_dropdown_title', [
                'label' => 'Symposia dropdown title',
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
            ]);

        return $symposiaDropdown->build();
    }

    public function archiveTaxDropdown()
    {
        $args = ['taxonomy' => 'symposia'];

        $topics = get_terms($args);
        $min_count = 1;
        
        $topics = collect($topics)->map(function ($topic) {
            if( $topic->count > $min_count ) {
                return (object) [
                    'name' => $topic->name,
                    'url' => home_url('/symposia/') . $topic->slug . '/',
                ];   
            }
        });

        $topics->prepend( (object) [
            'name' => 'All Symposia',
            'url' => home_url('/symposia/'),
        ]);

        return $topics;
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }
}
