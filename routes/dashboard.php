<?php

use Illuminate\Support\Facades\Route;


Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:super_admin|admin'])->group(function () {

    // welcome route
    Route::get('/', 'DashboardController@index')->name('welcome');

    // categories routes
    Route::resource('categories', 'CategoryController')->except('show');

    // movies route
    Route::resource('movies', 'MovieController');

    // roles route
    Route::resource('roles', 'RoleController')->except('show');

    // users route
    Route::resource('users', 'UserController')->except('show');

    // settings routes
    Route::get('/settings/social_login', 'SettingController@social_login')->name('settings.social_login');
    Route::get('/settings/social_links', 'SettingController@social_links')->name('settings.social_links');
    Route::post('/settings', 'SettingController@store')->name('settings.store');

});
