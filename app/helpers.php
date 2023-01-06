<?php

namespace App;

/**
 * Theme helpers.
 */

 /**
 * This function should return a URL directly to the filler image of the specified size
 * @return string
 */

/**
 * Define the arguments our endpoint receives.
 */
function lpe_project_get_search_args()
{
    $args = [];
    $args['s'] = [
       'description' => esc_html__('The search term.', 'namespace'),
       'type'        => 'string',
   ];

    return $args;
}

/**
 * Use the request data to find the posts we
 * are looking for and prepare them for use
 * on the front end.
 */
function lpe_project_ajax_search($request)
{
    $posts = [];
    $results = [];
    // check for a search term
    if (isset($request['s'])) {
        // get posts
        $posts = get_posts([
        'posts_per_page' => 5,
        'post_type' => ['lpe_author'],
        's' => $request['s'],
        'orderby'=> 'title',
        'order' => 'ASC'
      ]);
        // set up the data I want to return
        foreach ($posts as $post) {
            $results[] = [
          'title' => $post->post_title,
          'link' => get_permalink($post->ID)
        ];
        }
    }

    if (empty($results)) {
        return new \WP_Error('front_end_ajax_search', 'Sorry, no matching author found.');
    }

    return rest_ensure_response($results);
}


function filler_image($filler_type = '', $width = 'full')
{
    switch ($filler_type) {
            case 'thumb':
                $filler_set = 'lpe_thumb_filler_image_';
                break;
            case 'header':
                $filler_set = 'header_filler_images';
                $array_container = 'filler_header_image';
                break;
            default:
                $filler_set = 'lpe_filler_image_';
                break;
        };

    if( function_exists('get_field') && get_field( $filler_set, 'options' ) ){
        $images_avail = get_field($filler_set, 'options' );
        $image_count = count($images_avail);
        $image_selected = $images_avail[rand(0, ($image_count-1))];
        
        return (object)[
            'url' => $image_selected[$array_container]["url"],
        ];
    }

    return false;
}

function sort_authors_by_last_name_asc($a, $b)
{

    // elements are called by 'a' and 'b' because those characters are used
    // to build new variable names for the final sort comparison
    $sorted_elements  = ['a','b'];
    foreach ($sorted_elements as $sorted_element) {
        $author = $$sorted_element;
        $author_name = $author->post_title;

        switch ($author_name) {

        default:
          $words_array = explode(' ', $author_name);
          ${"last_word_" . $sorted_element} = array_pop($words_array);
      }
    }

    if ($a->post_title === $b->post_title) {
        return 0;
    }

    return ($last_word_a < $last_word_b) ? -1 : 1;
}

/**
 * Is our event in the future?
 *
 * Expects a UTC value
 * Returns a boolean
 */

 function future_date($date)
 {
     $tz = new \DateTimeZone('America/New_York');
     $event_time = \DateTime::createFromFormat('U', $date);

     $current_time = new \DateTime('now', $tz);
     //get the offset from UTC to NY, convert to php interval
     $offset_in_seconds = \abs($current_time->getOffset());
     //offset events by two hours
     $offset_in_seconds += 7200;
     $offset_interval = new \DateInterval('PT' . $offset_in_seconds . 'S');

     //match eventTime to time in NY to see if event has started
     $event_time->setTimezone($tz);
     $event_time->add($offset_interval);

     if ($event_time > $current_time) {
         return true;
     } else {
         return false;
     }

     return false;
 }

 /**
  * What if we need to reformat a date for frontend display?
  */

function frontend_date($date, $line_break = false)
{
    $int_time = strtotime($date);

    if ($line_break === true) {
        return join(
            [ date('M d', $int_time), ',<br/>', date('Y', $int_time) ]
        );
    }

    return date('M d, Y', $int_time);
}

 /**
  * What if we need to reformat a date for frontend display?
  */

  function frontend_multiday_date($start_date, $end_date, $line_break = false)
  {
      $int_start_time = strtotime($start_date);
      $int_end_time = strtotime($end_date);

      return join(
          [ date('M d', $int_start_time), '-', date('d', $int_end_time), date(', Y', $int_end_time) ]
      );
  }

