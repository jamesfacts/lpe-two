<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class ScholarsTemplate extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-emerging-scholars'
    ];

    public static $scholarsDirectory;

    public static $scholarCount;

    public function __construct()
    {
        if (function_exists('get_field')) {
            $placeholder = (object)[
                'placeholder' => true,
                'workshop_title' => '',
                'workshop_scholars' => '',
                'workshop_readers' => '',
            ];

            self::$scholarsDirectory = collect(get_field('scholars_directory'))->map(function ($item, $index) {
                if (in_array($index, [2, 5, 10])) {
                    $texture = 'LPE_TextureRound' . rand(2, 3) . '.png';
                    
                    return (object)[
                        'placeholder' => $texture,
                        'index' => $index,
                        'workshop_title' => $item['workshop_title'],
                        'workshop_scholars' => $item['workshop_scholars'],
                        'workshop_readers' => $item['workshop_readers'],
                    ];
                } else {
                    return (object)[
                        'index' => $index,
                        'workshop_title' => $item['workshop_title'],
                        'workshop_scholars' => $item['workshop_scholars'],
                        'workshop_readers' => $item['workshop_readers'],
                    ];
                }
            });

            self::$scholarCount = count(self::$scholarsDirectory);
        }
    }

    public function scholarItems()
    {
        if (count(self::$scholarsDirectory) > 0) {
            return self::$scholarsDirectory;
        }

        return false;
    }

    public function scholarItemsThreeCol()
    {
        if (self::$scholarCount > 0) {
            return ceil(self::$scholarCount / 3);
        }
        
        return false;
    }

    public function scholarItemsFourCol()
    {
        if (self::$scholarCount > 0) {
            return ceil(self::$scholarCount / 4);
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
            'scholarItems' => $this->scholarItems(),
            'scholarItemsThreeCol' => $this->scholarItemsThreeCol(),
            'scholarItemsFourCol' => $this->scholarItemsFourCol()
        ];
    }
}
