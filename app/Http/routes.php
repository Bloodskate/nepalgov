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

Route::group(['middleware' => ['web']], function () {

	Route::group(['middleware' => ['auth']], function () {
	    
	    Route::resource('ministries', 'MinistryController');

		Route::get('ministries/new/1', array(
			'as'	=>		'ministries.firstForm',
			'uses'	=> 		'MinistryController@getFirst'
		));

		Route::post('ministries/new/1', array(
			'as' 	=> 		'ministries.firstFormPost',
			'uses'  => 		'MinistryController@postFirst'
		));

		Route::get('ministries/new/2', array(
			'as'	=>		'ministries.ministryForm',
			'uses'  =>		'MinistryController@getMinistryForm'
		));

		Route::post('ministries/new/2', array(
			'as'	=>		'ministries.ministryFormPost',
			'uses'	=>		'MinistryController@postMinistryForm'
		));
		
		

	});
	
	Route::auth();
	
	Route::get('/', function () {
	    return view('welcome');
	});


});


