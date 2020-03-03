<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Libs\Ulid\HasUlid;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel  extends Model
{
    use HasUlid, SoftDeletes;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static $snakeAttributes = false;

    protected $casts = ['id' => 'string'];

    protected $guarded = [];
}
