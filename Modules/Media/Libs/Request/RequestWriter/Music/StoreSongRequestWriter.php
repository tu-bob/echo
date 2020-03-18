<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Modules\Media\Models\Music\AudioFile;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Http\Requests\RequestWriter;

class StoreSongRequestWriter extends RequestWriter
{
    protected Song $song;

    protected AudioFile $audioFile;

    protected array $extractedInfo;

    public function __construct($request = null)
    {
        parent::__construct( $request,Song::class);
    }

    public function write()
    {
        if (isset($this->request['mp3File'])) {
            $this->extractFileInfo();

            $this->saveAudioFile();
        }

        $data = $this->prepareData();

        $this->createOrUpdate($data);

        $this->manageRelations();
    }

    private function extractFileInfo()
    {
        $getID3 = new \getID3;
        $this->extractedInfo = $getID3->analyze($this->request['mp3File']);
    }

    private function saveAudioFile()
    {
        $writer = new StoreAudioFileRequestWriter($this->request);
        $this->audioFile = $writer->write();
    }

    private function prepareData()
    {
        $data = [
            'title' => $this->request['title'],
            'year' => $this->request['year'],
            'label' => $this->request['label'],
            'lyrics' => $this->request['lyrics'],
            'uploaded_by_id' => auth()->id()
        ];

        if (isset($this->audioFile))
            $data['audio_file_id'] = $this->audioFile->id;

        $extracted = [];
        if (isset($this->extractedInfo)) {
            $extracted = [
                'bitrate' => $this->extractedInfo['audio']['bitrate'],
                'sample_rate' => $this->extractedInfo['audio']['sample_rate'],
                'compression_ratio' => $this->extractedInfo['audio']['compression_ratio'],
                'channels' => $this->extractedInfo['audio']['channels'],
                'channel_mode' => $this->extractedInfo['audio']['channelmode'],
                'encoder_options' => $this->extractedInfo['audio']['encoder_options'],
                'codec' => $this->extractedInfo['audio']['codec'],
                'encoder' => $this->extractedInfo['audio']['encoder'],
                'lossless' => $this->extractedInfo['audio']['lossless'] ? 1 : 0,
                'size' => $this->extractedInfo['filesize'],
                'playtime_seconds' => $this->extractedInfo['playtime_seconds'],
                'extension' => $this->extractedInfo['fileformat']
            ];
        }

        return array_merge($data, $extracted);
    }

//    private function createOrUpdate($data)
//    {
//        if (isset($this->request['id'])) {
//            $this->song = Song::findOrFail($this->request['id']);
//            $this->song->update($data);
//        } else
//            $this->song = Song::create($data);
//    }

    private function manageRelations()
    {
        $aliases = isset($this->request['artistAliases']) ? $this->request['artistAliases'] : [];
        $genres = isset($this->request['genres']) ? $this->request['genres'] : [];
        $albums = isset($this->request['albums']) ? $this->request['albums'] : [];

        if (isset($this->audioFile))
            $this->song->audioFile()->associate($this->audioFile);
        $this->song->artistAliases()->sync($aliases);
        $this->song->genres()->sync($genres);
        $this->song->albums()->sync($albums);
    }

}
