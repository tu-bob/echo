<?php

namespace Modules\Shared\Libs\Userstamps\Listeners;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Creating
{
    /**
     * When the model is being created.
     *
     * @param $model
     * @return void
     */
    public function handle(Model $model)
    {
        if (!$model->isUserstamping() || is_null($model->getCreatedByColumn())) {
            return;
        }

        if (is_null($model->{$model->getCreatedByColumn()})) {
            $model->{$model->getCreatedByColumn()} = Auth::id();
        }

        if (is_null($model->{$model->getUpdatedByColumn()}) && !is_null($model->getUpdatedByColumn())) {
            $model->{$model->getUpdatedByColumn()} = Auth::id();
        }
    }
}
