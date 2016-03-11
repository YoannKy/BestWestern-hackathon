<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
	return redirect('/dashboard');
});

Route::group(['middleware' => ['web']], function () {

	// Authorization
	Route::get('/login', ['as' => 'auth.login.form', 'uses' => 'Auth\SessionController@getLogin']);
	Route::post('/login', ['as' => 'auth.login.attempt', 'uses' => 'Auth\SessionController@postLogin']);
	Route::get('prospect/login', ['as' => 'auth.login.prospect.form', 'uses' => 'Auth\SessionController@getLoginProspect']);
	Route::post('prospect/login', ['as' => 'auth.login.prospect.attempt', 'uses' => 'Auth\SessionController@postLoginProspect']);
	Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\SessionController@getLogout']);

	// Registration
	Route::get('register', ['as' => 'auth.register.form', 'uses' => 'Auth\RegistrationController@getRegister']);
	Route::post('register', ['as' => 'auth.register.attempt', 'uses' => 'Auth\RegistrationController@postRegister']);
	Route::post('prospect/register', ['as' => 'auth.register.prospect.attempt', 'uses' => 'Auth\RegistrationController@postRegisterProspect']);

	// Activation
	Route::get('activate/{code}', ['as' => 'auth.activation.attempt', 'uses' => 'Auth\RegistrationController@getActivate']);
	Route::get('resend', ['as' => 'auth.activation.request', 'uses' => 'Auth\RegistrationController@getResend']);
	Route::post('resend', ['as' => 'auth.activation.resend', 'uses' => 'Auth\RegistrationController@postResend']);

	// Password Reset
	Route::get('password/reset/{code}', ['as' => 'auth.password.reset.form', 'uses' => 'Auth\PasswordController@getReset']);
	Route::post('password/reset/{code}', ['as' => 'auth.password.reset.attempt', 'uses' => 'Auth\PasswordController@postReset']);
	Route::get('password/reset', ['as' => 'auth.password.request.form', 'uses' => 'Auth\PasswordController@getRequest']);
	Route::post('password/reset', ['as' => 'auth.password.request.attempt', 'uses' => 'Auth\PasswordController@postRequest']);

	Route::get('/user/edit', ['as' => 'user.edit', 'uses' => 'UserController@selfedit']);
	Route::get('/user/show', ['as' => 'user.show', 'uses' => 'UserController@selfshow']);
	Route::put('/user/update', ['as' => 'user.update', 'uses' => 'UserController@selfUpdate']);

	// Users
	Route::resource('users', 'UserController');

	// Roles
	Route::resource('roles', 'RoleController');

	Route::get('/map', ['as' => 'map', 'uses' => 'HostelController@index']);
	Route::get('/ambassadors/{name}', ['uses' => 'AmbassadorController@index']);

	// Dashboard
	Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

	Route::get('convs', ['as' => 'convs.list', 'uses' => 'ConvController@index']);

	Route::get('convs/{id_conv}', ['as' => 'convs.show', 'uses' => 'ConvController@show']);

	Route::post('convs/{id_conv}/add', 'ConvController@add');

	Route::get('ambassadors', ['as' => 'ambassadors', 'uses' => 'AmbassadorController@index']);

	Route::get('convs/{id_user}/create', ['as' => 'convs.create', 'uses' => 'ConvController@create']);

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */
