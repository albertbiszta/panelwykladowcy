<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Group;
use App\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{



  /**
   * Grades Index /w create, edit, delete
   * 
   * /grades/subject/{subject_id}/group/{group_id}
   * 
   * @param  int $subjectId
   * 
   * @param  int $groupId
   * 
   * @return \Illuminate\Http\Response
   */
    public function groupGrades($subjectId, $groupId = null)
    {
    	if(Subject::userSubject($subjectId) && Group::userGroup($groupId)) {
    		$subject = Subject::findOrFail($subjectId);
    		$group = Group::findOrFail($groupId);
    		return view('grades.group')->with(compact('subject', 'group'));
    	}else {
    		abort(404);
    	}
    }


    /**
     * Add grade
     * 
     * /grades/add/subject/{subject_id}
     * 
     * @param  Request $request
     * 
     * @param  int $subjectId
     * 
     * @return \Illuminate\Http\Response
     */
    public function addGrade(Request $request, $subjectId = null) {
    	if(Subject::userSubject($subjectId)) {
    		$grade = new Grade;
    		$grade->value = $request->input('value');
            if(!is_numeric($grade->value)){
              $grade->value = preg_replace('~\D~', '', $grade->value);
          }
          
          $grade->student_id = $request->input('student');
          $grade->subject_id = $subjectId;
          $grade->save();
          $message = "Dodano ocenę";

          return redirect()->back()->with('flash_message_success', $message);
      }else {
          abort(404);
      }
   }


  /**
   * Change student's grade
   * 
   * /grades/{id}/update
   * 
   * @param  Request $request
   * 
   * @param  int $id
   * 
   * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id = null) {
     $grade = Grade::findOrFail($id);
     $grade->value = $request->input('value');
     $grade->update();
     $message = 'Zapisano zmiany';
     return response()->json(['success'=>$message]);
   }



  /**
   * Delete grade
   * 
   * /grades/{id}/delete
   * 
   * @param  int $id
   * 
   * @return \Illuminate\Http\Response
     */
  public function destroy($id = null)
  {
      $grade = Grade::where(['id'=>$id])->delete();
      $message = 'Usunięto ocenę';
      return response()->json(['success'=>$message]);
   
  }



}
