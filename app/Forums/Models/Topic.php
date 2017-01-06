<?php

namespace App\Forums\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];

    protected $casts = [
        'hidden' => 'boolean',
    ];

	public function getPublishedAtAttribute()
	{
		return $this->created_at->format('j F, Y');
	}

	public function user()
	{
		return $this->belongsTo(\App\users\Models\User::class);
	}

    public function forum()
    {
    	return $this->belongsTo(Forum::class);
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    public function findBySlugWithForumAndReplies($slug)
    {
    	return $this->with('user:id,name', 
                'forum:id,slug,name', 
                'replies:topic_id,user_id,body,created_at', 
                'replies.user:id,name'
            )->where('slug', $slug)
            ->firstOrFail();
    }

    public function submitNew($request)
    {
        $forum = Forum::where('slug', $request->forum)->firstOrFail();

        $forum->topics()->create([
            'forum_id' => $request->forum_id,
            'user_id' => auth()->id(),
            'slug' => str_slug($request->name),
            'name' => $request->name,
            'body' => $request->body,
        ]);

        return $forum;
    }

    public function submitUpdate($request)
    {
        $topic = $this->where('slug', $request->slug)->firstOrFail();
        $topic->update([
            'slug' => str_slug($request->name),
            'name' => $request->name,
            'body' => $request->body,
        ]);

        return Forum::find($topic->forum_id);
    }

    public function hide()
    {
        return $this->update(['hidden' => !$this->update]);
    }
}
