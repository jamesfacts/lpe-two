<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

add_rewrite_tag('%work%', '([^/]*)');
add_rewrite_rule(
    '^authors/([^/]*)/([^/]*)/?$',
    'index.php?authors=$matches[1]&work=$matches[2]',
    'top'
);

add_rewrite_tag('%event-archive%', '([^/]*)');
add_rewrite_rule(
    '^past-events/event-archive/([^/]*)/?$',
    'index.php?pagename=past-events&event-archive=$matches[1]',
    'top'
);

add_rewrite_rule(
    '^upcoming-events/event-archive/([^/]*)/?$',
    'index.php?pagename=upcoming-events&event-archive=$matches[1]',
    'top'
);

// This is definitely necessary, instruct WP to pass a var from url query
// to the template / application
add_action('init', function () {
    add_rewrite_endpoint('work', EP_PERMALINK);
    add_rewrite_endpoint('events', EP_PERMALINK);
    add_rewrite_endpoint('panel', EP_PERMALINK);
});

/**
 * We don't want the link in the excerpt, just elipses
 * @return string
 */
function lpe_excerpt_more($more)
{
    return '&hellip;';
}
add_filter('excerpt_more', __NAMESPACE__ . '\lpe_excerpt_more');

/**
 * determine the post type from the admin area
 * @return string
 */
function lpe_get_current_post_type()
{
   global $post, $typenow, $current_screen;

   if ($post && $post->post_type) {
       return $post->post_type;
   } elseif ($typenow) {
       return $typenow;
   } elseif ($current_screen && $current_screen->post_type) {
       return $current_screen->post_type;
   } elseif (isset($_REQUEST['post_type'])) {
       return sanitize_key($_REQUEST['post_type']);
   }

   return null;
}

function custom_lpe_author_column($column, $post_id)
{
   if (\App\lpe_get_current_post_type() !== 'post') {
       return $column;
   }

   $content = '';

   if ($column === '_author') {
       // get author
       $_author = get_post_meta($post_id, '_author');
       if (!empty($_author)) {
           $authors = $_author[0];
           if (is_array($authors)) {
               $comma = '';
               foreach ($authors as $author => $value) {
                   $_author = get_post($value);
                   $content .= $comma . $_author->post_title;
                   $comma = ', ';
               }
           } else {
               $author = get_post($authors);
               $content = $author->post_title;
           }
           echo $content;
       } else {
           echo '-';
       }
   }
}

function add_lpe_author_column($columns)
{
   if (\App\lpe_get_current_post_type() !== 'post') {
       return $columns;
   }

   // remove WP user and comment count from admin area
   unset($columns['author'], $columns['comments']);
   // redefine the author column
   $column_meta = ['_author' => 'Author'];
   // place new author column in the existing WP admin columns
   $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, null, true);

   return $columns;
}

add_filter('manage_posts_columns', __NAMESPACE__ . '\add_lpe_author_column');
add_action('manage_posts_custom_column', __NAMESPACE__ . '\custom_lpe_author_column', 10, 2);

function custom_lpe_masthead_column($column, $post_id)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_author') {
       return $column;
   }

   $content = '';

   if ($column === '_masthead_category') {
       $category_attribute = get_post_meta($post_id, '_masthead_category', true);
       $content = $category_attribute ?
           str_replace('_', ' ', $category_attribute) : '-';
   }

   echo $content;
}

function add_lpe_masthead_column($columns)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_author') {
       return $columns;
   }

   $column_meta = ['_masthead_category' => 'Masthead Category'];
   // place new author column in the existing WP admin columns
   $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, null, true);

   return $columns;
}

add_filter('manage_posts_columns', __NAMESPACE__ . '\add_lpe_masthead_column');
add_action('manage_posts_custom_column', __NAMESPACE__ . '\custom_lpe_masthead_column', 10, 2);

function custom_lpe_speakers_columns($column, $post_id)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_speaker') {
       return $column;
   }

   $content = '';

   switch ($column) {
       case 'home_base':
           $column_meta = get_post_meta($post_id, 'home_base', true);
           $content = $column_meta ?
               str_replace('_', ' ', $column_meta) : '-';
           echo $content;
       break;
   }
}

function add_lpe_speakers_columns($columns)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_speaker') {
       return $columns;
   }

   $column_meta = ['home_base' => 'Home Base'];
   // place new author column in the existing WP admin columns
   $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, null, true);

   return $columns;
}

add_filter('manage_posts_columns', __NAMESPACE__ . '\add_lpe_speakers_columns');
add_action('manage_posts_custom_column', __NAMESPACE__ . '\custom_lpe_speakers_columns', 10, 2);

