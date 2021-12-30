<?php


namespace App\Http\Controllers;


use App\Filters\UserQuery;
use App\Models\User\User;
use Modules\Shared\Http\Controllers\BaseController;

class UserController extends BaseController
{
    public function index(){
        $query = new UserQuery(User::latest());
        return $this->callGetOrPaginate($query);
    }
}
