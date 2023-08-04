<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ArchiveStudentGroup extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'archive-student_group'
    ];

    public function fetchSGCopy() {
        $query = get_queried_object();

		$pageobj = get_page_by_path('student-groups');
        return $pageobj->post_content;
    }

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'joinStudentGroupCopy' => $this->fetchSGCopy(),
        ];
    }
}
