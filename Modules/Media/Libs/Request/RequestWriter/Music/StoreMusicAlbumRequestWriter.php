<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Modules\Media\Libs\Request\FileRequest\Saver\ImageFileSaver;
use Modules\Media\Models\Image\ImageFile;
use Modules\Media\Models\Music\MusicAlbum;
use Modules\Shared\Http\Requests\RequestWriter;

class StoreMusicAlbumRequestWriter extends RequestWriter
{
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
        $saver = new ImageFileSaver($this->request['albumCoverFile'], 'albumCover');
        $this->imageFile = $saver->saveFile();
    }

    private function manageRelations()
    {
        $songs = isset($this->request['songs']) ? $this->request['songs'] : [];

        $this->entity->songs()->sync($songs);

        $this->attachArtistAliases();
    }

    private function attachArtistAliases()
    {
        $this->entity->songs->load('artistAliases');

        $aliases = $this->entity->songs->map(function ($song) {
            return $song->artistAliases;
        })->flatten();

        $uniqueAliases = [];

        foreach ($aliases as $alias) {
            if (isset($uniqueAliases[$alias->id])) {
                $uniqueAliases[$alias->id]['artist_songs_count'] = $uniqueAliases[$alias->id]['artist_songs_count'] + 1;
            } else {
                $uniqueAliases[$alias->id] = ['artist_songs_count' => 1];
            }
        }

        $this->entity->artistAliases()->sync($uniqueAliases);

//        if ($this->entity->songs->count() > 0) {
//
//
//            foreach ($this->entity->songs as $song) {
//                if(isset($aliases[]))
//            }
//        }
    }
}
