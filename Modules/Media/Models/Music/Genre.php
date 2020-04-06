<?php


namespace Modules\Media\Models\Music;


use Modules\Shared\Models\BaseModel;
use Modules\Shared\Models\Pivots\BasePivot;

class Genre extends BaseModel
{
    public function songs()
    {
        return $this->belongsToMany(Song::class)
            ->using(BasePivot::class)
            ->withTimestamps();
    }
}
