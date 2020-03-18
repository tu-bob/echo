<?php


namespace Modules\Shared\Models;


use App\Libs\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use HasUlid, SoftDeletes;

    public static $snakeAttributes = false;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $casts = ['id' => 'string'];

    protected $guarded = [];
}
