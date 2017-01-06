<?php

use App\Forums\Models\Reply;
use App\Forums\Models\Topic;
use App\Forums\Models\Forum;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

     /** @test */
	public function post_new_reply_to_topic()
	{
		  // $this->visit()
    //      	->type('jekinneys@yahoo.com', 'email')
    //      	->type('secret', 'password')
    //      	->type('secret', 'password_confirmation')
    //      	->press('Register')
    //      	->seePageIs('/auth/login');	
   }
}
