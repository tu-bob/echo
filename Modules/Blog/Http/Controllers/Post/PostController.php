<?php


namespace Modules\Blog\Http\Controllers\Post;


use Modules\Blog\Http\Requests\StorePostRequest;
use Modules\Shared\Http\Controllers\BaseController;

class PostController extends BaseController
{
    public function store(StorePostRequest $request)
    {
        dd($request);
    }
}
