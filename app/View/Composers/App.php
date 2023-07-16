<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

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
}
