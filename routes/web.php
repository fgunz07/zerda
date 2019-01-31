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

Route::get('oauth-facebook', 'FacebookController@getAuthFacebook')->name('facebook.auth');

Route::get('oauth-callback', 'FacebookController@fbOauth');

// Route::group(['prefix' => 'todo-app'] , function () {

// 	Route::get('todos','TodoController@index');

// 	Route::get('todos-list', 'TodoController@listTodo');

// 	Route::post('todos-list', 'TodoController@store');

// 	Route::get('tasks-list', 'TaskController@listTask');

// 	Route::post('tasks-list', 'TaskController@store');

// });

Auth::routes();

Route::group(['prefix' => 'todo-app'], function () {

	Route::get('boards', 'TodoListAppController@index')->name('todoboards');

	Route::get('boards/list', 'BoardsController@index');

	Route::post('boards', 'BoardsController@store');

	Route::delete('boards/{id}', 'BoardsController@delete');

	Route::get('boards/{id}', 'BoardsController@show');

	Route::get('todos', 'TodoController@listTodo');

	Route::post('todos', 'TodoController@store');

	Route::delete('todos/{id}', 'TodoController@delete');

	Route::post('tasks', 'TaskController@store');

	Route::post('todo-task', 'TodoController@UpdateTodoTask');

});

Route::get('home', 'HomeController@index')->name('home');

//Dashboard
Route::get('dashboard','DashboardController@index');
Route::post('user-rate','DashboardController@changeRate');


//Skills
Route::get('skills-list','SkillsController@index');
Route::get('skills-create','SkillsController@create');
Route::post('skills-store','SkillsController@store');
Route::get('skills-edit/{id}','SkillsController@edit');
Route::put('skills-update/{id}','SkillsController@update');
Route::delete('skills-delete/{id}','SkillsController@destroy');

//Profile
Route::get('profile-show','ProfileController@show');
Route::get('profile-upload-pic/{id}','ProfileController@uploadProfile');
Route::get('profile-location/{id}','ProfileController@updateLocation');
Route::get('profile-education/{id}','ProfileController@updateEducation');
Route::get('profile-skill/{id}','ProfileController@updateSkill');
Route::get('profile-notes/{id}','ProfileController@updateNotes');
