<?php

namespace App\Http\Controllers\Forums;

use App\Forums\Models\Topic;
use App\Forums\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        return view('forums.reply.create', compact('slug'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Reply $reply)
    {
        $topic = $reply->addNew($request); 

        return redirect()->route('forum.topic.show', $topic->slug);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        return view('forums.reply.create', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $topic = $reply->addUpdate($request);

        return redirect()->route('forum.topic.show', $topic->slug);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->hide();

        return back();
    }
}
