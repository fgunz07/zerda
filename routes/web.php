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

Route::get('oauth-facebook', 'FacebookController@redirect')->name('facebook.auth');

Route::get('oauth-callback', 'FacebookController@callback');

Route::get('select-role', 'RoleUserController@index');

Route::post('select-role', 'RoleUserController@saveRole');

// Route::group(['prefix' => 'todo-app'] , function () {

// 	Route::get('todos','TodoController@index');

// 	Route::get('todos-list', 'TodoController@listTodo');

// 	Route::post('todos-list', 'TodoController@store');

// 	Route::get('tasks-list', 'TaskController@listTask');

// 	Route::post('tasks-list', 'TaskController@store');

// });

Auth::routes();

Route::group(['middleware' => 'IfUserHasRole'] , function () {

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

	Route::group(['prefix' => 'notification'], function () {

		Route::get('/invite', 'InviteNotificationController@inviteDev');

	});

	Route::get('/users', 'UserController@availableUsers');

	Route::get('home', 'HomeController@index')->name('home');
	
	//Dashboard
	Route::get('dashboard','DashboardController@index');
	Route::get('profile-view/{id}','DashboardController@viewProfile');
	Route::post('user-rate','DashboardController@changeRate');


	//Skills
	Route::get('skills-list','SkillsController@index');
	Route::get('skills-create','SkillsController@create');
	Route::post('skills-store','SkillsController@store');
	Route::get('skills-edit/{id}','SkillsController@edit');
	Route::put('skills-update/{id}','SkillsController@update');
	Route::delete('skills-delete/{id}','SkillsController@destroy');

	//Profile
	Route::get('profile-show','UserController@show');
	Route::get('profile-data','UserController@dataProfile');
	Route::post('profile-upload-pic/{id}','UserController@uploadProfile');
	Route::post('profile-location','UserController@updateLocation');
	Route::post('profile-education','UserController@updateEducation');
	Route::post('profile-skill','UserController@updateSkill');
	Route::post('profile-skill-delete/{id}','UserController@deleteSkill');
	Route::post('profile-achievement','UserController@updateAchievement');
	Route::post('profile-achievement-delete/{id}','UserController@deleteAchievement');

});
