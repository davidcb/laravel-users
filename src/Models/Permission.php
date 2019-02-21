<?php

namespace Davidcb\Users\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $fillable = ['name', 'code'];

	public function roles() {
		return $this->belongsToMany(Role::class);
	}
}
