<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home',[ 'as'=>'home','uses'=>'HomeController@index']);


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


//Admin routes
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

    //COMMENTS


});