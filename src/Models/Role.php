<?php

namespace Davidcb\Users\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = ['name', 'code'];

	public function users() {
		return $this->hasMany(User::class);
	}

	public function permissions() {
		return $this->belongsToMany(Permission::class);
	}

	public function hasPermissions($action) {
		foreach ($this->permissions as $perm) {
			if ($perm->code === $action) {
				return true;
			}
		}

		return false;
	}
}
