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
        ];
    }
}
