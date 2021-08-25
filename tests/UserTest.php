<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_can_be_added_to_the_app()
    {
        $new_user = Str::random(10);
        $response = $this->post('/api/users', [
            'name' => $new_user,
            'email' => $new_user.'@gmail.com',
            'password' => Hash::make('password')
        ]);

        //$response->assertStatus(200);

        $user = User::orderBy('id', 'desc')->first();

        $this->assertEquals($new_user, $user->name);
    }
}
