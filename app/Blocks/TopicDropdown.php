<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TopicDropdown extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Topic Dropdown';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Topic Dropdown block.';

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
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'topics' => $this->archiveTaxDropdown(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $topicDropdown = new FieldsBuilder('topic_dropdown');

        $topicDropdown
            ->addText('Topic dropdown');

        return $topicDropdown->build();
    }

    public function archiveTaxDropdown()
    {
        $args = ['taxonomy' => 'post_tag'];

        $topics = get_terms($args);
        $min_count = 1;
        
        return collect($topics)->map(function ($topic) {
            if( $topic->count > $min_count ) {
                return (object) [
                    'name' => $topic->name,
                    'url' => home_url('/topics/') . $topic->slug . '/',
                ];   
            }
        });
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
