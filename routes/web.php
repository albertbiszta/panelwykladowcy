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



Route::group(['middleware' => ['auth', 'verified']], function()
{
	Route::get('/verified', function() {
		return view('verified');
	});

	Route::get('/panel', 'PanelController@index')->name('panel');

	Route::resource('subjects', 'SubjectController'); 
	Route::post('/new-subject', 'SubjectController@storeModal');
	Route::post('/edit-subject', 'SubjectController@editModal');
	Route::delete('/subjects/delete/{id}', 'SubjectController@delete')->name('subjects.delete');
	Route::post('/subjects/{id}', 'SubjectController@assignGroup')->name('subjects.assignGroup');
	Route::delete('/subjects/{subject_id}/{group_id}', 'SubjectController@unassignGroup')->name('subjects.unassignGroup');


	Route::resource('groups', 'GroupController'); 
	Route::post('groups/new', 'GroupController@storeModal');
	Route::get('/user-group/{id}', 'GroupController@userGroup');

	Route::resource('students', 'StudentController'); 
	Route::get('/search-students', 'StudentController@search')->name('students.search');
	Route::get('/groups/{id}/add-student', 'StudentController@create')->name('addStudent');

	Route::resource('syllabuses', 'SyllabusController');
	/*Route::get('syllabuses/add?subject={id}', 'SyllabusController@addWithSubject')->name('syllabuses.addWithSubject');
	Route::post('syllabuses/save?subject={id}', 'SyllabusController@saveWithSubject');*/

	Route::get('grades/subject/{subject_id}/group/{group_id}', 'GradeController@groupGrades')->name('grades.group');
	Route::post('grades/add/subject/{subject_id}', 'GradeController@addGrade')->name('grades.addGrade');
	


	Route::get('lessons/subject/{subject_id}/group/{group_id}', 'LessonController@groupLessons')->name('lessons.group');
	Route::post('add-lesson/subject/{subject_id}/group/{group_id}', 'LessonController@addLesson')->name('lessons.addLesson');
	Route::patch('/lessons/{id}/edit-status','LessonController@editStatus');

	//Route::resource('attendances', 'AttendanceController');
	Route::get('attendances/lessons/{lesson_id}', 'AttendanceController@lessonAttendance')->name('attendances.lesson');
	Route::post('attendances/save/lessons/{lesson_id}/', 'AttendanceController@saveAttendance')->name('attendances.lesson');




});
