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
    Route::get('/activities/clearcurrent', 'ActivityController@clearCurrent')->name('activities.clearcurrent');
    Route::get('/activities/setascurrent/{activity}', 'ActivityController@setCurrent')->name('activities.setcurrent');
    Route::get('/activities/participants/{activity}', 'ParticipantController@byActivity')->name('participants.byactivity');
    Route::resource('participants', 'ParticipantController');
    Route::resource('activity_participants', 'ActivityParticipantController');
    Route::resource('events', 'ActivityController');
    Route::resource('jobtitles', 'JobtitleController');
    Route::resource('divisions', 'DivisionController');
    Route::resource('activities', 'ActivityController');
    Route::resource('roles', 'RoleController');
    Route::get('/regions', 'RegionDivisionController@index');
    // Route::get('/api/participants', 'ParticipantController@getData');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
