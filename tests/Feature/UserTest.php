<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    /** @test */
    public function user_after_logging_in_is_redirected_to_the_panel()
    {
        $user = factory(User::class)->create(['password' => bcrypt('testing')]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'testing',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/panel');
    }


    /** @test */
    public function authenticated_user_cannot_login_again()
    {
        $this->user_after_logging_in_is_redirected_to_the_panel();

        $response = $this->get('/login');
        $response->assertRedirect('/panel');

    }

}
