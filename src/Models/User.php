<?php

namespace Davidcb\Users\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
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

	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function permissions() {
		return $this->role->permissions;
	}

	public function hasPermissions($action) {
		foreach ($this->permissions() as $perm) {
			if ($perm->code === $action) {
				return true;
			}
		}

		return false;
	}

	public function hasAnyPermission($actions) {
		foreach ($this->permissions() as $perm) {
			if (in_array($perm->code, $actions)) {
				return true;
			}
		}

		return false;
	}

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? app('hash')->make($input) : $input;
        }
    }
}
