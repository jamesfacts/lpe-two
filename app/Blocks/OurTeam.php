<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OurTeam extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Our Team';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Our Team block.';

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
            'items' => $this->items(),
            'teamMembers' => $this->ourTeamMembers(),
            'studentEditors' => $this->studentEditors(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $ourTeam = new FieldsBuilder('our_team');

        $ourTeam
            ->addText('title');

        return $ourTeam->build();
    }

    /**
     * Return the items field.
     *
     * @return array
     */
    public function items()
    {
        return get_field('items') ?: $this->example['items'];
    }

    public function ourTeamMembers()
    {
        $teamMembers = collect(get_posts([
        'post_type' => 'page',
        'numberposts' => '-1',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => [
            [ 'key' => 'our_team_title',
              'value' => array(''),
               'compare' => 'NOT IN' ]
        ]
        ]))->map(function ($post) {
            setup_postdata($post);
            $team_member = (object) [
            'name' => get_the_title($post),
            'url' => get_permalink($post),
            'position' => get_post_meta($post->ID, 'our_team_title', true),
        ];
            wp_reset_postdata();
            return $team_member;
        });

        return $teamMembers;
    }

    public function studentEditors($masthead_category = 'student_editors')
    {
        return collect(get_posts([
        'post_type' => 'lpe_author',
        'numberposts' => '-1',
        'post_status' => 'publish',
        'meta_query' => [
            [ 'key' => '_masthead_category',
            'value' => $masthead_category ]
        ]]))->map(function ($post) {
                setup_postdata($post);
                $masthead_author = (object) [
                    'name' => get_the_title($post),
                    'url' => get_permalink($post),
                    'position' => get_post_meta($post->ID, '_position_title', true),
                    'category' => get_post_meta($post->ID, '_masthead_category', true)
                    ];
                wp_reset_postdata();
                return $masthead_author;
            })->sortBy(function ($masthead_author) {
                $fullname = explode(' ', $masthead_author->name);
                $surname = end($fullname);
                return $surname;
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