function custom_lpe_video_columns($column, $post_id)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_video') {
       return $column;
   }

   $content = '';

   switch ($column) {
       case 'main_featured_video':
           $column_meta = get_post_meta($post_id, 'main_featured_video', true);
           $content = $column_meta ?
               str_replace('_', ' ', 'Featured') : '-';
           echo $content;
       break;
   }
}

function add_lpe_video_columns($columns)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_video') {
       return $columns;
   }

   $column_meta = ['main_featured_video' => 'Featured Video'];
   // place new author column in the existing WP admin columns
   $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, null, true);

   return $columns;
}

add_filter('manage_posts_columns', __NAMESPACE__ . '\add_lpe_video_columns');
add_action('manage_posts_custom_column', __NAMESPACE__ . '\custom_lpe_video_columns', 10, 2);

// syllabi admin columns

function custom_lpe_syllabi_columns($column, $post_id)
{
   if (\App\lpe_get_current_post_type() !== 'syllabi') {
       return $column;
   }

   $content = '';

   switch ($column) {
       case 'syllabus_school':
           $column_meta = get_post_meta($post_id, 'syllabus_school', true);
           $content = $column_meta ?
               str_replace('_', ' ', $column_meta) : '-';
           echo $content;
       break;
   }
}

function add_lpe_syllabi_columns($columns)
{
   if (\App\lpe_get_current_post_type() !== 'syllabi') {
       return $columns;
   }

   $column_meta = ['syllabus_school' => 'Syllabus School'];
   // place new author column in the existing WP admin columns
   $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, null, true);

   return $columns;
}

add_filter('manage_posts_columns', __NAMESPACE__ . '\add_lpe_syllabi_columns');
add_action('manage_posts_custom_column', __NAMESPACE__ . '\custom_lpe_syllabi_columns', 10, 2);

add_filter('get_search_form', function () {
   return \App\template('partials.searchform');
});

add_filter('next_posts_link_attributes', __NAMESPACE__ . '\lpe_posts_link_attributes');
add_filter('previous_posts_link_attributes', __NAMESPACE__ . '\lpe_posts_link_attributes');

function lpe_posts_link_attributes()
{
   return 'class="btn"';
}

function custom_lpe_event_columns($column, $post_id)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_event') {
       return $column;
   }

   $content = '';

   switch ($column) {
       case 'featured_event':
           $column_meta = get_post_meta($post_id, 'featured_event', true);
           $content = $column_meta ?
               str_replace('_', ' ', "Featured") : '-';
           echo $content;
       break;
       case 'ongoing_event':
           $column_meta = get_post_meta($post_id, 'ongoing_event', true);
           $content = $column_meta ?
               str_replace('_', ' ', "Ongoing") : '-';
           echo $content;
       break;
       case 'event_start_date':
           $column_meta = get_post_meta($post_id, 'event_start_date', true);
           $content = $column_meta ?
               str_replace('_', ' ', \App\frontend_date($column_meta)) : '-';
           echo $content;
       break;
   }
}

function add_lpe_event_columns($columns)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_event') {
       return $columns;
   }

   $column_meta = ['featured_event' => 'Featured Event',
                   'event_start_date' => 'Event Start Date',
                   'ongoing_event' => 'Ongoing Event' ];
   // place new author column in the existing WP admin columns
   $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, null, true);

   return $columns;
}

add_filter('manage_posts_columns', __NAMESPACE__ . '\add_lpe_event_columns');
add_action('manage_posts_custom_column', __NAMESPACE__ . '\custom_lpe_event_columns', 10, 2);

function custom_lpe_conference_columns($column, $post_id)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_conference') {
       return $column;
   }

   $content = '';

   switch ($column) {
       case 'panel_date':
           $column_meta = get_post_meta($post_id, 'panel_date', true);
           $content = $column_meta ?
               str_replace('_', ' ', \App\frontend_date($column_meta)) : '-';
           echo $content;
       break;
   }
}

function add_lpe_conference_columns($columns)
{
   if (\App\lpe_get_current_post_type() !== 'lpe_conference') {
       return $columns;
   }

   $column_meta = [ 'panel_date' => 'Panel Date' ];
   $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, null, true);

   return $columns;
}

add_filter('manage_posts_columns', __NAMESPACE__ . '\add_lpe_conference_columns');
add_action('manage_posts_custom_column', __NAMESPACE__ . '\custom_lpe_conference_columns', 10, 2);

/**
* Custom column info for AMRI courses
*/


function custom_amri_course_columns($column, $post_id)
{
   if (\App\lpe_get_current_post_type() !== 'amri_course') {
       return $column;
   }

   $content = '';

   switch ($column) {
       case 'course_week':
           //$column_meta = get_post_meta($post_id, 'panel_date', true);
           $column_meta = get_the_ID();
           $content = $column_meta ? $column_meta : '-';

           $all_posts = \App\amri_weeks();

           echo "Week " . (array_search($column_meta,$all_posts) + 1);
           // echo $content;
       break;
   }

}

