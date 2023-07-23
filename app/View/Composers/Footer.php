<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Navi\Facades\Navi;

class Footer extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.footer',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'footer_navigation' => $this->footer_navigation(),
            'lower_footer_links' => $this->lower_footer_links(),
        ];
    }

    /**
     * Returns the lower footer navigation links.
     *
     * @return array
     */
    public function footer_navigation()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build('main_footer_nav')->toArray();
    }

    /**
     * Returns the lower footer navigation links.
     *
     * @return array
     */
    public function lower_footer_links()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build('lower_footer_nav')->toArray();
    }
}
