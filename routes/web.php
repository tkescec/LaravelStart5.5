<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home page
Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

// File Manager
Route::group(['middleware' => 'auth'], function () {
    Route::get('/filemanager', 'FileManagerController@show');
    Route::post('/filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
});
// Authorization
Route::get('login', ['as' => 'auth.login.form', 'uses' => 'Auth\SessionController@getLogin']);
Route::post('login', ['as' => 'auth.login.attempt', 'uses' => 'Auth\SessionController@postLogin']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\SessionController@getLogout']);

// Registration
Route::get('register', ['as' => 'auth.register.form', 'uses' => 'Auth\RegistrationController@getRegister']);
Route::post('register', ['as' => 'auth.register.attempt', 'uses' => 'Auth\RegistrationController@postRegister']);

// Activation
Route::get('activate/{code}', ['as' => 'auth.activation.attempt', 'uses' => 'Auth\RegistrationController@getActivate']);
Route::get('resend', ['as' => 'auth.activation.request', 'uses' => 'Auth\RegistrationController@getResend']);
Route::post('resend', ['as' => 'auth.activation.resend', 'uses' => 'Auth\RegistrationController@postResend']);

// Password Reset
Route::get('password/reset/{code}', ['as' => 'auth.password.reset.form', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset/{code}', ['as' => 'auth.password.reset.attempt', 'uses' => 'Auth\PasswordController@postReset']);
Route::get('password/reset', ['as' => 'auth.password.request.form', 'uses' => 'Auth\PasswordController@getRequest']);
Route::post('password/reset', ['as' => 'auth.password.request.attempt', 'uses' => 'Auth\PasswordController@postRequest']);


/*############# ADMININISTRATOR ##############*/
Route::group(['prefix' => 'administrator'], function () {
    // Dashboard
    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
    // Users
    Route::resource('users', 'Admin\UserController');
    // Roles
    Route::resource('roles', 'Admin\RoleController');
    // Pages
    Route::resource('pages', 'Admin\PageController');
    Route::get('/pages/restore/{id}', ['as' => 'pages.restore', 'uses' => 'Admin\PageController@restore']);
    //File Manager
    Route::get('/filemanager', ['as' => 'admin.filemanager', 'uses' => 'Admin\FileManagerController@index']);
});
