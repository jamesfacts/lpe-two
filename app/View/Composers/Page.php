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
        'partials.page-header'
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
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'featuredPageImage' => $this->featuredPageImage(),
        ];
    }
}
