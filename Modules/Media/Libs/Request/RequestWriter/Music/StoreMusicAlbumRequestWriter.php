<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Illuminate\Http\UploadedFile;
use Modules\Media\Libs\Request\FileRequest\Saver\FileSaver;
use Modules\Media\Models\Music\ImageFile;
use Modules\Media\Models\Music\MusicAlbum;
use Modules\Shared\Http\Requests\RequestWriter;

class StoreMusicAlbumRequestWriter extends RequestWriter
{
    private ImageFile $imageFile;

    private UploadedFile $file;

    public function __construct($request = null, $entity = null)
    {
        parent::__construct($request, MusicAlbum::class);
        $this->file = $request['albumCoverFile'];
    }

    function write()
    {
        if (isset($this->request['albumCoverFile']))
            $this->saveFile();

        $data = $this->prepareData();

        $this->createOrUpdate($data);
    }

    public function prepareData()
    {
        $data = [
            'music_album_type_id' => $this->request['type'],
            'title' => $this->request['title'],
            'year' => $this->request['year']
        ];

        if (isset($this->imageFile))
            $data['image_file_id'] = $this->imageFile->id;

        return $data;
    }

    public function saveFile()
    {
        $saver = new FileSaver($this->file, 'images/covers', ImageFile::class, auth()->id());
        $this->imageFile = $saver->findOrCreateFile();
    }
}
