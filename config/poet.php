<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Here you may specify the post types to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post' => [
        'lpe_author' => [
            'enter_title_here' => 'Enter author name',
            'menu_icon' => 'dashicons-id-alt',
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'authors', 'with_front' => false],
            'labels' => [
                'singular' => 'Author',
                'plural' => 'Authors',
            ],
        ],
        'student_group' => [
            'enter_title_here' => 'Enter name of student group',
            'menu_icon' => 'dashicons-networking',
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'student-groups', 'with_front' => false],
            'labels' => [
                'singular' => 'Student Group',
                'plural' => 'Student Groups',
            ],
        ],
        'lpe_speaker' => [
            'enter_title_here' => 'Enter speaker name',
            'menu_icon' => 'dashicons-lightbulb',
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'speakers', 'with_front' => false],
            'labels' => [
                'singular' => 'LPE Speaker',
                'plural' => 'LPE Speakers',
            ],
        ],
        'syllabi' => [
            'enter_title_here' => 'Enter syllabus title',
            'menu_icon' => 'dashicons-list-view',
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'syllabi', 'with_front' => false],
            'labels' => [
                'singular' => 'Syllabus',
                'plural' => 'Syllabi',
            ],
        ], 
        'primers' => [
            'enter_title_here' => 'Enter primer title',
            'menu_icon' => 'dashicons-list-view',
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'primers', 'with_front' => false],
            'labels' => [
                'singular' => 'Primer',
                'plural' => 'Primers',
            ],
        ],  
        'amri_course' => [
            'enter_title_here' => 'Enter AMRI course title',
            'menu_icon' => 'dashicons-list-view',
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'amri', 'with_front' => false],
            'labels' => [
                'singular' => 'AMRI course',
                'plural' => 'AMRI courses',
            ],
        ],
        'lpe_video' => [
            'enter_title_here' => 'Enter video title',
            'menu_icon' => 'dashicons-format-video',
            'supports' => ['title', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'videos', 'with_front' => false],
            'labels' => [
                'singular' => 'LPE video',
                'plural' => 'LPE videos',
            ],
        ],
        'lpe_event' => [
            'enter_title_here' => 'Enter event title',
            'menu_icon' => 'dashicons-calendar',
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'events', 'with_front' => false],
            'labels' => [
                'singular' => 'LPE event',
                'plural' => 'LPE events',
            ],
        ],  
        'lpe_conference' => [
            'enter_title_here' => 'Enter conference event title',
            'menu_icon' => 'dashicons-calendar',
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'rewrite' => ['slug' => 'conferences', 'with_front' => false],
            'labels' => [
                'singular' => 'LPE conferences event',
                'plural' => 'LPE conferences events',
            ],
        ],            
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here you may specify the taxonomies to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomy' => [
        'genre' => [
            'links' => ['book'],
            'meta_box' => 'radio',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Blocks
    |--------------------------------------------------------------------------
    |
    | Here you may specify the block types to be registered by Poet and
    | rendered using Blade.
    |
    | Blocks are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the block `sage/accordion`, your block view would be located at:
    |   ↪ `views/blocks/accordion.blade.php`
    |
    | Block views have the following variables available:
    |   ↪ $data    – An object containing the block data.
    |   ↪ $content – A string containing the InnerBlocks content.
    |                Returns `null` when empty.
    |
    */

    'block' => [
        // 'sage/accordion',
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block categories to be registered by Poet for use
    | in the editor.
    |
    */

    'block_category' => [
        // 'cta' => [
        //     'title' => 'Call to Action',
        //     'icon' => 'star-filled',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Patterns
    |--------------------------------------------------------------------------
    |
    | Here you may specify block patterns to be registered by Poet for use
    | in the editor.
    |
    | Patterns are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the pattern `sage/hero`, your pattern content would be located at:
    |   ↪ `views/block-patterns/hero.blade.php`
    |
    | See: https://developer.wordpress.org/reference/functions/register_block_pattern/
    */

    'block_pattern' => [
        // 'sage/hero' => [
        //     'title' => 'Page Hero',
        //     'description' => 'Draw attention to the main focus of the page, and highlight key CTAs',
        //     'categories' => ['all'],
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Pattern Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block pattern categories to be registered by Poet for
    | use in the editor.
    |
    */

    'block_pattern_category' => [
        'all' => [
            'label' => 'All Patterns',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Editor Palette
    |--------------------------------------------------------------------------
    |
    | Here you may specify the color palette registered in the Gutenberg
    | editor.
    |
    | A color palette can be passed as an array or by passing the filename of
    | a JSON file containing the palette.
    |
    | If a color is passed a value directly, the slug will automatically be
    | converted to Title Case and used as the color name.
    |
    | If the palette is explicitly set to `true` – Poet will attempt to
    | register the palette using the default `palette.json` filename generated
    | by <https://github.com/roots/palette-webpack-plugin>
    |
    */

    'palette' => [
        // 'red' => '#ff0000',
        // 'blue' => '#0000ff',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Menu
    |--------------------------------------------------------------------------
    |
    | Here you may specify admin menu item page slugs you would like moved to
    | the Tools menu in an attempt to clean up unwanted core/plugin bloat.
    |
    | Alternatively, you may also explicitly pass `false` to any menu item to
    | remove it entirely.
    |
    */

    'admin_menu' => [
        // 'gutenberg',
    ],

];
