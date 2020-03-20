<?php


namespace Modules\Media\Http\Controllers\Image;


use Illuminate\Support\Facades\Storage; 
use Modules\Media\Libs\Request\FileRequest\Saver\ImageFileSaver;
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
            $saver = new ImageFileSaver($file, 'blog');
            $images[] = $saver->saveFile();
        }

        return $images;
    }

    //TODO validate dir
    public function getImage($dir, $image)
    {
        $image = ImageFile::where('path', 'like', 'images/' . $dir . '%')->findOrFail($image);
        return Storage::get($image->path);
    }
}
