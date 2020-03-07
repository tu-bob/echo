<?php


namespace Modules\Media\Libs\Request\RequestWriter\Music;


use Illuminate\Http\UploadedFile;
use Modules\Media\Libs\Request\FileRequest\Saver\FileSaver;
use Modules\Media\Libs\Request\MetaDataEditor\FileRequest\AudioFileMetaData;
use Modules\Media\Libs\Request\RequestWriter\RequestWriter;
use Modules\Media\Models\Music\AudioFile;

class StoreAudioFileRequestWriter extends RequestWriter
{
    private UploadedFile $file;

    private AudioFile $audioFile;

    private AudioFileMetaData $metaDataEditor;

    private array $tags;

    public function __construct(UploadedFile $file, array $tags)
    {
        parent::__construct();

        $this->file = $file;
        $this->audioFile = new AudioFile(['path' => $file->path()]);
        $this->tags = $tags;

        $this->metaDataEditor = new AudioFileMetaData($this->audioFile, $tags);
    }

    public function write()
    {
        $this->updateTags();

        $this->saveFileOrGetExisting();

        return $this->audioFile;
    }

    function updateTags()
    {
        $this->metaDataEditor->mergeTags();
        $this->metaDataEditor->writeTags();
    }

    public function saveFileOrGetExisting()
    {
        $saver = new FileSaver($this->file, 'music', AudioFile::class);
        $this->audioFile = $saver->findOrCreateFile();
    }
}
