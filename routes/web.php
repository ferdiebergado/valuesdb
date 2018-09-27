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

Route::group(['prefix' => 'values'], function () {
    Route::get('/', function () {
        return view('search');
    })->name('search');
    Route::post('/searchresults', 'ParticipantController@search')->name('participants.search');
    Route::post('/avatar', 'ImageController@store')->name('participants.avatar');
    Route::resource('participants', 'ParticipantController');
    Route::resource('events', 'ActivityController');
    Route::resource('jobtitles', 'JobtitleController');
    Route::resource('divisions', 'DivisionController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
