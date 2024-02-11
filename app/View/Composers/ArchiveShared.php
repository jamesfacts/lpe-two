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
        'archive-lpe_event',
        'archive'
    ];

    public static $category;

    public function twoTierTitle()
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
                                          'taxonomy' => 'speaker_topics',
                                          'archive_slug' => 'speaker-topics',
                                        ],
                                        [ 'endpoint' => 'student-groups',
                                          'cpt_name' => 'student_group',
                                          'taxonomy' => 'speaker_topics',
                                          'archive_slug' => 'speaker-topics',
                                        ],
                                        [ 'endpoint' => 'syllabi',
                                          'cpt_name' => 'syllabi',
                                          'taxonomy' => 'speaker_topics',
                                          'archive_slug' => 'speaker-topics',
                                        ],
                                        [ 'endpoint' => 'primers',
                                          'cpt_name' => 'primers',
                                          'taxonomy' => 'speaker_topics',
                                          'archive_slug' => 'speaker-topics',
                                        ],
                                    ];

    public static $archiveSlug;
    public static $archiveTitle;
    public static $archiveCopy;
    public static $archiveTax;

    public function __construct()
    {
        $currentName = get_queried_object()->name;
        $currentTax = get_queried_object()->taxonomy;

        foreach( self::$archiveOptions as $archiveOption ) {
            if( $archiveOption['taxonomy'] == $currentTax || $archiveOption['cpt_name'] == $currentName ){
                self::$archiveTax = $archiveOption['taxonomy'];
                self::$archiveSlug = $archiveOption['archive_slug'];
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

        if( is_archive() && ( get_post_type() == 'lpe_author' ) ) {
            return 'LPE Contributors';
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

        if($postType == 'lpe_author') {
            return [
                'prev_text' => 'Further Contributors',
                'next_text' => 'Previous Contributors'
            ];            
        }

        if($postType == 'student_group') {
            return [
                'prev_text' => 'Further Groups',
                'next_text' => 'Previous Groups'
            ];            
        }

        if($postType == 'lpe_speaker') {
            return [
                'prev_text' => 'Further Speakers',
                'next_text' => 'Previous Speakers'
            ];            
        }

        if($postType == 'syllabi') {
            return [
                'prev_text' => 'Further Syllabi',
                'next_text' => 'Previous Syllabi'
            ];            
        }

        if($postType == 'primers') {
            return [
                'prev_text' => 'Further Primers',
                'next_text' => 'Previous Primers'
            ];            
        }

        if($postType == 'lpe_event') {
            return [
                'prev_text' => 'Older Events',
                'next_text' => 'Newer Events'
            ];            
        }

        return [
            'prev_text' => 'Further Posts',
            'next_text' => 'Previous Posts'
        ];
    }

    public function archiveTaxDropdown()
    {
        $args = self::$archiveTax;

        $topics = get_terms($args);
        // minimum posts in category to display category
        $min_count = 1;

        // $html = '<div class="dropdown">';
        // $html .= '<button class="btn speakers-dropdown dropdown-toggle" type="button" id="dropdownMenuSpeakersCats" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        // $html .= 'Speaker Topics';
        // $html .= '</button>';
        // $html .= ' <div class="dropdown-menu" aria-labelledby="dropdownMenuSpeakersCats">';

        
        return collect($topics)->map(function ($topic) {
            if( $topic->count > $min_count ) {
                return (object) [
                    'name' => $topic->name,
                    'url' => home_url('/') . self::$archiveSlug . '/' . $topic->slug,
                ];   
            }
        });
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
            'twoTierTitle' => $this->twoTierTitle(),
            'archiveTaxDropdown' => $this->archiveTaxDropdown(),
        ];
    }
}
