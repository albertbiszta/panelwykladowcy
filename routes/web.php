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
	Route::post('/subjects/add', 'SubjectController@add');
	Route::patch('/subjects/{id}/update', 'SubjectController@update');
	Route::delete('/subjects/{id}/delete', 'SubjectController@delete')->name('subjects.delete');

	Route::post('/subjects/{id}/assign-group', 'SubjectController@assignGroup')->name('subjects.assignGroup');
	Route::delete('/subjects/{subject_id}/{group_id}', 'SubjectController@unassignGroup')->name('subjects.unassignGroup');
	Route::get('/subject/{id}/groups', 'SubjectController@subjectGroups');

	Route::resource('groups', 'GroupController'); 
	Route::post('/groups/add', 'GroupController@add');
	Route::patch('/groups/{id}/update', 'GroupController@update');
	Route::delete('/groups/{id}/delete', 'GroupController@delete')->name('groups.delete');
	Route::get('/user-group/{id}', 'GroupController@userGroup');

	Route::resource('students', 'StudentController'); 
	Route::post('/students/add', 'StudentController@add')->name('students.add');
	Route::patch('/students/{id}/update', 'StudentController@update');
	Route::delete('/students/{id}/delete', 'StudentController@delete')->name('students.delete');
	Route::get('/search-students', 'StudentController@search')->name('students.search');

	Route::resource('syllabuses', 'SyllabusController');

	Route::get('/grades/subject/{subject_id}/group/{group_id}', 'GradeController@groupGrades')->name('grades.group');
	Route::post('/grades/add/subject/{subject_id}', 'GradeController@addGrade')->name('grades.addGrade');
	Route::patch('/grades/{grade_id}/update', 'GradeController@update')->name('grades.update');
	Route::delete('/grades/{id}/delete', 'GradeController@delete')->name('grades.delete');

	Route::get('/lessons', 'LessonController@index')->name('lessons.index');
	Route::get('/lessons/subject/{subject_id}/group/{group_id}', 'LessonController@groupLessons')->name('lessons.group');
	Route::post('/lessons/subject/{subject_id}/group/{group_id}/add', 'LessonController@add')->name('lessons.add');
	Route::patch('/lessons/{id}/edit-status','LessonController@editStatus');

	//Route::resource('attendances', 'AttendanceController');
	Route::get('/attendances/lessons/{lesson_id}', 'AttendanceController@lessonAttendance')->name('attendances.lesson');
	Route::post('/attendances/save', 'AttendanceController@save')->name('attendances.save');
	Route::post('/attendances/{id}/update', 'AttendanceController@update')->name('attendances.update');

	Route::resource('materials', 'MaterialController');
	Route::get('/materials/download/{name}', 'MaterialController@downloadFile')->name('materials.download');
	Route::delete('/materials/{id}/delete', 'MaterialController@delete')->name('materials.delete');
	
});

Route::get('/profile/{lastName}{firstName}/{id}', 'UserProfileController@publicProfile')->name('profiles.public');
