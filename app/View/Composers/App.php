<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Navi\Facades\Navi;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
            'lpeContributors' => $this->lpeContributors(),
            'footer_navigation' => $this->footer_navigation(),
            'lower_footer_links' => $this->lower_footer_links(),
            'aboutNavigation' => $this->aboutNavigation(),
        ];
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    public function lpeContributors()
    {
        if (!function_exists('get_field')) {
            return false;
        }

        $contributors = [];

        $contributorsInArticle = get_field('_author', get_the_ID());
            if(is_array($contributorsInArticle)) {
                foreach ($contributorsInArticle as $contributorID) {
                    $contributors[] = (object)[
                        'name' => get_the_title($contributorID),
                        'url' => get_permalink($contributorID),
                        'excerpt' => apply_filters('the_excerpt', get_post_field('post_excerpt', $contributorID)),
                    ];
                }

                return $contributors;
            }

        return false;
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

    /**
     * Returns the lower footer navigation links.
     *
     * @return array
     */
    public function aboutNavigation()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build('about_navigation')->toArray();
    }
    
}
