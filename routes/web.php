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


Route::get('setup', [
    'as' => 'setup', 'uses' => 'CameraController@setup'
]);
Route::post('setup', [
    'uses' => 'CameraController@storesetup'
]);


Route::group(['middleware' => ['database']], function () {
    Route::get('/', [
        'uses' => 'CameraController@dashboard'
    ]);
    Route::get('add/{step?}', [
        'as' => 'add', 'uses' => 'CameraController@add'
    ]);
    Route::get('change_view', [
        'as' => 'change_view', 'uses' => 'CameraController@getNextView'
    ]);
    Route::get('change_view_ajax', [
        'as' => 'change_view_ajax', 'uses' => 'CameraController@nextView'
    ]);
});