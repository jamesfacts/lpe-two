<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Page extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
        'partials.content-page'
    ];

    /**
     * Skinny top image
     * Returns the url of the featured header common image
     * Image is not tied to the featured post, ie, not a "post_thumbnail"
     *
     * @return string
     */

     public function featuredPageImage()
     {
         return \App\filler_image('header');
     }

    /**
     * Check to see if we're in a page that wants to show a menu
     * 
     * @return boolean 
    */

    public function showMenu()
    {
        if ( function_exists('get_field') && !get_field('disable_menu') )
        {
            return true;
        } 

        return false;
    }

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'featuredPageImage' => $this->featuredPageImage(),
            'showMenu' => $this->showMenu(),
        ];
    }
}
