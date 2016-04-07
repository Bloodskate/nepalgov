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
	    
	    

		

		Route::get('ministries/new/ministry', array(
			'as'	=>		'ministries.ministryForm',
			'uses'  =>		'MinistryController@getMinistryForm'
		));

		Route::post('ministries/new/ministry', array(
			'as'	=>		'ministries.ministryFormPost',
			'uses'	=>		'MinistryController@postMinistryForm'
		));
		
		Route::get('ministries/new/', array(
			'as'	=>		'ministries.firstForm',
			'uses'	=> 		'MinistryController@getFirst'
		));

		Route::post('ministries/new/{id?}', array(
			'as' 	=> 		'ministries.firstFormPost',
			'uses'  => 		'MinistryController@postFirst'
		));

		Route::get('ministries/new/{id}', array(
			'as'	=>		'ministries.newCategory',
			'uses'	=>		'MinistryController@newCategory'
		));

		Route::get('ministries/category', array(
			'as'	=>		'ministries.category',
			'uses'	=>		'MinistryController@category'
		));
		

		Route::resource('ministries', 'MinistryController');

	});
	
	Route::auth();

	Route::get('/api/ministries/all', array(
		'as'	=>		'api.all',
		'uses'	=>		'MinistryController@apiAll'	
	));

	Route::get('/api/ministries/{id}', array(
		'as'	=>		'api.ministry',
		'uses'	=>		'MinistryController@apiMinistry'	
	));
	
	Route::get('/', function () {
	    return view('welcome');
	});


});


