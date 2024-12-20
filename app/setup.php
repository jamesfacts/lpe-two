<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

function google_fonts_rubik_url()
{
    return 'https://fonts.googleapis.com/css?family=' . urlencode('Rubik:300,400,600,700&display=swap');
}

function google_fonts_serif_pro_url()
{
    return 'https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;700&display=swap';
}

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();

    wp_enqueue_style('google/fonts', \App\google_fonts_rubik_url(), false, null);
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'about_navigation' => __('About Navigation', 'sage'),
        'engage_navigation' => __('Engage Navigation', 'sage'),
        'learn_navigation' => __('Learn Navigation', 'sage'),
        'events_navigation' => __('Events Navigation', 'sage'),
        'main_footer_nav' => __('Footer Navigation', 'sage'),
        'lower_footer_nav' => __('Lower Footer Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // using this for the homepage blog feed
    // also for the blog feed thumb
    add_image_size('w450', 450, 9999);

    // using this for the featured blog post
    add_image_size('w680', 680, 9999);

    // Allow excerpts for pages
    add_post_type_support('page', 'excerpt');

    /**
     * Enable responsive embed support.
     *
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Remove the default WordPress image thumb sizes
 * unclear why we need two approaches to eliminate '2048x2048', '1536x1536' vs
 * the other default sizes
 */

 add_action('init', function () {
    remove_image_size('2048x2048');
    remove_image_size('1536x1536');
});

add_filter('intermediate_image_sizes', __NAMESPACE__ . '\remove_default_img_sizes', 10, 1);

function remove_default_img_sizes($sizes)
{
    $targets = ['medium', 'medium_large', 'thumbnail', 'large'];

    foreach ($sizes as $size_index=>$size) {
        if (in_array($size, $targets)) {
            unset($sizes[$size_index]);
        }
    }

    return $sizes;
}

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $sidebarConfig = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<span class="widget-hed">',
        'after_title'   => '</span>'
    ];

    /**
     * this messy duplicate config is necessary because widgets don't know
     * what sidebar they belong to, so you can't remove titles
     * with the `widget_title` filter
     */
    $footerConfig = [
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="hidden">',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Blog Sidebar', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $sidebarConfig);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
// add_action('the_post', function ($post) {
//     sage('blade')->share('post', $post);
// });

/**
 *  Once a post is featured, we don't want it showing up elsewhere
 */

 function custom_query_vars($query)
 {
     if (!is_admin() && $query->is_main_query()) {
        
         if (is_home()) {
            $toppost_args = [
                 'post_type' => 'post',
                 'meta_query' => [
                    ['key' => 'top_post', 'value' => 1] 
                ]
            ];

            $sticky_args = [
                'post_type' => 'post',
                'meta_query' => [
                    ['key' => 'sticky_zone', 'value' => 1] 
                ]
            ];

            $natural_args = [
                'post_type' => 'post',
                'posts_per_page' => 6,
                'post_status' => 'publish',
                'orderby'     => 'date',
                'order'       => 'DESC'
            ];
 
            $excluded_toppost_query = new \WP_Query($toppost_args);
            $excluded_sticky_query = new \WP_Query($sticky_args);
            $natural_home_query = new \WP_Query($natural_args);
 
            $excluded_toppost = collect($excluded_toppost_query->posts)->map(function ($post) {
                return (object) [
                'top_ID' => $post->ID,
                'post_modified' => $post->post_modified
                ];
            })->sortByDesc('post_modified')->first();

            $excluded_sticky_posts = collect($excluded_sticky_query->posts)->map(function ($post) {
                return $post->ID;
            });

            $natural_home_posts = collect($natural_home_query)->map(function ($post) {
                return $post->ID;
            })->toArray();

            $all_excluded = $excluded_sticky_posts->push($excluded_toppost->top_ID)->toArray();

            // if there were no sticky posts, we could just tack on an offset of 6 (the recent updates)
            // but because there are some sticky posts that potentially would have appeared on recent 
            // updates, we need to calculate how many posts are missing from the standard flow

            // overlap measures how we need to reduce the the recent updates offset to account
            // for posts from the first six that are already excluded by the sticky check

            $overlap = array_intersect($natural_home_posts, $all_excluded);

            $page_two_offset = 7 - count($overlap);
            $ppp = get_option( 'posts_per_page' );

            $query->set('post__not_in', $all_excluded);
            
            if(get_query_var('paged') == 0) {
                $query->set('posts_per_page', 6);
            }

            if(get_query_var('paged') == 2) {
                $query->set('offset', $page_two_offset);
            }

            if(get_query_var('paged') > 2) {
                // page 3                         ( 3 - 1) * 15 == 30
                // page_two_offset = 4
                $further_page_offset = ( ( $query->query_vars['paged']-1 ) * $ppp ) - ($ppp - $page_two_offset);
                $query->set('offset', $further_page_offset);
            }
             
         }

         // set the paged event archive queries to go by meta value for event start dates
         if (is_archive() && ($query->is_post_type_archive('lpe_event') ) && get_query_var('paged') > 0 ) {
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'DESC');
            $query->set('meta_key', 'event_start_date');

         }
     }

     if (!is_admin() && is_post_type_archive( 'lpe_event' ) && $query->is_main_query()) {
        if(get_query_var('paged') > 0) {
            $ppp = get_option('posts_per_page');
            $page_offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );

            $query->set('offset', $page_offset - 9);
        }
     }
     
 }
 
 add_action('pre_get_posts', __NAMESPACE__ . '\custom_query_vars');

 // rename the default WP tags
function rename_tag_taxonomy()
{

  // grab the default tag taxonomy
    global $wp_taxonomies;

    // because we are messing with the default tag tax object it's important
    // to re-insert _every_ possible label
    // list of taxonomy labels pulled from here https://developer.wordpress.org/reference/functions/get_taxonomy_labels/
    $wp_taxonomies['post_tag']->labels = (object)[
    'name'
        => _x('Topics', 'taxonomy general name', 'sage'), 'singular_name'
        => _x('Topic', 'taxonomy singular name', 'sage'), 'search_items'
        => __('Search Topics', 'sage'), 'popular_items'
        => __('Popular Topics', 'sage'), 'all_items'
        => __('All Topics', 'sage'), 'parent_item'
        => null, 'parent_item_colon'
        => null, 'edit_item'
        => __('Edit Topic', 'sage'), 'view_item'
        => __('View Topic', 'sage'), 'update_item'
        => __('Update Topic', 'sage'), 'add_new_item'
        => __('Add New Topic', 'sage'), 'new_item_name'
        => __('New Topic Name', 'sage'), 'separate_items_with_commas'
        => __('Separate topics with commas', 'sage'), 'add_or_remove_items'
        => __('Add or remove topics', 'sage'), 'choose_from_most_used'
        => __('Choose from the most used topics', 'sage'), 'not_found'
        => __('No topics found.', 'sage'), 'no_terms'
        => null, 'items_list_navigation'
        => __('Topics', 'sage'), 'items_list'
        => __('Topics', 'sage'), 'most_used'
        => __('Most used topics', 'sage'), 'menu_name'
        => __('Topics', 'sage'),
    ];
}

add_action('init', __NAMESPACE__ . '\rename_tag_taxonomy', 10);

function lpe_project_register_search_route()
{
    register_rest_route('lpe_project/v1', '/search', [
        'methods' => \WP_REST_Server::READABLE,
        'callback' => __NAMESPACE__ . '\lpe_project_ajax_search',
        'args' => \App\lpe_project_get_search_args()
    ]);
}

add_action('rest_api_init', __NAMESPACE__ . '\lpe_project_register_search_route');