<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}', 'PostController@show')->name('home.post');

Route::middleware('auth')->group(function(){

    Route::get('/admin', 'AdminController@index')->name('admin.index');

    Route::get('/admin/posts', 'PostController@index')->name('post.index');
    Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
    Route::post('/admin/posts', 'PostController@store')->name('post.store');
    Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::patch('/admin/posts/{post}', 'PostController@update')->name('post.update');
    Route::delete('/admin/posts/{post}', 'PostController@destroy')->name('post.destroy');

    Route::put('/admin/users/{user}/update', 'UserController@update')->name('user.update.profile');

    Route::delete('/admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');



    Route::post('/comment/reply','CommentRepliesController@createReply')->name('createReply');


});


Route::middleware('role:admin')->group(function(){

    Route::get('/admin/users', 'UserController@index')->name('users.index');
    Route::get('/admin/users/create', 'UserController@create')->name('user.create');
    Route::post('/admin/users', 'UserController@store')->name('user.store');


    Route::put('/admin/users/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::put('/admin/users/{user}/detach', 'UserController@detach')->name('user.role.detach');

    // Category Routes
    Route::resource('/admin/categories','CategoryController');

    //Comments and Replies comments
    Route::resource('/admin/comments','CommentController');
    Route::resource('/admin/comment/replies','CommentRepliesController');


});

Route::middleware(['can:view,user'])->group(function() {

    Route::get('/admin/users/{user}/profile', 'UserController@show')->name('user.show.profile');




});

        //Roles Routs
Route::middleware(['web','auth','role:admin'])->group(function (){

    Route::get('/admin/roles','RoleController@index')->name('roles.index');
    Route::post('/admin/roles','RoleController@store')->name('roles.store');
    Route::get('/admin/roles/{role}/edit','RoleController@edit')->name('roles.edit');
    Route::put('/admin/roles/{role}/update','RoleController@update')->name('roles.update');

    Route::delete('/admin/roles/{role}/destroy','RoleController@destroy')->name('roles.destroy');

    Route::put('/admin/roles/{role}/attach', 'RoleController@attach')->name('role.permission.attach');
    Route::put('/admin/roles/{role}/detach', 'RoleController@detach')->name('role.permission.detach');

});


//Permissions Routs
Route::middleware(['web','auth','role:admin'])->group(function (){

    Route::get('/admin/permissions','PermissionController@index')->name('permissions.index');
    Route::post('/admin/permissions','PermissionController@store')->name('permissions.store');
    Route::get('/admin/permissions/{permission}/edit','PermissionController@edit')->name('permissions.edit');
    Route::put('/admin/permissions/{permission}/update','PermissionController@update')->name('permissions.update');

    Route::delete('/admin/permissions/{permission}/destroy','PermissionController@destroy')->name('permissions.destroy');

});











