<?php

namespace App;

use WP_Query;

/**
 * Add a tickbox to set a single post as a 'featured' item, to be displayed in the
 * featured blog section of the 'home' template
 *
 * Accepts the current metaboxes object
 * @param object $meta_boxes
 */

// Register the 'contributor' meta box for articles, books and posts
if (! function_exists('author-select-meta-box')) {
    add_action('add_meta_boxes', function () {
        add_meta_box('author-select-meta-box', 'Select Contributors', __NAMESPACE__.'\\author_select_meta_box', ['article', 'book', 'post'], 'side', 'core');
    });
}

// here's how we save the "featured" meta box...a little different than most meta box saves

// there can only be one
function highlander_featured_post($post_id)
{
    // Be sure we're in a blog post
    $post = get_post($post_id);
    $posts_to_check = ['post', 'lpe_video'];
    $fields_to_check = ['_featured_video', 'blog-options-featured_blog'];
    
    if (!in_array($post->post_type, $posts_to_check)) {
        return;
    }

    // Stop when it is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    $field = 'blog-options-featured_blog';

    // todo no ==
    if (!empty($_POST[$field])
         && $_POST[$field] == true
         && $_POST['post_status'] == 'publish') {

        // Delete 'featured_blah_blah' meta from all posts
        foreach ($posts_to_check as $post) {
            delete_metadata($post, null, $field, null, true);
        }

        // Set 'featured_blah_blah' meta for the post bring saved
        add_post_meta($post_id, $field, true);
    }
}

add_action('publish_post', __NAMESPACE__ . '\highlander_featured_post');
add_action('save_post', __NAMESPACE__ . '\highlander_featured_post');

/**
 * Add a dropdown selector of authors, to allow a regular blog post to
 * be assigned one or more contributors.
 *
 * Accepts the current post object
 * @param object $post
 */
function author_select_meta_box($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'author-select');

    $args = [
    'post_type' => 'lpe_author',
    'post_status' => 'publish',
    'posts_per_page' => -1
  ];

    $query = new WP_Query($args);
    $authors = $query->posts;
    $existing_authors = get_post_meta($post->ID, '_author', true);
    usort($authors, __NAMESPACE__ . '\\sort_authors_by_last_name_asc');

    // the id value below is required for the js that creates new 'author'
    // select boxes when a user clicks #addauthor?>
  <div id="clone_container">
  <?php if (is_array($existing_authors) && ! empty($existing_authors)) {

    // build array of existing author dropdown boxes, if there's at least one
        foreach ($existing_authors as $author => $value) { ?>
      <select class="author" name="_author[<?= esc_attr($author); ?>]">
        <option value="">- select author -</option>
        <?php
          foreach ($authors as $v) {
              echo '<option value="' . esc_attr($v->ID) . '"' . ($v->ID === intval($value) ? ' selected="selected"' : '') . '>' . esc_html($v->post_title) . '</option>';
          }
        ?>
      </select>
    <?php } // end foreach
    } else {

    // no author has been selected yet!?>
    <select class="author" name="_author[0]" style="width:90%;">
      <option value="">- select author -</option>
      <?php
        foreach ($authors as $v) {
            echo '<option value="' . esc_attr($v->ID) . '">' . esc_html($v->post_title) . '</option>';
        } ?>
    </select>
    <?php
    } ?>
  </div>
  <a id="addauthor" type="button" href="#">Add another contributor</a>
  <?php
}

// Register the 'contributor' meta box for posts
add_action('add_meta_boxes', function () {
    add_meta_box('author-select-meta-box', 'Select Contributors', __NAMESPACE__.'\\author_select_meta_box', ['post'], 'side', 'core');
});


/**
 * Saves data entered in the contributor select meta box.
 *
 * Accepts the WordPress current post ID as an argument
 * @param int $post_ID
 */

function save_author_select_meta_boxes($post_ID)
{

    // we don't want to update if WP is running an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (! current_user_can('edit_post', $post_ID)) {
        return;
    }

    if (
            isset($_POST['_author'], $_POST['author-select'])
            && wp_verify_nonce(sanitize_key($_POST['author-select']), plugin_basename(__FILE__))
    ) {
        if (is_array($_POST['_author'])) {
            $santized_authors = array_map('sanitize_text_field', $_POST['_author']);
            update_post_meta($post_ID, '_author', array_filter($santized_authors));
        } else {
            delete_post_meta($post_ID, '_author');
        }
    }
}

