<?php


namespace Modules\Media\Models\Music;


use App\Models\BaseModel;

class Song extends BaseModel
{
    public function audioFile()
    {
        return $this->belongsTo(AudioFile::class);
    }
}
