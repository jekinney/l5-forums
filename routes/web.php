<?php

Route::get('/', function() {
	if(auth()->check()) return [auth()->user()->name, auth()->user()->roles()->first()->name];
	return bcrypt('aubreys1');
});

Route::group(['prefix' => 'auth', 'as' => 'auth.', 'namespace' => 'Auth'], function() {
	Route::get('login', ['as' => 'login.create', 'uses' => 'AuthController@create']);
	Route::post('login', ['as' => 'login.store', 'uses' => 'AuthController@store']);
	Route::post('logout', ['as' => 'logout', 'uses' => 'AuthController@destroy'])->middleware('auth');

	Route::get('register', ['as' => 'register.create', 'uses' => 'RegisterController@create']);
	Route::post('register', ['as' => 'register.store', 'uses' => 'RegisterController@store']);
});

Route::group(['prefix' => 'forum', 'as' => 'forum.', 'namespace' => 'Forums'], function() {
	Route::get('/', ['as' => 'index', 'uses' => 'ForumController@index']);
	Route::get('{forumslug}', ['as' => 'show', 'uses' => 'ForumController@show']);
	Route::post('/', ['as' => 'store', 'uses' => 'ForumController@store'])->middleware(['auth', 'role:admin']);

	Route::get('{forumslug}/topic/{topicslug}', ['as' => 'topic.show', 'uses' => 'TopicController@show']);
	Route::get('{forumslug}/topic', ['as' => 'topic.create', 'uses' => 'TopicController@create'])->middleware(['auth', 'role:member']);
	Route::get('topic/{topicslug}', ['as' => 'topic.edit', 'uses' => 'TopicController@edit'])->middleware(['auth', 'role:member']);
	Route::post('topic', ['as' => 'topic.store', 'uses' => 'TopicController@store'])->middleware(['auth', 'role:member']);
	Route::post('topic/{topic}/hide', ['as' => 'topic.hide', 'uses' => 'TopicController@destroy'])->middleware(['auth', 'role:admin']);
	Route::put('topic', ['as' => 'topic.update', 'uses' => 'TopicController@update'])->middleware(['auth', 'role:member']);

	Route::get('/topic/{slug}/reply', ['as' => 'reply.create', 'uses' => 'ReplyController@create'])->middleware(['auth', 'role:member']);
	Route::post('/reply', ['as' => 'reply.store', 'uses' => 'ReplyController@store'])->middleware(['auth', 'role:member']);
});
