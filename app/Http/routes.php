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
	return redirect('/activities');
    //return view('home');
});

Route::auth();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/activities/join', 'ActivitiesController@showJoin');
	Route::get('/activities/{id}/join', 'ActivitiesController@join');
	Route::get('/api/activities/join', 'ActivitiesController@showJoinJson');
	Route::get('/api/activities/{id}/join-list', 'ActivitiesController@showJoinListJson');
	Route::get('/api/activities/join/{id}/{status}', 'ActivitiesController@saveJoinStatus');
});
Route::resource('/activities', 'ActivitiesController', ['only' => ['index', 'show',]]);
Route::get('/api/activities', 'ActivitiesController@showIndexJson');

Route::get('/api/parent/search', 'ParentController@showSearchJson');
Route::get('/parent', 'ParentController@index');
Route::post('/parent', 'ParentController@search');

Route::group(['middleware' => 'admin', 'prefix' => 'member', 'namespace' => 'Member'], function () {
	Route::get('/', 'MemberController@showHome');

	Route::resource('/activities', 'ActivitiesController');
	Route::resource('/activities-category', 'ActivitiesCategoryController');

	/*Route::group(['middleware' => 'student'], function () {
		Route::get('/activities/join', 'ActivitiesController@showJoin');
		Route::post('/activities/join', 'ActivitiesController@saveJoin');
	});

	Route::group(['middleware' => 'admin'], function () {
		Route::resource('/activities', 'ActivitiesController', ['only' => [
			'create',
		]]);
	});*/
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/member', 'namespace' => 'Member'], function () {
	Route::get('/activities', 'ActivitiesController@showIndexJson');
	Route::get('/activities-category', 'ActivitiesCategoryController@showIndexJson');
});