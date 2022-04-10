<?php
/**
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru>
 */

namespace App\Models;

use App\Enums\RoleableType;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Shared\Models\BaseModel;
use Modules\Shared\Pivots\BaseMorphPivot;

class Role extends BaseModel
{
    protected static function boot()
    {
        parent::boot();

        Relation::morphMap([
            RoleableType::User->value => User::class
        ]);
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'roleable')
            ->using(BaseMorphPivot::class)
            ->withTimestamps();
    }
}
