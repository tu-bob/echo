<?php


namespace Modules\Blog\Models\Post;


use Modules\Shared\Models\BaseModel;

class PostCategory extends BaseModel
{
    public function posts()
    {
        $this->hasMany(Post::class);
    }
}
