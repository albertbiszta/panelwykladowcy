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


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/verified', function () {
        return view('verified');
    });

    Route::get('/panel', 'PanelController@index')->name('panel');


    Route::resource('subjects', 'SubjectController');
    Route::post('/subjects/store', 'SubjectController@store')->name('subjects.store');
    Route::patch('/subjects/{subject}/update', 'SubjectController@update')->name('subjects.update');
    Route::delete('/subjects/{subject}/delete', 'SubjectController@destroy')->name('subjects.delete');
    Route::post('/subjects/{subject}/assign-group', 'SubjectController@assignGroup')->name('subjects.assign_group');
    Route::delete('/subjects/{subject}/{group}', 'SubjectController@unassignGroup')->name('subjects.unassign_group');
    Route::get('/subject/{subject}/groups', 'SubjectController@subjectGroups')->name('subjects.subject_groups');

    Route::get('/subject/{subject}/add-syllabus', 'SyllabusController@create')->name('syllabuses.create');
    Route::post('/subject/{subject}/syllabus/store', 'SyllabusController@store')->name('syllabuses.store');

    Route::delete('/syllabuses/{syllabus}/delete', 'SyllabusController@destroy')->name('syllabuses.delete');
    Route::get('/syllabuses/{syllabus}/edit', 'SyllabusController@edit')->name('syllabuses.edit');
    Route::patch('/syllabuses/{syllabus}/update', 'SyllabusController@update')->name('syllabuses.update');


    Route::resource('groups', 'GroupController');
    Route::post('/groups/store', 'GroupController@store')->name('groups.store');
    Route::patch('/groups/{group}/update', 'GroupController@update')->name('groups.update');
    Route::delete('/groups/{group}/delete', 'GroupController@destroy')->name('groups.delete');
    Route::get('/user-group/{group}', 'GroupController@userGroup')->name('groups.user_group');

    Route::resource('students', 'StudentController');
    Route::post('/students/store', 'StudentController@store')->name('students.store');
    Route::patch('/students/{student}/update', 'StudentController@update')->name('students.update');
    Route::delete('/students/{student}/delete', 'StudentController@destroy')->name('students.delete');
    Route::get('/search-students', 'StudentController@search')->name('students.search');


    Route::get('/grades/subject/{subject}/group/{group}', 'GradeController@groupGrades')->name('grades.group');
    Route::post('/grades/add/subject/{subject}', 'GradeController@addGrade')->name('grades.add_grade');
    Route::patch('/grades/{grade}/update', 'GradeController@update')->name('grades.update');
    Route::delete('/grades/{grade}/delete', 'GradeController@destroy')->name('grades.delete');

    Route::get('/lessons', 'LessonController@index')->name('lessons.index');
    Route::get('/lessons/subject/{subject}/group/{group}',
        'LessonController@groupLessons')->name('lessons.group');
    Route::post('/lessons/subject/{subject}/group/{group}/store', 'LessonController@store')->name('lessons.add');
    Route::patch('/lessons/{lesson}/edit-status', 'LessonController@editStatus')->name('lessons.edit_status');;

    Route::get('/attendances/lessons/{lesson_id}', 'AttendanceController@lessonAttendance')->name('attendances.lesson');
    Route::post('/attendances/save', 'AttendanceController@save')->name('attendances.save');
    Route::post('/attendances/{id}/update', 'AttendanceController@update')->name('attendances.update');

    Route::resource('materials', 'MaterialController');

    Route::delete('/materials/{material}/delete', 'MaterialController@destroy')->name('materials.delete');

});

Route::get('/profile/{full_name}/{id}', 'UserProfileController@show')->name('profiles.show');
Route::get('/materials/download/{name}', 'MaterialController@downloadFile')->name('materials.download');