// add save functionality for the contributor meta box to native WP post
add_action(
    'publish_post',
    __NAMESPACE__.'\save_author_select_meta_boxes'
);
add_action('save_post', __NAMESPACE__.'\save_author_select_meta_boxes');


// Register the 'contributor info' meta box for articles
if (! function_exists('masthead-attributes-meta-box')) {
    add_action('add_meta_boxes', function () {
        add_meta_box(
            'masthead-attributes-meta-box',
            'Masthead Info',
            __NAMESPACE__.'\masthead_attributes_meta_box',
            ['lpe_author'],
            'side',
            'core'
        );
    });
}

// Register the function for saving masthead meta fields
if (! function_exists('save_masthead_attributes_meta_box')) {
    add_action(
        'publish_post_lpe_author',
        __NAMESPACE__.'\save_masthead_attributes_meta_box'
    );
    add_action(
        'save_post_lpe_author',
        __NAMESPACE__.'\save_masthead_attributes_meta_box'
    );
}

/**
 * Add a meta box area to assign masthead attributes to
 * posts of the 'lpe_author' custom type
 *
 * Accepts current post object
 * @param object $post
 */

function masthead_attributes_meta_box($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'masthead-attributes');

    $current_masthead_category = get_post_meta($post->ID, '_masthead_category', true);
    $masthead_categories = [
        'none' => '  ----  ',
        'editorial_board' => ' Editorial Board',
        'managing_editor' => 'Managing Editor',
        'student_editors' => 'Student Editor',
        'student_editor_emeriti' => 'Student Editor Emeriti',

    ]; ?>

	<div class="masthead-attributes">
		<label for="lpe_masthead_category">Select a Masthead Category</label>

		<select name="_masthead_category" class="editor-masthead-category">
    <?php
    foreach ($masthead_categories as $k=>$v) {
        echo '<option value="' . esc_attr($k) . '"' . ($k === $current_masthead_category ? ' selected="selected"' : '') . '>' . esc_html($v) . '</option>';
    } ?>
    </select>

    <label for="_position_title">Position</label>
    <input type="text" name="_position_title" style="width:100%" value="<?= sanitize_text_field(get_post_meta($post->ID, '_position_title', true)); ?>" />
  </div>
  <?php
}

/**
 * Saves the masthead meta boxes: currently just one box with two fields: masthead category and position
 *
 * Accepts the WordPress current post ID as an argument
 * @param int $post_ID
 */

function save_masthead_attributes_meta_box($post_ID)
{
    // we don't want to update if WP is running an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (! current_user_can('edit_post', $post_ID)) {
        return;
    }

    // check that nonce exists and is valid before checking for meta box data
    if (
                isset($_POST['masthead-attributes'])
                && wp_verify_nonce(
                    sanitize_key($_POST['masthead-attributes']),
                    plugin_basename(__FILE__)
                )
        ) {
        if (isset($_POST['_position_title'])) {
            update_post_meta($post_ID, '_position_title', wp_kses_post(
                $_POST['_position_title']
            ));
        }
        if (isset($_POST['_masthead_category'])) {
            if ($_POST['_masthead_category'] === "none") {
                delete_post_meta($post_ID, '_masthead_category');
            } else {
                update_post_meta($post_ID, '_masthead_category', wp_kses_post(
                    $_POST['_masthead_category']
                ));
            }
        }
    }
}

/**
 * Saves the student group meta boxes: currently just one field: student affiliation
 *
 * Accepts the WordPress current post ID as an argument
 * @param int $post_ID
 */

function save_lpe_speaker_attributes_meta_box($post_ID)
{
    // we don't want to update if WP is running an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (! current_user_can('edit_post', $post_ID)) {
        return;
    }

    // check that nonce exists and is valid before checking for meta box data
    if (isset($_POST['lpe-speakers-meta'])
                                            && wp_verify_nonce(
                                                sanitize_key($_POST['lpe-speakers-meta']),
                                                plugin_basename(__FILE__)
                                            )
        ) {
        if (isset($_POST['_school_affiliation'])) {
            update_post_meta($post_ID, '_school_affiliation', wp_kses_post(
                $_POST['_school_affiliation']
            ));
        }
        if (isset($_POST['_speaker_location'])) {
            update_post_meta($post_ID, '_speaker_location', wp_kses_post(
                $_POST['_speaker_location']
            ));
        }
    }
}

/**
 * Add AJAX capability to delete syllabi elements
 */
