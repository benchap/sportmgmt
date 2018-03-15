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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clubs', 'ClubController@index');
Route::get('/clubs/{club}', 'ClubController@show');

Route::get('/competitions', 'CompetitionController@index');
Route::get('/competitions/{competition}', 'CompetitionController@show');	

Route::get('/teams', 'TeamsController@index');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
