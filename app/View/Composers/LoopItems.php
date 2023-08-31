<?php
/**
 * Locking these calls to a single post within the loop
 */

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class LoopItems extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-post',
        'partials.content-student_group',
        'partials.content-syllabi',
        'partials.content-primers',
        'partials.content-lpe_event',
        'partials.content-lpe_video',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'postImage' => $this->postImage(),
            'loopContributors' => $this->loopContributors(),
            'loopSyllabi' => $this->loopSyllabi(),
        ];
    }

    public function postImage() {
        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'w450')
                ? get_the_post_thumbnail_url(get_the_ID(), 'w450')
                : \App\filler_image('thumb')["url"];

        $img_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

        return (object) [
            'src' => $img_url,
            'alt' => $img_alt,
        ];
    }

    public function loopContributors() {
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

    public function loopSyllabi() {
        return (object) [
            'name' => get_the_title(get_the_ID()),
            'url' => get_the_permalink(get_the_ID()),
            'excerpt' => get_the_excerpt(),
            'professor' => get_field('syllabus_professor'),
            'school' => get_field('syllabus_school'),
            'download_url' => get_field('syllabus_attachment') ? get_field('syllabus_attachment') : '#'
        ];
    }
    
}
