<?php

namespace Davidcb\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider {

	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/resources/views', 'users');
		$this->loadRoutesFrom(__DIR__ . '/routes/web.php');
	}

	public function register()
	{
		//
	}

}