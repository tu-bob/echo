<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Modules\Media\Libs\Request\RequestWriter\RequestWriter;
use Modules\Media\Models\Music\AudioFile;
use Modules\Media\Models\Music\Song;

class StoreSongRequestWriter extends RequestWriter
{
    protected Song $song;

    protected AudioFile $audioFile;

    protected array $extractedInfo;

    public function write()
    {
        $this->extractFileInfo();

        $this->saveAudioFile();

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
        return [
            'audio_file_id' => $this->audioFile->id,
            'title' => $this->request['title'],
            'year' => $this->request['year'],
            'label' => $this->request['label'],
            'lyrics' => $this->request['lyrics'],
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
            'extension' => $this->extractedInfo['fileformat'],
            'uploaded_by_id' => auth()->user()->id
        ];
    }

    private function createOrUpdate($data)
    {
        if (isset($this->request['id']))
            $this->song = Song::where('id', $this->request['id'])
                ->update($data)
                ->get();
        else
            $this->song = Song::create($data);
    }

    private function manageRelations()
    {
        $this->song->audioFile()->associate($this->audioFile);
        $this->song->artistAliases()->sync($this->request['artistAliases']);
    }

}
