<?php


namespace Modules\Media\Models\Music;


use Modules\Shared\Models\BaseModel;
use Modules\Shared\Models\Pivots\BasePivot;

class MusicAlbum extends BaseModel
{
    public function songs()
    {
        return $this->belongsToMany(Song::class)
            ->using(BasePivot::class)
            ->withTimestamps();
    }

    public function cover()
    {
        return $this->belongsTo(ImageFile::class, 'image_file_id');
    }
}
