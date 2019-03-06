<?php

namespace Davidcb\Users\Models;

use App\Models\User as UserModel;

class User extends UserModel
{
	protected $fillable = ['role_id'];

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
