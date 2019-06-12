<?php

namespace DavideCasiraghi\LaravelColumns\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DavideCasiraghi\LaravelColumns\Skeleton\SkeletonClass
 */
class LaravelColumns extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-columns';
    }
}
