<?php


namespace Modules\Media\Services\image;


use Illuminate\Http\UploadedFile;
use Modules\Media\Libs\Request\FileRequest\Saver\ImageFileSaver;
use Modules\Media\Models\Image\ImageFile;

class AvatarService
{
    /**
     * @param UploadedFile $image
     * @return ImageFile
     */
    public function store(UploadedFile $image): ImageFile
    {
        $imageSaver = new ImageFileSaver($image, 'avatar');
        return $imageSaver->saveFile();
    }
}
