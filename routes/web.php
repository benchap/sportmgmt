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

//Route::get('/', function () {
//    return view('welcome');
//	});

Route::get('/clubs', 'ClubController@index');					// display all clubs
Route::post('/clubs','ClubController@store');					// create new club
Route::get('/clubs/create', 'ClubController@create');			// display club create form
Route::get('/clubs/update', 'ClubController@update');			// display club update formt
Route::get('/clubs/{club}', 'ClubController@show');				// display club entry

Route::get('/competitions', 'CompetitionController@index');
Route::get('/comp', 'CompetitionController@index');
Route::get('/competitions/create','CompetitionController@create');
Route::get('/competitions/{competition}/edit', 'CompetitionController@edit');			// display comp update formt
Route::post('/competitions/{competition}/teams','TeamsController@store');				// create a team from a competition page.
Route::put('/competitions/{competition}','CompetitionController@update');			
Route::get('/competitions/{competition}', 'CompetitionController@show');	
Route::post('/competitions','CompetitionController@store');

// PaymentGateway Test
Route::post('/teams/{teams}/register/{membership}', 'TeamsMembershipController@store')
	->where(['teams' => '[0-9]+', 'membership' => '[0-9]+']);							// Create membership
Route::get('/teams/{teams}/register/{membership}','TeamsMembershipController@show')		// View membership
	->where(['teams' => '[0-9]+', 'membership' => '[0-9]+']);

Route::get('/teams', 'TeamsController@index');
Route::post('/teams','TeamsController@store');
Route::get('/teams/create','TeamsController@create');									// Create form
Route::get('/teams/{teams}','TeamsController@show');
Route::put('/teams/{teams}','TeamsController@update');									// Update teams + logo upload
Route::get('/teams/{teams}/edit','TeamsController@edit');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

	



