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

Route::get('/registered', function () {
	return view('registered');
});

Auth::routes(['verify' => true]);

Route::get('/panel', 'HomeController@index')->name('panel');

Route::group(['middleware' => ['auth', 'verified']], function()
{
	Route::get('/verified', function() {
		return view('verified');
	});

	Route::resource('subjects', 'SubjectController'); 
	Route::post('/subjects/{id}', 'SubjectController@assignGroup')->name('subjects.assignGroup');
	Route::delete('/subjects/{subject_id}/{group_id}', 'SubjectController@unassignGroup')->name('subjects.unassignGroup');


	Route::resource('groups', 'GroupController'); 

	Route::resource('students', 'StudentController'); 
	Route::get('/search-students', 'StudentController@search')->name('students.search');
	Route::get('/groups/{id}/add-student', 'StudentController@create')->name('addStudent');

	Route::resource('syllabuses', 'SyllabusController');



});
