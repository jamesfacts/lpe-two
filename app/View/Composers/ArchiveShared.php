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

    public static $archiveOptions = ['speakers', 'student_group'];

    public static $archiveSlug;
    public static $archiveTitle;
    public static $archiveCopy;

    public function __construct()
    {
        $currentName = get_queried_object()->name;

        foreach( self::$archiveOptions as $archiveOption ) {
            var_dump( $archiveOption );
            var_dump( $currentName );
            if( $archiveOption == $currentName ){
                $thisSlug = str_replace('_', '-', $archiveOption);
                var_dump("*********");
                $pageobj = get_page_by_path($thisSlug);
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
        
       return false;
    }

    public function fetchArchiveTitle() {
        if ( !empty(self::$archiveTitle) ) {
            return self::$archiveTitle;
        }

        if( is_archive() ) {
            return get_the_archive_title();
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
