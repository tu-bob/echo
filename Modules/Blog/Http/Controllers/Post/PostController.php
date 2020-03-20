<?php


namespace Modules\Blog\Http\Controllers\Post;


use Modules\Blog\Http\Requests\RequestWriters\PostRequestWriter;
use Modules\Blog\Http\Requests\StorePostRequest;
use Modules\Blog\Models\Post\Post;
use Modules\Shared\Http\Controllers\BaseController;

class PostController extends BaseController
{
    public function store(StorePostRequest $request)
    {
        $writer = new PostRequestWriter($request->all(), Post::class);
        return $writer->write();
    }
}
