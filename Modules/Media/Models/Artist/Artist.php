<?php

namespace Modules\Media\Models\Artist;


use Modules\Shared\Models\BaseModel;

class Artist extends BaseModel
{
    protected $with = ['aliases'];

    public function aliases(){
        return $this->hasMany(ArtistAlias::class);
    }
}
