<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ArchiveShared extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.archive-header',
        'archive'
    ];

    public static $category;

    public function taxCategories()
    {
        if (is_tax() || is_category() || is_tag()) {
            self::$category = get_queried_object();
            $cat_type = 'Blog';

            if (self::$category->taxonomy === 'speaker_topics') {
                $cat_type = 'Speakers <br/> Bureau';
            };

            if (self::$category->taxonomy === 'symposia') {
                $cat_type = 'Symposia';
            };

            return (object)[
                'type' => $cat_type,
                'name' => self::$category->name
            ];
        } else {
            return null;
        }
    }

    public static $archiveOptions = [
                                        [ 'endpoint' => 'speakers',
                                          'cpt_name' => 'lpe_speaker',
                                        ],
                                        [ 'endpoint' => 'student-groups',
                                          'cpt_name' => 'student_group',
                                        ],
                                        [ 'endpoint' => 'syllabi',
                                          'cpt_name' => 'syllabi',
                                        ],
                                        [ 'endpoint' => 'primers',
                                          'cpt_name' => 'primers',
                                        ],
                                    ];

    public static $archiveSlug;
    public static $archiveTitle;
    public static $archiveCopy;

    public function __construct()
    {
        $currentName = get_queried_object()->name;

        foreach( self::$archiveOptions as $archiveOption ) {
            if( $archiveOption['cpt_name'] == $currentName ){
                $pageobj = get_page_by_path($archiveOption['endpoint']);
                if ( !empty($pageobj) ) {
                    self::$archiveTitle = $pageobj->post_title;
                    self::$archiveCopy = $pageobj->post_content;
                }
            }
        }

    }

    public function fetchArchiveCopy() {
        if ( !empty(self::$archiveCopy) ) {
            return self::$archiveCopy;
        }

        if( is_archive() ) {
            return term_description();
        }

        if( $this->data['archive_page_slug'] ) {
            $pageobj = get_page_by_path($this->data['archive_page_slug']);
            if ( !empty($pageobj) ) {
                return $pageobj->post_content;
            }
        }
        
       return false;
    }

    public function fetchArchiveTitle() {
        if ( !empty(self::$archiveTitle) ) {
            return self::$archiveTitle;
        }

        if( is_archive() ) {
            return get_the_archive_title();
        }

        if( $this->data['archive_page_slug'] ) {
            $pageobj = get_page_by_path($this->data['archive_page_slug']);
            if ( !empty($pageobj) ) {
                return $pageobj->post_title;
            }
        }
        
       return false;
    }

    public function navOverride() {
        $postType = get_post_type();

        if($postType == 'lpe_video') {
            return [
                'prev_text' => 'Further Videos',
                'next_text' => 'Previous Videos'
            ];            
        }

        return [
            'prev_text' => 'Further Posts',
            'next_text' => 'Previous Posts'
        ];
    }

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'archiveCopy' => $this->fetchArchiveCopy(),
            'archiveTitle' => $this->fetchArchiveTitle(),
            'navOverride' => $this->navOverride(),
        ];
    }
}
