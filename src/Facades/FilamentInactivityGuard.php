<?php

namespace EightCedars\FilamentInactivityGuard\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EightCedars\FilamentInactivityGuard\FilamentInactivityGuard
 */
class FilamentInactivityGuard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \EightCedars\FilamentInactivityGuard\FilamentInactivityGuard::class;
    }
}
