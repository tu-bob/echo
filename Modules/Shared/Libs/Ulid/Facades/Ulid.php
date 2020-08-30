<?php
namespace Modules\Shared\Libs\Ulid\Facades;

use Illuminate\Support\Facades\Facade;

class Ulid extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Libs\Ulid\Ulid::class;
    }
}
