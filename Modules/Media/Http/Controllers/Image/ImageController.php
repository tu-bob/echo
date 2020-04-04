<?php


namespace Modules\Media\Http\Controllers\Image;


use Modules\Media\Libs\Request\FileRequest\Saver\ImageFileSaver;
use Modules\Media\Models\Image\ImageFileProvider;
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
            $saver = new ImageFileSaver($file, 'blog');
            $images[] = $saver->saveFile();
        }

        return $images;
    }

    public function getImage($image, $type)
    {
        $provider = new ImageFileProvider($type);
        return $provider->getFileResponse($image);
    }
}
