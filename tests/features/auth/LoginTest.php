<?php

use App\Users\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
	public function post_login_returns_token_and_user_data()
	{
		$test = factory(User::class)->create([
            'slug' => str_slug('John Doe'),
			'name' => 'John Doe',
        	'email' => 'john@example.com',
        	'password' => 'password',
        ]);

		$this->visit('/auth/login')
         	->type('john@example.com', 'email')
         	->type('password', 'password')
         	->press('Login')
         	->seePageIs('/');	

        $this->see('John Doe');
   }
}