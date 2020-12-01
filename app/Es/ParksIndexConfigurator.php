<?php

namespace App\Es;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class ParksIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}
