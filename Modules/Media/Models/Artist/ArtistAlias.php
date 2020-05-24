<?php

namespace Modules\Media\Models\Artist;


use Modules\Media\Models\Music\MusicAlbum;
use Modules\Media\Models\Music\Song;
use Modules\Shared\Models\BaseModel;
use Modules\Shared\Models\Pivots\BasePivot;

/**
 * @property string name
 */
class ArtistAlias extends BaseModel
{
    protected $hidden = [
        'created_at',
        'created_by_id',
        'deleted_at',
        'deleted_by_id',
        'updated_at',
        'updated_by_id'
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class)
            ->using(BasePivot::class)
            ->withTimestamps()
            ->latest();
    }

    public function albums()
    {
        return $this->belongsToMany(MusicAlbum::class)
            ->using(BasePivot::class)
            ->withPivot('artist_songs_count')
            ->withTimestamps();
    }
}
