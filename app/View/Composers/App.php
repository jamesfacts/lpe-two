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
            'featuredHeaderImage' => $this->featuredHeaderImage(),
            'lpeContributors' => $this->lpeContributors(),
            'footer_navigation' => $this->footer_navigation(),
            'lower_footer_links' => $this->lower_footer_links(),
            'aboutNavigation' => $this->aboutNavigation(),
            'shareUrl' => $this->shareUrl(),
            'shareTitle' => $this->shareTitle(),
            'localDev' => $this->localDev(),
        ];
    }

    public function localDev()
    {
        if (str_contains(base_path(), 'jfwhite')) {
            return true;
        }
        return false;
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

    /**
     * Skinny top image
     * Returns the url of the featured header common image
     * Image is not tied to the featured post, ie, not a "post_thumbnail"
     *
     * @return string
     */

     public function featuredHeaderImage()
     {
         return \App\filler_image('header');
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
                    setup_postdata($contributorID);
                    $contributors[] = (object)[
                        'name' => get_the_title($contributorID),
                        'url' => get_permalink($contributorID),
                        'excerpt' => get_the_content( $contributorID ),
                    ];
                    wp_reset_postdata();
                }

                return $contributors;
            }

        return false;
    }

    /**
     * Returns the full url of current page with URL base
     * 
     * @return string
     */
    public static function shareUrl()
    {
        return urlencode(html_entity_decode(get_permalink()));
    }

    /**
     * Get the title of current page encoded for purposes of contructing a link
     * @return string
     */
    public static function shareTitle()
    {
        return urlencode(html_entity_decode(get_the_title()));
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
