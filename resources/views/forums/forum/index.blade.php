@extends('layouts.main')

@section('header')
	<h1 class="text-center">Forums</h1>
	<p class="text-center">Listing of the forums and recent topics</p>
@endsection

@section('contents')
	<section class="well">
		@foreach($forums as $forum)
			<header class="well-sub clearfix">
				<h2>
					<a href="/forum/{{ $forum->slug }}" class="well-sub-link pull-left">{{ $forum->name }}</a>
					@if(auth()->check() && auth()->user()->hasRole('member'))
						<a href="/forum/{{ $forum->slug }}/topic" class="btn btn-primary btn-xs pull-right">Add Topic</a>
					@endif
				</h2>
				@if($forum->show_description)
					<article>
						<p>{{ $forum->description }}</p>
					</article>
				@endif
			</header>

			@foreach($forum->topics as $topic)
				<section class="well-sub">
					<h3>
						<a href="/forum/{{ $forum->slug }}/topic/{{ $topic->slug }}" class="well-sub-link">
							{{ $topic->name }} {{ $topic->replies_count }}
						</a>
					</h3>
				</section>
			@endforeach
		@endforeach
	</section>
@endsection