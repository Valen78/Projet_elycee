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

Route::pattern('id', '[0-9]+');

Route::get('/', 'FrontController@index')->name('home');

Route::any('search', 'FrontController@search')->name('home');

Route::get('articles', 'FrontController@showAll')->name('articles');

Route::get('article/{id}', 'FrontController@showPost')->name('articles');

Route::post('comment', 'FrontController@storeComment');

Route::get('le-lycee', 'FrontController@showLycee')->name('le-lycee');

Route::get('mentions-legales', 'FrontController@showMentions')->name('mentions');

Route::get('contact', 'FrontController@showContact')->name('contact');

Route::post('mail-contact', 'FrontController@sendMail');

Route::get('login', 'LoginController@index');

Route::post('login', 'LoginController@login');

Route::any('logout', 'LoginController@logout');

Route::group(['middleware' => ['auth']], function(){

    Route::get('admin','AdminController@index')->name('dashboard');

    Route::get('admin/eleves','AdminController@showStudent')->name('eleves');

    Route::get('admin/liste-qcm','AdminController@showListQCM')->name('qcm');

    Route::get('admin/qcm/{id}', 'AdminController@showQCM')->name('qcm');

    Route::post('admin/score/{id}', 'AdminController@updateScore');

    Route::resource('admin/posts', 'PostController');

    Route::post('admin/posts/status/{datas}', 'PostController@updateStatus');

    Route::resource('admin/fiches', 'QuestionController');

    Route::post('admin/fiches/score', 'QuestionController@storeScore');

    Route::post('admin/fiches/status/{datas}', 'QuestionController@updateStatus');

    Route::resource('admin/fiches/choices', 'ChoiceController');

});
