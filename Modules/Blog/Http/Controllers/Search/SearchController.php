<?php


namespace Modules\Blog\Http\Controllers\Search;


use Modules\Blog\Models\Post\Post;

class SearchController
{
    public function search($needle)
    {
        $posts = Post::with('previewImage', 'author')
            ->where('title', 'like', "%{$needle}%")
            ->orWhere('slug', 'like', "%{$needle}%")
            ->orWhere('article', 'like', "%{$needle}%")
            ->limit(8)
            ->get();
        return response()->json(['posts' => $posts], 200);
    }
}
