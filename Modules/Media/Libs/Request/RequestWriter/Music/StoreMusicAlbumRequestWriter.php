<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Illuminate\Http\UploadedFile;
use Modules\Media\Libs\Request\FileRequest\Saver\FileSaver;
use Modules\Media\Models\Music\ImageFile;
use Modules\Shared\Http\Requests\RequestWriter;

class StoreMusicAlbumRequestWriter extends RequestWriter
{
    private ImageFile $imageFile;

    private UploadedFile $file;

    function write()
    {
        // TODO: Implement write() method.
    }

    public function createOrUpdateAlbum(){}

    public function saveFile(){
        $saver = new FileSaver($this->file, 'images/covers', ImageFile::class, auth()->id());
        $this->imageFile = $saver->findOrCreateFile();
    }
}
