<?php


namespace Modules\Blog\Http\Controllers\Post;


use Modules\Blog\Http\Filters\PostFilter;
use Modules\Blog\Http\Requests\RequestWriters\PostRequestWriter;
use Modules\Blog\Http\Requests\PostRequest;
use Modules\Blog\Models\Post\Post;
use Modules\Shared\Http\Controllers\BaseController;

class PostController extends BaseController
{
    public function __construct()
    {
        $admin = [
            'store'
        ];

        $this->middleware('auth')->only($admin);
    }

    public function store(PostRequest $request)
    {
        $writer = new PostRequestWriter($request->all(), Post::class);
        return $writer->write();
    }

    public function getPosts()
    {
        $query = Post::with('previewImage', 'author');
        $filter = new PostFilter(request()->all(), $query);
        return $this->callGetOrPaginate($filter->filter());
    }

    public function getPost($post)
    {
        return Post::with('previewImage', 'author','category')->findOrFail($post);
    }
}