function add_amri_course_columns($columns)
{
   if (\App\lpe_get_current_post_type() !== 'amri_course') {
       return $columns;
   }

   $column_meta = [ 'course_week' => 'Course Week' ];
   $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, null, true);

   return $columns;
}

add_filter('manage_posts_columns', __NAMESPACE__ . '\add_amri_course_columns');
add_action('manage_posts_custom_column', __NAMESPACE__ . '\custom_amri_course_columns', 10, 2);


/**
* Remove 'blog' prefix from category urls so categories match topics in structure
* @return array $new_cat_rules
*/

add_filter('category_rewrite_rules', __NAMESPACE__ . '\lpe_remove_blog_prefix_from_categories', 10, 1);

function lpe_remove_blog_prefix_from_categories($cat_rewrite_patterns)
{
   $cat_prefix_as_regex = '/blog\//';

   $new_cat_rules = [];

   foreach ($cat_rewrite_patterns as $pattern_url => $pattern_to_server) {
       $new_cat_rules[preg_replace($cat_prefix_as_regex, '', $pattern_url)] = $pattern_to_server;
   }

   return $new_cat_rules;
}

function lpe_pre_get_posts_overrides($query)
{
   if (is_admin()) {
       return;
   }

   // this check is to allow empty search results rather than redirecting to the homepage
   if (!is_admin() && $query->is_main_query() && $query->is_search() && empty(get_search_query())) {
       $query->set('post__in', array( 0 ));
   }

   // speaker archive and taxonomy pages get extra posts
   if (is_post_type_archive('lpe_speaker') || isset(get_queried_object()->taxonomy) && get_queried_object()->taxonomy === 'speaker_topics') {
       $query->set('posts_per_page', 72);
       $query->set('order', 'ASC');
   }

   // speaker archive and taxonomy pages get extra posts
   if (is_post_type_archive('lpe_author')) {
       $query->set('posts_per_page', 12);
       $query->set('orderby', 'title');
       $query->set('order', 'ASC');
   }

   // speaker archive and taxonomy pages get extra posts
   if (is_post_type_archive('student_group')) {
       $query->set('posts_per_page', 21);
       $query->set('orderby', 'title');
       $query->set('order', 'ASC');
   }
}

add_action('pre_get_posts', __NAMESPACE__ . '\lpe_pre_get_posts_overrides');

add_filter(
   'posts_orderby',
   function ($orderby, $query) {
       if (! is_admin() && ($query->is_post_type_archive('lpe_speaker') || $query->is_post_type_archive('lpe_author'))) {
           $orderby = "SUBSTRING_INDEX(post_title, ' ', -1) ASC, post_title ASC";
       }

       return $orderby;
   },
   10,
   2
);

add_filter('wp_trim_excerpt', __NAMESPACE__.'\wpse_custom_wp_trim_excerpt');

function wpse_custom_wp_trim_excerpt($wpse_excerpt)
{
   if (!is_home()) {
       return $wpse_excerpt;
   }

   if ($wpse_excerpt == '') {
       $wpse_excerpt = get_the_content('');
   }

   $wpse_excerpt = strip_shortcodes($wpse_excerpt);
   $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
   $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
   $wpse_excerpt = strip_tags($wpse_excerpt, '<br>,<em>,<i>,<br/>'); /*IF you need to allow just certain tags. Delete if all tags are allowed */

   //Set the excerpt word count and only break after sentence is complete.
   $excerpt_char_count = 350;
   $excerpt_length = 90;
   $tokens = array();
   $excerptOutput = '';
   $count = 0;
   $char_count = 0;

   // Divide the string into tokens; HTML tags, or words, followed by any whitespace
   preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

   foreach ($tokens[0] as $token) {
       if ($count >= $excerpt_length && preg_match('/[\;\?\.\!]\s*$/uS', $token)) {
           // Limit reached, continue until ; ? . or ! occur at the end
           $excerptOutput .= trim($token);
           break;
       }

       // check to ensure our sentence doesn't exceed max character count
       if ($char_count >= $excerpt_char_count) {
           $excerptOutput .= trim($token);
           $excerptOutput .= ". . .";
           break;
       }

       // Add words to complete sentence
       $count++;

       // Add characters to count
       $char_count += strlen($token);

       // Append what's left of the token
       $excerptOutput .= $token;
   }

   $wpse_excerpt = trim(force_balance_tags($excerptOutput));

   return $wpse_excerpt;
}
