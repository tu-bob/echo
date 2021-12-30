<?php


namespace Modules\Blog\Http\Controllers\Post;


use Modules\Blog\Filters\PostQuery;
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
        $query = new PostQuery(Post::with('previewImage', 'author'));
        return $this->callGetOrPaginate($query);
    }

    public function getPost($slugOrId)
    {
        $post = Post::with('previewImage', 'author', 'category')
            ->where('id', $slugOrId)
            ->orWhere('slug', $slugOrId)
            ->firstOrFail();
        if ($post->slug === $slugOrId) {
            $post->view_count += 1;
            $post->save();
        }

        return $post;
    }
}
