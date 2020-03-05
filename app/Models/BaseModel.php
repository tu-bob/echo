<?php


namespace App\Models;


use App\Libs\Helpers\CamelCaseConverter;
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

    public function getAttribute($key)
    {
        return parent::getAttribute(CamelCaseConverter::convertCamelToSnakeCase($key));
    }

    public function setAttribute($key, $value)
    {
        return parent::setAttribute(CamelCaseConverter::convertCamelToSnakeCase($key), $value);
    }
}
