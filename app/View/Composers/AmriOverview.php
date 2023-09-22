<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class AmriOverview extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-amri-overview.blade'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'part_one_copy' => 'hiiii',
            'part_two_copy' => 'byyye',
        ];
    }
}
