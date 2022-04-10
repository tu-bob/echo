<?php
/**
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru>
 */

namespace Modules\Shared\Pivots;


use App\Libs\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BasePivot extends Pivot
{
    use HasUlid;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';
}
