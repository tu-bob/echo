<?php


namespace Modules\Blog\Models\Post;


use Modules\Media\Models\Image\ImageFile;
use Modules\Shared\Models\BaseModel;

class Post extends BaseModel
{
    public function previewImage()
    {
        return $this->belongsTo(ImageFile::class);
    }
}
