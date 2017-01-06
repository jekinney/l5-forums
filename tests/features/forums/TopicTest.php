<?php

use App\Forums\Models\Reply;
use App\Forums\Models\Topic;
use App\Forums\Models\Forum;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TopicTest extends TestCase
{
	use DatabaseMigrations;

   	/** @test */
    public function show_a_single_topic()
    {
    	$topic = factory(Topic::class)->create([
    		'slug' => str_slug('Test Topic'),
        	'name' => 'Test Topic',
        	'body' => 'Test topic body',
    	]);

    	factory(Reply::class)->create([
    		'topic_id' => $topic->id,
			'body' => 'Reply body',
		]);

    	$forum = Forum::first();

    	$this->visit('/forum/'.$forum->slug.'/topic/'.$topic->slug)
    		->see('Test Topic')
    		->see('Test topic body')
    		->see('Reply body');
    }

     /** @test */
    public function post_new_topic()
    {
        $user = factory(App\Users\Models\User::class)->create();
        $forum = factory(Forum::class)->create();

        $this->actingAs($user)
            ->visit('/forum/'.$forum->slug.'/topic')
            ->type('Test Topic', 'name')
            ->type('Test topic body', 'body')
            ->press('Add Topic')
            ->seePageIs('/forum/'.$forum->slug) 
            ->see('Test Topic');
   }

   /** @test */
    public function update_old_topic()
    {
        $user = factory(App\Users\Models\User::class)->create();
        $forum = factory(Forum::class)->create();
        $topic = factory(Topic::class)->create(['forum_id' => $forum->id]);

        $this->actingAs($user)
            ->visit('/forum/topic/'.$topic->slug)
            ->type('Test Topic', 'name')
            ->type('Test topic body', 'body')
            ->press('Update Topic')
            ->seePageIs('/forum/'.$forum->slug) 
            ->see('Test Topic');
   }

    /** @test */
    public function toggle_hide_topic()
    {
        $user = factory(App\Users\Models\User::class)->create();
        $forum = factory(Forum::class)->create();
        $topic = factory(Topic::class)->create([
            'forum_id' => $forum->id,
            'slug' => str_slug('Test Topic'),
            'name' => 'Test Topic',
            'body' => 'Test topic body',
            'hidden' => false,
        ]);

        $this->actingAs($user)
            ->visit('/forum/'.$forum->slug.'/topic/'.$topic->slug)
            ->press('Hide')
            ->assertTrue(Topic::find($topic->id)->hidden);
            dd($topic->hidden);
            // ->visit('/forum/'.$forum->slug.'/topic/'.$topic->slug)
            // ->press('Hide')
            // ->assertFalse(Topic::find($topic->id)->hidden);

   }
}
