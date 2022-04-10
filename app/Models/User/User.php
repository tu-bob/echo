<?php

namespace App\Models\User;


use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Libs\Ulid\HasUlid;
use Laravel\Sanctum\HasApiTokens;
use Modules\Shared\Pivots\BaseMorphPivot;

class User extends Authenticatable
{
    use HasUlid, HasApiTokens, Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'roleable')
            ->using(BaseMorphPivot::class);
    }

    public function isAdmin(): bool
    {
        return null !== $this->roles()->where('name', 'admin')->first();
    }

    public function hasAnyRole(array $roles): bool
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole(string $role): bool
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
