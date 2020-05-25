<?php

namespace Modules\Media\Models\Artist;


use Modules\Media\Models\Image\ImageFile;
use Modules\Shared\Models\BaseModel;

/**
 * @property mixed aliases
 * @property mixed songs
 * @property string avatar_id
 */
class Artist extends BaseModel
{

    protected $hidden = [
        'created_at',
        'created_by_id',
        'deleted_at',
        'deleted_by_id',
        'updated_at',
        'updated_by_id'
    ];

    protected $with = ['aliases'];

    public function aliases()
    {
        return $this->hasMany(ArtistAlias::class);
    }

    public function avatar()
    {
        return $this->belongsTo(ImageFile::class, 'avatar_id');
    }

    public function getSongsAttribute()
    {
        return $this->aliases->flatMap(function ($alias) {
            return $alias->songs()->with('artistAliases')->get();
        })->unique('id')->values();
    }

    public function getAlbumsAttribute()
    {
        return $this->aliases->flatMap(function ($alias) {
            return $alias->albums()->with('artistAliases')->get();
        })->unique('id')->values();
    }

    public function getClipsAttribute()
    {
        return $this->songs->map(function ($song) {
            return $song->clip;
        })->whereNotNull()->unique('id')->values();
    }
}
