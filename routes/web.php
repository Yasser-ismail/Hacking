<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();

//home and welcome
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[ 'as'=>'home','uses'=>'HomeController@index']);

//logout
Route::get('/logout', 'Auth\LoginController@logout');


//Admin Group
Route::group(['middleware'=>'admin'], function (){

    Route::get('/admin', function (){
        return view('admin.index');
    });
    //USERS
    Route::resource('users', 'AdminUsersController');

    //POSTS
    Route::resource('posts', 'AdminPostsController');

    //CATEGORIES
    Route::resource('categories', 'AdminCategoriesController');

    //MEDIA
    Route::get('/media/upload', 'AdminMediaController@upload')->name('media.upload');
    Route::resource('media', 'AdminMediaController');
    Route::delete('medias/delete', ['as'=>'medias.delete', 'uses'=>'AdminMediaController@deletemedia']);

    //COMMENTS


});


//auth group
Route::group(['middleware'=>'auth'], function (){
//comments
    Route::resource('comments', 'PostCommentsController');
    Route::post('/comments/search', 'PostCommentsController@search');



    //REPLIES
    Route::resource('comment/replies', 'CommentRepliesController');
    Route::get('comment/replis/{id}', ['as'=>'replies', 'uses'=>'CommentRepliesController@commentreplies']);


});


//post
Route::get('post/{id}', ['as'=>'post.home', 'uses'=> 'AdminPostsController@post']);

