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

    public function fetchArchiveCopy() {
        $query = get_queried_object();

        if( $this->data['archive_page_slug'] ) {
            $pageobj = get_page_by_path($this->data['archive_page_slug']);
            if ( !empty($pageobj) ) {
                return $pageobj->post_content;
            }
        }

        if( is_archive() ) {
            return term_description();
        }
        
       return false;
    }

    public function fetchArchiveTitle() {
        $query = get_queried_object();

        if( $this->data['archive_page_slug'] ) {
            $pageobj = get_page_by_path($this->data['archive_page_slug']);
            if ( !empty($pageobj) ) {
                return $pageobj->post_title;
            }
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
