<?php
/**
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru>
 */

namespace Modules\Shared\Pivots;


use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Shared\Libs\Ulid\HasUlid;

class BaseMorphPivot extends MorphPivot
{
    use HasUlid;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
