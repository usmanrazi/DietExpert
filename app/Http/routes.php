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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'MainController@index');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return Redirect::to('/admin/dashboard');
    });

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'Admin\DashboardController@index']);

    //Route::get('container/create', 'Admin\ContainerController@create');
    Route::post('container/datatable', 'Admin\ContainerController@datatable');
    Route::resource('container', 'Admin\ContainerController');

    Route::post('course/datatable', 'Admin\CourseController@datatable');
    Route::resource('course', 'Admin\CourseController');

    Route::post('allergies/datatable', 'Admin\AllergiesController@datatable');
    Route::resource('allergies', 'Admin\AllergiesController');

    Route::post('events/datatable', 'Admin\EventsController@datatable');
    Route::resource('events', 'Admin\EventsController');

    Route::post('Dietoption/datatable', 'Admin\DietoptionController@datatable');
    Route::resource('dietoption', 'Admin\DietoptionController');

    Route::post('cuisine/datatable', 'Admin\CuisineController@datatable');
    Route::resource('cuisine', 'Admin\CuisineController');

    Route::post('taste/datatable', 'Admin\TasteController@datatable');
    Route::resource('taste', 'Admin\TasteController');

    Route::post('mealtime/datatable', 'Admin\MealtimeController@datatable');
    Route::resource('mealtime', 'Admin\MealtimeController');

    Route::post('people/datatable', 'Admin\PeopleController@datatable');
    Route::resource('people', 'Admin\PeopleController');

    Route::post('ingrediants/datatable', 'Admin\IngrediantsController@datatable');
    Route::resource('ingrediants', 'Admin\IngrediantsController');

    Route::post('food/datatable', 'Admin\FoodController@datatable');
    Route::resource('food', 'Admin\FoodController');
	
	Route::post('media/datatable', 'Admin\MediaController@datatable');
    Route::resource('media', 'Admin\MediaController');
	
	Route::post('resourcetype/datatable', 'Admin\ResourcetypeController@datatable');
    Route::resource('resourcetype', 'Admin\ResourcetypeController');
	
	Route::post('foodallergies/datatable', 'Admin\FoodallergyController@datatable');
    Route::resource('foodallergies', 'Admin\FoodallergyController');


});

Route::group(['prefix' => 'api'], function () {
	
	Route::post('auth/signup', 'Api\AuthController@userauthentication');
	Route::resource('auth', 'Api\AuthController');
	
	Route::post('people/profile', 'Api\PeopleController@store');
	Route::post('people', 'Api\PeopleController@index');
	//Route::resource('people', 'PeopleController', ['only'=> ['index','create','store']]);
	//Route::resource('people', 'Api\PeopleController');
	
	
	
	//Route::resource('votes', 'Api\VoteController');
	
	Route::resource('courses', 'Api\CoursesController');
	Route::resource('cuisine', 'Api\CuisineController');
	
	
	Route::post('taste/all', 'Api\TasteController@alltaste');
	Route::resource('taste', 'Api\TasteController');
	
	Route::resource('media', 'Api\MediaController');
	
	Route::post('container/ingrediants', 'Api\ContainerController@ingrediants');
	Route::post('container/containers', 'Api\ContainerController@containers');
	Route::resource('container', 'Api\ContainerController');
	
	Route::post('food/all', 'Api\FoodController@get');
	Route::resource('food', 'Api\FoodController');
	
	Route::post('resourcetype/resources', 'Api\ResourcetypeController@resources');
	Route::resource('resourcetype', 'Api\ResourcetypeController');
	
	Route::post('allergies/all', 'Api\AllergiesController@allergies');
	Route::resource('allergies', 'Api\AllergiesController');
	
	Route::post('history/people', 'Api\HistoryController@gethistory');
	Route::post('history/add', 'Api\HistoryController@addhistory');
	Route::resource('history', 'Api\HistoryController');
	
	Route::post('ingrediants/all', 'Api\IngrediantsController@ingrediants');
	Route::resource('ingrediants', 'Api\IngrediantsController');	
	
	Route::post('search', 'Api\SearchController@search');
    
});

