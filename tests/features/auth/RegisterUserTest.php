<?php

use App\Users\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RedisterUserTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
	public function post_user_data_to_register_user()
	{
		  $this->visit('/auth/register')
         	->type('Jason', 'name')
         	->type('jekinneys@yahoo.com', 'email')
         	->type('secret', 'password')
         	->type('secret', 'password_confirmation')
         	->press('Register')
         	->seePageIs('/auth/login');	
   }
}