function trim_str_by_words($limit, $post_id=null)
{
    if ($post_id == null) {
        $the_excerpt = get_the_excerpt();
    } else {
        $the_excerpt = get_the_excerpt($post_id);
    }

    $excerpt = explode(' ', $the_excerpt, $limit);

    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

    return $excerpt;
}

function amri_weeks()
{
    $args = [
        'post_type' => 'amri_course',
        'post_status' => 'publish',
        'posts_per_page' => -1
      ];

    $query = new \WP_Query($args);
    $all_amri_posts = $query->posts;

    $array_amri_posts = collect($all_amri_posts)->map(function ($post) {
        return $post->ID;
    })->toArray();

    return array_reverse($array_amri_posts);
}

/**
 * Converts an integer to its textual representation.
 * https://stackoverflow.com/questions/2112571/converting-a-number-1-2-3-to-a-string-one-two-three-in-php
 * @param num the number to convert to a textual representation
 * @param depth the number of times this has been recursed
*/
function read_number($num, $depth=0)
{
    $num = (int)$num;
    $retval ="";
    if ($num < 0) // if it's any other negative, just flip it and call again
        return "negative " + readNumber(-$num, 0);
    if ($num > 99) // 100 and above
    {
        if ($num > 999) // 1000 and higher
            $retval .= readNumber($num/1000, $depth+3);

        $num %= 1000; // now we just need the last three digits
        if ($num > 99) // as long as the first digit is not zero
            $retval .= readNumber($num/100, 2)." hundred\n";
        $retval .=readNumber($num%100, 1); // our last two digits
    }
    else // from 0 to 99
    {
        $mod = floor($num / 10);
        if ($mod == 0) // ones place
        {
            if ($num == 1) $retval.="one";
            else if ($num == 2) $retval.="two";
            else if ($num == 3) $retval.="three";
            else if ($num == 4) $retval.="four";
            else if ($num == 5) $retval.="five";
            else if ($num == 6) $retval.="six";
            else if ($num == 7) $retval.="seven";
            else if ($num == 8) $retval.="eight";
            else if ($num == 9) $retval.="nine";
        }
        else if ($mod == 1) // if there's a one in the ten's place
        {
            if ($num == 10) $retval.="ten";
            else if ($num == 11) $retval.="eleven";
            else if ($num == 12) $retval.="twelve";
            else if ($num == 13) $retval.="thirteen";
            else if ($num == 14) $retval.="fourteen";
            else if ($num == 15) $retval.="fifteen";
            else if ($num == 16) $retval.="sixteen";
            else if ($num == 17) $retval.="seventeen";
            else if ($num == 18) $retval.="eighteen";
            else if ($num == 19) $retval.="nineteen";
        }
        else // if there's a different number in the ten's place
        {
            if ($mod == 2) $retval.="twenty ";
            else if ($mod == 3) $retval.="thirty ";
            else if ($mod == 4) $retval.="forty ";
            else if ($mod == 5) $retval.="fifty ";
            else if ($mod == 6) $retval.="sixty ";
            else if ($mod == 7) $retval.="seventy ";
            else if ($mod == 8) $retval.="eighty ";
            else if ($mod == 9) $retval.="ninety ";
            if (($num % 10) != 0)
            {
                $retval = rtrim($retval); //get rid of space at end
                $retval .= "-";
            }
            $retval.=readNumber($num % 10, 0);
        }
    }

    if ($num != 0)
    {
        if ($depth == 3)
            $retval.=" thousand\n";
        else if ($depth == 6)
            $retval.=" million\n";
        if ($depth == 9)
            $retval.=" billion\n";
    }
    return $retval;
}
