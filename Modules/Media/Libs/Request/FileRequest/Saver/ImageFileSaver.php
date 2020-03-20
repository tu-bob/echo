<?php


namespace Modules\Media\Libs\Request\FileRequest\Saver;


use Illuminate\Http\UploadedFile;
use Modules\Media\Models\Image\ImageFile;
use Modules\Media\Models\Image\ImageFileDirProvider;

class ImageFileSaver
{
    private UploadedFile $file;
    private string $type;

    public function __construct(UploadedFile $file, string $type)
    {
        $this->file = $file;
        $this->type = $type;
    }

    /**
     * @return ImageFile
     */
    public function saveFile()
    {
        $dirProvider = new ImageFileDirProvider($this->type);
        $dirPath = $dirProvider->getDirectory();
        $saver = new FileSaver($this->file, $dirPath, ImageFile::class);
        return $saver->findOrSaveFile(function ($query) use ($dirPath) {
            return $query->where('path', 'like', $dirPath . '%');
        });
    }

//    private function getDirPath()
//    {
//        switch ($this->type) {
//            case 'blog':
//                return 'images/blog';
//            case 'albumCover':
//                return 'images/cover';
//            default:
//                return 'images/public';
//        }
//    }
}
