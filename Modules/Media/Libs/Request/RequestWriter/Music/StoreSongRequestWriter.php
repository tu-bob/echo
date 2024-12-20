<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Modules\Media\Libs\Request\FileRequest\Saver\ImageFileSaver;
use Modules\Media\Libs\Request\RequestWriter\Traits\ExternalLinkTrait;
use Modules\Media\Models\Image\ImageFile;
use Modules\Media\Models\Music\AudioFile;
use Modules\Media\Models\Music\MusicAlbum;
use Modules\Media\Models\Music\Song;
use Modules\Media\Models\Video\Video;
use Modules\Shared\Http\Requests\RequestWriter;

class StoreSongRequestWriter extends RequestWriter
{
    use ExternalLinkTrait;

    protected AudioFile $audioFile;

    protected ImageFile $coverImageFile;

    protected array $extractedInfo;

    public function __construct($request = null)
    {
        parent::__construct($request, Song::class);
    }

    public function write()
    {
        if (isset($this->request['mp3File'])) {
            $this->extractFileInfo();

            $this->saveAudioFile();
        }

        if (isset($this->request['coverImageFile'])) {
            $this->saveCoverImageFile();
        }

        $data = $this->prepareData();

        $this->createOrUpdate($data);

        $this->manageRelations();
    }

    private function extractFileInfo()
    {
        $getID3 = new \getID3;
        $this->extractedInfo = $getID3->analyze($this->request['mp3File'], null, 'file.mp3');
    }

    public function saveCoverImageFile()
    {
        $saver = new ImageFileSaver($this->request['coverImageFile'], 'cover');
        $this->coverImageFile = $saver->saveFile();
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
            'year' => isset($this->request['year']) && $this->request['year'] ? $this->request['year'] : '',
            'label' => isset($this->request['label']) ? $this->request['label'] : '',
            'allow_download' => $this->request['allow_download']
        ];

        if (isset($this->request['english_title']))
            $data['english_title'] = $this->request['english_title'];

        if (isset($this->request['lyrics']))
            $data['lyrics'] = $this->request['lyrics'];

        if (isset($this->audioFile))
            $data['audio_file_id'] = $this->audioFile->id;

        if (isset($this->coverImageFile))
            $data['cover_image_id'] = $this->coverImageFile->id;

        $extracted = [];
        if (isset($this->extractedInfo['audio'])) {
            $extracted = [
                'bitrate' => isset($this->extractedInfo['audio']['bitrate']) ? $this->extractedInfo['audio']['bitrate'] : 0,
                'sample_rate' => $this->extractedInfo['audio']['sample_rate'],
                'compression_ratio' => isset($this->extractedInfo['audio']['compression_ratio']) ?
                    $this->extractedInfo['audio']['compression_ratio'] : null,
                'channels' => isset($this->extractedInfo['audio']['channels']) ?
                    $this->extractedInfo['audio']['channels'] : null,
                'channel_mode' => isset($this->extractedInfo['audio']['channelmode']) ?
                    $this->extractedInfo['audio']['channelmode'] : null,
                'encoder_options' => isset($this->extractedInfo['audio']['encoder_options']) ?
                    $this->extractedInfo['audio']['encoder_options'] : null,
                'codec' => isset($this->extractedInfo['audio']['codec']) ?
                    $this->extractedInfo['audio']['codec'] : null,
                'encoder' => isset($this->extractedInfo['audio']['encoder']) ?
                    $this->extractedInfo['audio']['encoder'] : null,
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
//            $this->entity = Song::findOrFail($this->request['id']);
//            $this->entity->update($data);
//        } else
//            $this->entity = Song::create($data);
//    }

    private function manageRelations()
    {
        $aliases = isset($this->request['artistAliases']) ? $this->request['artistAliases'] : [];
        $genres = isset($this->request['genres']) ? $this->request['genres'] : [];
        $albums = isset($this->request['albums']) ? $this->request['albums'] : [];

        if (isset($this->audioFile))
            $this->entity->audioFile()->associate($this->audioFile);
        $this->entity->artistAliases()->sync($aliases);
        $this->entity->genres()->sync($genres);
        $this->entity->albums()->sync($albums);
        $this->entity->albums->each(function (MusicAlbum $album) {
            $album->updateArtistAliases();
        });

        $this->attachClip();

        $this->attachLinks();
    }

    private function attachClip()
    {
        if (isset($this->request['clip_src'])) {
            $video = Video::where('id', $this->entity->clip_id)
                ->firstOrNew();

            $video->type = 'clip';

            if (isset($this->coverImageFile)) {
                $video->preview_image_id = $this->coverImageFile->id;
            }

            $video->title = $this->entity->artistAliases->implode('name', ', ');
            $video->title = "{$video->title} - {$this->entity->title}";
            $video->src = $this->request['clip_src'];
            $video->save();

            $this->entity->update(['clip_id' => $video->id]);
        } else {
            $this->entity->update(['clip_id' => null]);
        }
    }

//    private function attachLinks()
//    {
//        $newLinks = isset($this->request['links']) ? $this->request['links'] : [];
//
//        foreach ($newLinks as $resource => $link) {
//            $existing = $this->entity->externalLinks->firstWhere('resource', $resource);
//            if ($existing) {
//                if ($link)
//                    $existing->update([
//                        'link' => $link
//                    ]);
//                else $existing->delete();
//            } else {
//                $externalLink = new ExternalLink([
//                    'resource' => $resource,
//                    'link' => $link,
//                ]);
//                $this->entity->externalLinks()->save($externalLink);
//            }
//        }
//    }
}
