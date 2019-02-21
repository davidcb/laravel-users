<?php

namespace Davidcb\Users\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	protected $fillable = ['name', 'email', 'password', 'role_id'];

	protected $hidden = ['password', 'remember_token'];

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
