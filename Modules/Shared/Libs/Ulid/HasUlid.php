<?php
namespace Modules\Shared\Libs\Ulid;

trait HasUlid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->id) {
                $generator = new Ulid();
                $model->id = $generator->generate();
            }
        });

        static::saving(function ($model) {
            $originalUlid = $model->getOriginal('id');
            if ($originalUlid !== $model->id) {
                $model->id = $originalUlid;
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }
}
