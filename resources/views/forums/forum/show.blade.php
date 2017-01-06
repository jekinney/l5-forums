@extends('layouts.main')

@section('header')
	<h1 class="text-center">{{ $forum->name }}</h1>
	<p class="text-center">{{ $forum->description }}</p>
	@if(auth()->check() && auth()->user()->hasRole('member'))
		<div class="text-center">
			<a href="/forum/{{ $forum->slug }}/topic" class="btn btn-primary">Add Topic</a> 
		</div>
	@endif
@endsection

@section('contents')
	<section class="well">
		@foreach($forum->topics as $topic)
			<article class="well-sub clearfix">
				<h2 class="pull-left">
					<a href="/forum/{{ $forum->slug }}/topic/{{ $topic->slug }}" class="well-sub-link">
						{{ $topic->name }} {{ $topic->replies_count }}
					</a>
				</h2>
				<p class="pull-right">{{ $topic->user->name }} posted on {{ $topic->published_at }}</p>
			</article>
		@endforeach
	</section>
@endsection