function syllabi_updates()
{
    $postid = isset($_POST['postid']) ? $_POST['postid'] : '';
    if ($postid && wp_verify_nonce(
        sanitize_key($_POST['syllabi_nonce']),
        plugin_basename(__FILE__)
    )) {
        $status = delete_post_meta($postid, '_syllabus_attachment') ? 'Success' : 'Error';
    } else {
        $status = 'That nonce and/or post ID is not valid.';
    }
    
    // important to die in AJAX operations
    die($status);
}

add_action('wp_ajax_syllabi_updates', __NAMESPACE__.'\syllabi_updates');

/**
 * Time to get the syllabi meta set up
 */

function syllabi_meta_boxes($post)
{
    wp_nonce_field(plugin_basename(__FILE__), 'syllabi_nonce');
    
    $file_array = get_post_meta(get_the_ID(), '_syllabus_attachment', true);

    $syllabus_title = is_array($file_array) ? basename($file_array['file']) : '';
    $syllabus_url = is_array($file_array) ? $file_array['url'] : '';
    $ajax_url = admin_url('admin-ajax.php'); ?>

    <div class="editor-syllabi-meta">
        <input type="hidden" value="<?= $post->ID; ?>" id="ajax_postid">
        <input type="hidden" value="<?= $ajax_url; ?>" id="admin_ajax">
        <label>Professor</label>
		<input type="text" name="_professor"
			value="<?= esc_attr(get_post_meta($post->ID, '_professor', true)); ?>" />
		<label>School Affiliation</label>
		<input type="text" name="_school_affiliation"
            value="<?= esc_attr(get_post_meta($post->ID, '_school_affiliation', true)); ?>" />
        <p class="description upload-control">Upload syllabus PDF here.</p>
        <input class="upload-control" type="file" id="_syllabus_attachment" name="_syllabus_attachment" value="" size="25" />
        <?php if ($syllabus_title != '') : ?>
            <p>Current syllabus: <a href="<?= $syllabus_url ?>"><?= $syllabus_title ?></a></p>
            <button id="remove-syllabus">Remove Syllabus</button>
        <?php endif; ?>
    </div>
     
    <?php
}

// Register the function for saving lpe_speaker meta fields
if (! function_exists('save_syllabi_meta_box')) {
    add_action(
        'publish_post_syllabi',
        __NAMESPACE__.'\save_syllabi_meta_box'
    );
    add_action(
        'save_post_syllabi',
        __NAMESPACE__.'\save_syllabi_meta_box'
    );
}

add_action('post_edit_form_tag', function () {
    echo ' enctype="multipart/form-data"';
});

/**
 * Saves the syllabi meta boxes: PDF attachment, professor, student affiliation
 *
 * Accepts the WordPress current post ID as an argument
 * @param int $post_ID
 */

function save_syllabi_meta_box($post_ID)
{
    // we don't want to update if WP is running an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (! current_user_can('edit_post', $post_ID)) {
        return;
    }

    // check that nonce exists and is valid before checking for meta box data
    if (isset($_POST['syllabi_nonce'])
            && wp_verify_nonce(
                sanitize_key($_POST['syllabi_nonce']),
                plugin_basename(__FILE__)
            )
        ) {
        if (isset($_POST['_school_affiliation'])) {
            update_post_meta($post_ID, '_school_affiliation', wp_kses_post(
                $_POST['_school_affiliation']
            ));
        }
        if (isset($_POST['_professor'])) {
            update_post_meta($post_ID, '_professor', wp_kses_post(
                $_POST['_professor']
            ));
        }

        // Make sure the file array isn't empty
        if (!empty($_FILES['_syllabus_attachment']['name'])) {
            
            // Setup the array of supported file types. In this case, it's just PDF.
            $supported_types = array('application/pdf');
            
            // Get the file type of the upload
            $arr_file_type = wp_check_filetype(basename($_FILES['_syllabus_attachment']['name']));
            $uploaded_type = $arr_file_type['type'];
            
            // Check if the type is supported. If not, throw an error.
            if (in_array($uploaded_type, $supported_types)) {

                // Use the WordPress API to upload the file
                $upload = wp_upload_bits($_FILES['_syllabus_attachment']['name'], null, file_get_contents($_FILES['_syllabus_attachment']['tmp_name']));
        
                if (isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                } else {
                    add_post_meta($post_ID, '_syllabus_attachment', $upload);
                    update_post_meta($post_ID, '_syllabus_attachment', $upload);
                } // end if/else
            } else {
                wp_die("The file type that you've uploaded is not a PDF.");
            } // end if/else
        } // end if
    }
}
