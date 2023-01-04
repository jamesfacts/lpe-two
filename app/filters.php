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