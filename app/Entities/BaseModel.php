<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use Libs\Ulid\HasUlid;

class BaseModel  extends Model
{
    use HasUlid;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static $snakeAttributes = false;

    protected $casts = ['id' => 'string'];
}
