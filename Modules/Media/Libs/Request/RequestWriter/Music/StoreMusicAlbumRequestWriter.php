<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Modules\Media\Libs\Request\FileRequest\Saver\ImageFileSaver;
use Modules\Media\Libs\Request\RequestWriter\Traits\ExternalLinkTrait;
use Modules\Media\Models\Image\ImageFile;
use Modules\Media\Models\Music\MusicAlbum;
use Modules\Shared\Http\Requests\RequestWriter;

class StoreMusicAlbumRequestWriter extends RequestWriter
{
    use ExternalLinkTrait;

    private ImageFile $imageFile;

    public function __construct($request = null, $entity = null)
    {
        parent::__construct($request, MusicAlbum::class);
    }

    function write()
    {
        if (isset($this->request['albumCoverFile']))
            $this->saveFile();

        $data = $this->prepareData();

        $this->createOrUpdate($data);

        $this->manageRelations();
    }

    public function prepareData()
    {
        $data = [
            'type_id' => $this->request['type'],
            'title' => $this->request['title'],
            'year' => $this->request['year']
        ];

        if (isset($this->imageFile))
            $data['cover_id'] = $this->imageFile->id;

        return $data;
    }

    public function saveFile()
    {
        $saver = new ImageFileSaver($this->request['albumCoverFile'], 'cover');
        $this->imageFile = $saver->saveFile();
    }

    private function manageRelations()
    {
        $songs = isset($this->request['songs']) ? $this->request['songs'] : [];

        $this->entity->songs()->sync($songs);

        $this->attachArtistAliases();

        $this->attachLinks();
    }

    private function attachArtistAliases()
    {
        $this->entity->updateArtistAliases();
    }
}
