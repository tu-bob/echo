<?php


namespace Modules\Media\Models\Image;


use Illuminate\Support\Facades\Storage;
use Modules\Shared\Http\Responses\FileResponse;

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
        $dirProvider = new ImageFileDirProvider($this->type);
        $dir = $dirProvider->getDirectory();
        return ImageFile::where('path', 'like', $dir . '%')->findOrFail($id);
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

    public function getFileResponse($id)
    {
        $image = $this->getImage($id);
        $response = new FileResponse($image->path, $image->mime_type);
        return $response->generateResponse();
    }
}
