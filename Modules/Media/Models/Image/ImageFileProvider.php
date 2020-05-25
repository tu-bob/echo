<?php


namespace Modules\Media\Models\Image;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Shared\Http\Responses\FileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImageFileProvider
{
    private string $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @param $id
     * @return ImageFile
     */
    public function getImage($id)
    {
//        $dirProvider = new ImageFileDirProvider($this->type);
//        $dir = $dirProvider->getDirectory();
        return ImageFile::where('path', 'like', $this->getDirectory() . '%')->findOrFail($id);
    }

    /**
     * @param $id
     * @return string file
     */
    public function getFile($id)
    {
        $image = $this->getImage($id);
        return Storage::get($image->path);
    }

    /**
     * @param $id
     * @return JsonResponse|Response|StreamedResponse
     */
    public function getFileResponse($id)
    {
        $image = $this->getImage($id);
        $response = new FileResponse($image->path, $image->mime_type);
        return $response->generateResponse();
    }

    public function getResizedFileResponse($id, $width = 50, $height = 50, $quality = 90)
    {
        $imgFile = $this->getImage($id);
        $cacheFolder = 'cache/' . $width . $height . '/';
        if (Storage::exists($cacheFolder . $imgFile->path)) {
            $response = new FileResponse($cacheFolder . $imgFile->path, $imgFile->mime_type);
            return $response->generateResponse();
        } else {
            $img = Image::make(storage_path("app/{$imgFile->path}"))->fit($width, $height);
            Storage::disk('local')->put($cacheFolder . $imgFile->path, $img->encode(null, $quality));
//            $img->save(storage_path($cacheFolder .  $imgFile->path));
            return $img->response($imgFile->extension);
        }
    }

    private function getDirectory()
    {
        $dirProvider = new ImageFileDirProvider($this->type);
        return $dirProvider->getDirectory();
    }
}
