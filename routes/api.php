<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Get Clubs
Route::get('clubs','api\ClubController@index')->name('api.club.index');

// Get single club
Route::get('clubs/{id}','api\ClubController@show')->name('api.club.show');

// Create club
Route::post('clubs','api\ClubController@store')->name('api.club.store');

// Update club
Route::put('clubs/{id}','api\ClubController@store')->name('api.club.update');

// Destroy club
Route::delete('clubs/{id}','api\ClubController@destroy')->name('api.club.destroy');;

// get Teams
Route::get('teams','api\TeamsController@index')->name('api.teams.index');


