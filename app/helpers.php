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