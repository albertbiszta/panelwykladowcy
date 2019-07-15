<?php

namespace Tests\Feature;

use App\User;
use App\Subject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SubjectTest extends TestCase
{
    use WithoutMiddleware;

    private $password = 'testing';

    /** @test */
    public function subject_is_saved()
    {
        $numberOfSubjects = Subject::all()->count();
        $user = $this->createUserWithFactory();

        $this->actingAs($user);

        $this->post('/subjects/store', [
            'name' => 'TestSubject',
            'exam' => 1,
            'ects' => 5,
        ]);

        $this->assertEquals($numberOfSubjects + 1, Subject::all()->count());
    }


    /** @test */
    public function subject_is_deleted()
    {
        $this->subject_is_saved();
        $numberOfSubjects = Subject::all()->count();

        $subject = Subject::all()->last();

        $this->delete('/subjects/'. $subject->id .'/delete');
        $this->assertEquals($numberOfSubjects -1, Subject::all()->count());

    }


    private function createUserWithFactory()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($this->password),
        ]);

        return $user;
    }

}
