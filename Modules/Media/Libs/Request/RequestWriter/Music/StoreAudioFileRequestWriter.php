<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use App\Libs\Helpers\StringHelpers\RandomStringGenerator;
use App\Libs\Ulid\Ulid;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Libs\Request\MetaDataEditor\AudioFileMetaData;
use Modules\Media\Libs\Request\RequestWriter\RequestWriter;
use Modules\Media\Models\Music\AudioFile;

class StoreAudioFileRequestWriter extends RequestWriter
{
    private $file;

    private $audioFile;

    private AudioFileMetaData $metaDataEditor;

    private $tags;

    public function __construct($file, $tags)
    {
        $this->file = $file;
        $this->audioFile = new AudioFile($file->path());
        $this->tags = $tags;

        $this->metaDataEditor = new AudioFileMetaData($this->audioFile, $tags);
    }

    public function write()
    {
        $this->updateTags();

        $this->saveFile();
    }

    function updateTags()
    {
        $this->metaDataEditor->mergeTags();
        $this->metaDataEditor->writeTags();
    }

    public function saveFile()
    {
        $path = 'music/' . RandomStringGenerator::generate(4);
        $fileName = $this->createFileName($path);
        return Storage::disk('local')->putFileAs($path, $this->file, $fileName);
    }

    public function createFileName($path)
    {
        $generator = new Ulid();
        $fileName = $generator->generate() . '.mp3';

        if (Storage::disk('local')->exists($path . '/' . $fileName)) {
            return $this->createFileName($path);
        } else return $fileName;
    }
}
