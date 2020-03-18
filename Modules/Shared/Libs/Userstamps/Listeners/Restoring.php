<?php

namespace Modules\Shared\Libs\Userstamps\Listeners;

use Illuminate\Database\Eloquent\Model;

class Restoring
{
    /**
     * When the model is being restored.
     *
     * @return void
     */
    public function handle(Model $model)
    {
        if (! $model->isUserstamping() || is_null($model->getDeletedByColumn())) {
            return;
        }

        $model->{$model->getDeletedByColumn()} = null;
    }
}
