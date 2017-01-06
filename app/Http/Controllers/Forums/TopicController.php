<?php

namespace App\Http\Controllers\Forums;

use App\Forums\Models\Topic;
use App\Forums\Models\Forum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($forumslug, Forum $forum)
    {
        $forum = $forum->where('slug', $forumslug)->first();

        return view('forums.topic.create', compact('forum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Topic $topic)
    {
        $forum = $topic->submitNew($request);

        return redirect()->route('forum.show', $forum->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($forumslug, $topicslug, Topic $topic)
    {
        $topic = $topic->findBySlugWithForumAndReplies($topicslug);

        return view('forums.topic.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, Topic $topic)
    {
        $topic = $topic->where('slug', $slug)->firstOrFail();

        return view('forums.topic.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $forum = $topic->submitUpdate($request);

        return redirect()->route('forum.show', $forum->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->hide();

        return redirect()->route('forum.index');
    }
}
