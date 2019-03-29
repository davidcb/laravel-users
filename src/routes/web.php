<?php

Route::group(['namespace' => 'Davidcb\Users\Http\Controllers', 'prefix' => 'admin', 'as' => 'admin.'], function() {
	Route::resource('users', 'UserController');
	Route::resource('roles', 'RoleController');
});