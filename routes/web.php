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

	return view('auth.login');
});



Route::get('/registered', function () {
	return view('registered');
});

Auth::routes(['verify' => true]);



Route::group(['middleware' => ['auth', 'verified']], function()
{
	Route::get('/verified', function () {
		return view('verified');
	});

	Route::get('/panel', 'PanelController@index')->name('panel');


	Route::resource('subjects', 'SubjectController'); 
	Route::post('/subjects/store', 'SubjectController@store');
	Route::patch('/subjects/{id}/update', 'SubjectController@update');
	Route::delete('/subjects/{id}/delete', 'SubjectController@destroy')->name('subjects.delete');

	Route::post('/subjects/{id}/assign-group', 'SubjectController@assignGroup')->name('subjects.assignGroup');
	Route::delete('/subjects/{subject_id}/{group_id}', 'SubjectController@unassignGroup')->name('subjects.unassignGroup');
	Route::get('/subject/{id}/groups', 'SubjectController@subjectGroups');

	Route::get('/subject/{id}/add-syllabus', 'SyllabusController@create');
	Route::post('/subject/{id}/syllabus/store', 'SyllabusController@store')->name('syllabuses.store');
	Route::delete('/syllabuses/{id}/delete', 'SyllabusController@destroy')->name('syllabuses.delete');
	Route::get('/syllabuses/{id}/edit', 'SyllabusController@edit');
	Route::patch('/syllabuses/{id}/update', 'SyllabusController@update');



	Route::resource('groups', 'GroupController'); 
	Route::post('/groups/store', 'GroupController@store');
	Route::patch('/groups/{id}/update', 'GroupController@update');
	Route::delete('/groups/{id}/delete', 'GroupController@destroy')->name('groups.delete');
	Route::get('/user-group/{id}', 'GroupController@userGroup');

	Route::resource('students', 'StudentController'); 
	Route::post('/students/store', 'StudentController@store')->name('students.store');
	Route::patch('/students/{id}/update', 'StudentController@update');
	Route::delete('/students/{id}/delete', 'StudentController@destroy')->name('students.delete');
	Route::get('/search-students', 'StudentController@search')->name('students.search');




	Route::get('/grades/subject/{subject_id}/group/{group_id}', 'GradeController@groupGrades')->name('grades.group');
	Route::post('/grades/add/subject/{subject_id}', 'GradeController@addGrade')->name('grades.addGrade');
	Route::patch('/grades/{grade_id}/update', 'GradeController@update')->name('grades.update');
	Route::delete('/grades/{id}/delete', 'GradeController@destroy')->name('grades.delete');

	Route::get('/lessons', 'LessonController@index')->name('lessons.index');
	Route::get('/lessons/subject/{subject_id}/group/{group_id}', 'LessonController@groupLessons')->name('lessons.group');
	Route::post('/lessons/subject/{subject_id}/group/{group_id}/store', 'LessonController@store')->name('lessons.add');
	Route::patch('/lessons/{id}/edit-status','LessonController@editStatus');

	Route::get('/attendances/lessons/{lesson_id}', 'AttendanceController@lessonAttendance')->name('attendances.lesson');
	Route::post('/attendances/save', 'AttendanceController@save')->name('attendances.save');
	Route::post('/attendances/{id}/update', 'AttendanceController@update')->name('attendances.update');

	Route::resource('materials', 'MaterialController');

	Route::delete('/materials/{id}/delete', 'MaterialController@destroy')->name('materials.delete');
	
});

Route::get('/profile/{full_name}/{id}', 'UserProfileController@show')->name('profiles.show');
Route::get('/materials/download/{name}', 'MaterialController@downloadFile')->name('materials.download');
