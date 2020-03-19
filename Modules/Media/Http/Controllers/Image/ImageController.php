<?php


namespace Modules\Media\Http\Controllers\Image;


use Modules\Media\Libs\Request\FileRequest\Saver\FileSaver;
use Modules\Media\Models\Image\ImageFile;
use Modules\Shared\Http\Controllers\BaseController;

class ImageController extends BaseController
{
    public function storeMany()
    {
        $rules = [
            'images' => 'required|array',
            'images.*' => 'required|mimes:jpg,jpeg,png,gif'
        ];

        $data = request()->validate($rules);

        $images = [];

        foreach ($data['images'] as $file) {
            $saver = new FileSaver($file, 'public/blog/images', ImageFile::class);
            $images[] = $saver->findOrSaveFile(function ($query) {
                return $query->where('path', 'like', 'public/blog/images%');
            });
        }

        return $images;
    }
}
