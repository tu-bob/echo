<?php


namespace Modules\Blog\Models\Post;


use Modules\Blog\Models\Author\Author;
use Modules\Media\Models\Image\ImageFile;
use Modules\Shared\Models\BaseModel;

class Post extends BaseModel
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function previewImage()
    {
        return $this->belongsTo(ImageFile::class);
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
