<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Illuminate\Http\UploadedFile;
use Modules\Media\Libs\Request\FileRequest\Saver\FileSaver;
use Modules\Media\Libs\Request\MetaDataEditor\FileRequest\AudioFileMetaData;
use Modules\Media\Models\Artist\ArtistAlias;
use Modules\Media\Models\Music\AudioFile;
use Modules\Media\Models\Music\Genre;
use Modules\Shared\Http\Requests\RequestWriter;

class StoreAudioFileRequestWriter extends RequestWriter
{
    private UploadedFile $file;

    private AudioFile $audioFile;

    private AudioFileMetaData $metaDataEditor;

    private array $tags;

    public function write()
    {
        $this->init();

        $this->updateTags();

        $this->saveFileOrGetExisting();

        return $this->audioFile;
    }

    private function init()
    {
        $this->prepareTags();
        $this->file = $this->request['mp3File'];
        $this->audioFile = new AudioFile(['path' => $this->file->path()]);
        $this->metaDataEditor = new AudioFileMetaData($this->audioFile, $this->tags);
    }

    private function prepareTags()
    {
        $aliases = ArtistAlias::whereIn('id', $this->request['artistAliases'])
            ->get()
            ->map(function ($alias) {
                return $alias->name;
            })
            ->all();

        $this->tags = [
            'title' => $this->request['title'],
            'artist' => $aliases,
//            'album' => 'In the garden',
            'band' => $aliases[0],
//            'publisher' => $this->request['label'],
            'genre' => Genre::whereIn('id', $this->request['genres'])
                ->get()
                ->map(function ($genre) {
                    return $genre->name;
                })
                ->all(),
            'year' => $this->request['year'],
            'url_artist' => 'echo.tj'
//            'track_number' => $request->track_number[$key],
//            'bpm'          => $request->bpm[$key],
//            'initial_key'  => $request->initial_key[$key],
        ];

        if(isset($this->request['label']))
            $this->tags['publisher'] = $this->request['label'];
    }

    private function updateTags()
    {
        $this->metaDataEditor->mergeTags();
        $this->metaDataEditor->writeTags();
    }

    private function saveFileOrGetExisting()
    {
        $saver = new FileSaver($this->file, 'music', AudioFile::class);
        $this->audioFile = $saver->saveFile();
    }
}
