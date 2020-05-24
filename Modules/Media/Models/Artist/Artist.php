<?php

namespace Modules\Media\Models\Artist;


use Modules\Shared\Models\BaseModel;

/**
 * @property mixed aliases
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

    public function getSongsAttribute()
    {
        return $this->aliases->flatMap(function ($alias) {
            return $alias->songs()->with('artistAliases')->get();
        })->unique('id')->values();
    }

    public function getAlbumsAttribute()
    {
        return $this->aliases->flatMap(function ($alias) {
            return $alias->albums;
        })->unique('id')->values();
    }
}
