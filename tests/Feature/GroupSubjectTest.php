<?php

namespace Tests\Feature;

use App\Group;
use App\User;
use App\Subject;
use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupSubjectTest extends TestCase
{

    private $password = 'testing';


    /** @test */
    public function group_is_assigned_to_the_subject()
    {
        $user = $this->createUserWithFactory();
        $this->actingAs($user);

        $subject = factory(Subject::class)->create([
            'user_id' => $user->id,
        ]);
        $group = factory(Group::class)->create([
            'user_id' => $user->id,
        ]);

        $this->post('/subjects/' . $subject->id . '/assign-group', [
            'groups' => $group->id
        ]);


        $groupSubject = $this->getGroupSubject($group, $subject);

       $this->assertEquals(1, $groupSubject->count());



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
