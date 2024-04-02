<?php

namespace Arthmelikyan\Laramidjourney\Facades;

use Illuminate\Support\Facades\Facade;

class LaraMidjourney extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laramidjourney';
    }
}