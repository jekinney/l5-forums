<?php

use App\Forums\Models\Forum;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ForumTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function list_of_forums()
    {
    	factory(Forum::class, 4)->create();
    	factory(Forum::class)->create([
    		'slug' => str_slug('Test Forum'),
        	'name' => 'Test Forum',
        	'description' => 'Test forum description',
    	]);

    	$this->visit('/forum')
    		->see('Test Forum')
    		->see('Test forum description');
    }

    /** @test */
    public function show_a_single_forum()
    {
    	$forum = factory(Forum::class)->create([
    		'slug' => str_slug('Test Forum'),
        	'name' => 'Test Forum',
        	'description' => 'Test forum description',
    	]);

    	$this->visit('/forum/'.$forum->slug)
    		->see('Test Forum')
    		->see('Test forum description');
    }
}
