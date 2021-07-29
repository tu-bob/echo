<?php


namespace Modules\Media\Libs\Request\FileRequest\MetaDataEditor;


use Modules\Media\Models\Music\AudioFile;

class AudioFileMetaData
{
    private AudioFile $file;

    private array $tags;

    public function __construct(AudioFile $file, array $tags)
    {
        $this->file = $file;
        $this->tags = $tags;
    }

    public function mergeTags()
    {
        $this->file->fetchTags();

        $this->tags = array_merge($this->file->tags, $this->tags);
//        foreach ($this->file->tags as $key => $value) {
//            if (!isset($this->tags[$key])) {
//                $this->tags[$key] = implode(' / ', $value);
//            } elseif (is_array($this->tags[$key]))
//                $this->tags[$key] = implode(' / ', $this->tags[$key]);
//
//        }

        return $this->tags;
    }

    public function writeTags()
    {
        $this->tags = collect($this->tags)->map(function ($tag) {
            return is_array($tag) ? implode(' / ', $tag) : $tag;
        })->all();

        $this->file->writeTags($this->tags);
        $this->file->fetchTags();
    }

    public function getFile()
    {
        return $this->file;
    }
}
