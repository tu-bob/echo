<?php


namespace Modules\Shared\Models;


class FileModel extends BaseModel
{
    protected $hidden = [
        'path',
        'original_filename',
        'filename',
        'hash',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];

}
