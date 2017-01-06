<?php

namespace App\Users\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = bcrypt($password);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->orderBy('priority', 'asc');
    }

    public function topics()
    {
        return $this->hasMany(\App\Forums\Models\Topic::class);
    }

    public function replies()
    {
        return $this->hasMany(\App\Forums\Models\Reply::class);
    }

    public function hasRole($roleSlug)
    {
        foreach($this->roles as $role) {
            if($role->slug == $roleSlug) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permSlug)
    {
        foreach($this->roles as $role) {
            foreach($role->permissions as $permissions) {
                if($permission->slug == $permSlug) {
                    return true;
                }
            }
        }
        return false;
    }
}
