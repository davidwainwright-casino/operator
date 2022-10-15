<?php

namespace Wainwright\CasinoDogScanner\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wainwright\CasinoDogScanner\CasinoDogScanner
 */
class CasinoDogScanner extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Wainwright\CasinoDogScanner\CasinoDogScanner::class;
    }
}
