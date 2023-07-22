<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
        'partials.content',
        'partials.content-*',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => $this->title(),
            'contributor' => $this->contributor(),
            'postCategories' => $this->postCategories(),
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function title()
    {
        if ($this->view->name() !== 'partials.page-header') {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Latest Posts', 'sage');
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf(
                /* translators: %s is replaced with the search query */
                __('Search Results for %s', 'sage'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }

    /**
     * Are there any contributors available here?
     */

     public function contributor()
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
                     ];
                 }
 
                 return $contributors;
             }
 
         return false;
     }

    /**
    * Return a Laravel collection of categories that a post belongs to.
    * @return object
    */

    public function postCategories()
    {
        if (is_archive()) {
            // no category output inside archive pages
            return false;
        } else {
            $categories = collect(get_the_category())->filter(
                function ($category) {
                    return $category->slug !== 'uncategorized';
                }
            )
        ->map(function ($category) {
            $lpeCategory = (object) [
             'name' => $category->name,
             'slug' => $category->slug,
             'link' => home_url('/') . $category->taxonomy . '/' . $category->slug
           ];
            return $lpeCategory;
        });

            wp_reset_postdata();

            return $categories->isEmpty() ? false : $categories;
        }
    }
 

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            //
        ];
    }
}
