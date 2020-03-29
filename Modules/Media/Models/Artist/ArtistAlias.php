<?php

namespace Modules\Media\Models\Artist;


use Modules\Shared\Models\BaseModel;

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
}
