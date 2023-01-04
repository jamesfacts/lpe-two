<?php

/**
 * Theme helpers.
 */

 /**
 * This function should return a URL directly to the filler image of the specified size
 * @return string
 */

namespace App;

function filler_image($filler_type = '', $width = 'full')
{
    switch ($filler_type) {
            case 'thumb':
                $customizer_prefix = 'lpe_thumb_filler_image_';
                break;
            case 'header':
                $customizer_prefix = 'lpe_filler_image_';
                break;
            default:
                $customizer_prefix = 'lpe_filler_image_';
                break;
        };


    $image_array = [];

    // we have more thumb fillers than header fillers
    $image_count = ($filler_type === 'thumb') ? 12 : 6;
    static $filler_offset = null;

    for ($x = 1; $x <= $image_count; $x++) {
        $filler_id = get_theme_mod($customizer_prefix . $x);
        if (!empty($filler_id)) {
            $image_array[] = wp_get_attachment_image_src($filler_id, $width)[0];
        }
    }

    $filler_offset = rand(0, (count($image_array) - 1));
    return $image_array[$filler_offset];
}