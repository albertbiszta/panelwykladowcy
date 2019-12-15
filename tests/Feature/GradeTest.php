<?php

namespace Tests\Feature;

use DB;
use App\Grade;
use App\Group;
use App\User;
use App\Subject;
use App\Student;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GradeTest extends TestCase
{

    private $password = 'testing';


    /** @test */
    public function student_gets_a_grade()
    {
        $user = $this->createUserWithFactory();
        $this->actingAs($user);

        $group = factory(Group::class)->create([
            'user_id' => $user->id,
        ]);

        $student = factory(Student::class)->create([
            'group_id' => $group->id,
        ]);


        $subject = factory(Subject::class)->create([
            'user_id' => $user->id,
        ]);


        $this->post('/subjects/' . $subject->id . '/assign-group', [
            'groups' => $group->id,
        ]);


        $this->post('/grades/subject/' . $subject->id . '/group/ ' .$group->id , [
            'value' => 3,
            'student_id' => $student->id,
        ]);

      $grades = DB::table('grades')
            ->where('subject_id', $subject->id)
            ->where('student_id', $student->id)->get();


      $this->assertContains($student, $grades);



    }



    private function createUserWithFactory()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($this->password),
        ]);

        return $user;
    }


    private function getGroupSubject($group, $subject)
    {
        $groupSubject = DB::table('group_subject')
            ->where('subject_id', $subject->id)
            ->where('group_id', $group->id)->get();
        return $groupSubject;
    }
}
