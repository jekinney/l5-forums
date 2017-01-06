<?php

namespace App\Forums\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	protected $guarded = [];

	protected $casts = [
		'hidden' => 'boolean',
	];

	public function getPublishedAtAttribute()
	{
		return $this->created_at->format('j F, Y');
	}
	
	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

    public function user()
	{
		return $this->belongsTo(\App\users\Models\User::class);
	}

	public function addNew($request)
	{
		return $this->create([
			'topic_id' => Topic::where('slug', $request->slug)->firstOrFail()->id,
			'user_id' => auth()->id(),
			'body' => $request->body,
		]);
	}

	public function hide()
    {
        return $this->update(['hidden' => !$this->update]);
    }
}
