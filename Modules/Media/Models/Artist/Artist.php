<?php

namespace Modules\Media\Models\Artist;

use App\Models\BaseModel;

class Artist extends BaseModel
{
    public function aliases(){
        return $this->hasMany(ArtistAlias::class);
    }
}
