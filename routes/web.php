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

Route::get('/', 'DiaryController@index');
Route::resource('diary', 'DiaryController');
Route::post('diary/calendar', 'DiaryController@getCalendar');
Route::post('diary/displaydate', 'DiaryController@getDisplayDate');
Route::post('diary/searchdiary', 'DiaryController@searchDiary');

Auth::routes();
Route::get('/logout', function () {
    return redirect('/');
});

Route::get('/profile/{id}', 'UserController@profile');
Route::get('/user/{id}', 'UserController@show')->middleware('auth');
Route::get('/user/{id}/edit', 'UserController@edit')->middleware('auth');
Route::put('/user/{id}', 'UserController@update')->middleware('auth');
Route::delete('/user/{id}', 'UserController@destroy')->middleware('auth');
Route::get('/support/about', 'SupportController@about');
Route::get('/support/contact', 'SupportController@contact');
Route::post('/support/contact', 'SupportController@contact_confirm');
Route::post('/support/contact_commit', 'SupportController@contact_commit');
