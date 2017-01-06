<?php

namespace App\Forums\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $guarded = [];

    protected $casts = [
        'display_description' => 'boolean',
    ];

	public function topics()
	{
		return $this->hasMany(Topic::class);
	}

    public function replies()
    {
        return $this->hasManyThrough(Reply::class, Topic::class);
    }

    public function list()
    {
    	return $this->with(['topics' => function($q) {
                $q->with('user:id,name');
                $q->withCount('replies');
                $q->select('id', 'forum_id', 'user_id', 'slug', 'name');
            }])->get();
    }

    public function findbySlugWithTopics($slug)
    {
    	return $this->with('topics', 'topics.user')
    			->where('slug', $slug)
				->firstOrFail();	
    }

    public function addNew($request)
    {
        return $this->create([
            'slug' => str_slug($request->name),
            'name' => $request->name,
            'description' => $request->description,
            'display_description' => $request->has('display')? true:false,
            'display_order' => $request->display_order,
        ]);
    }
}
