<?php


namespace Modules\Shared\Database;


use Illuminate\Database\Schema\Blueprint;

class CustomBlueprint extends Blueprint
{
    public function userStamps()
    {
        $this->char('created_by_id', 26)->index();
        $this->char('updated_by_id', 26)->index();
        $this->char('deleted_by_id', 26)->index();
    }
}
