@extends('layouts.main')

@section('contents')
	<section class="well">
		<div class="well-sub">
			<header>
				<h1>
					{{ $topic->name }}
					@if(auth()->check() && auth()->user()->hasRole('admin'))
						<form action="/forum/topic/{{ $topic->id }}/hide" method="post" class="pull-right">
							
							{{ csrf_field() }}

							<button type="submit" class="btn btn-danger btn-sm">Hide</button>

						</form>
					@endif
				</h1>
				<p>{{ $topic->user->name }} posted on {{ $topic->published_at }}</p>
			</header>
			<article>{{ $topic->body }}</article>
		</div>
		
		@foreach($topic->replies as $reply)
			<section class="well-sub">
				<p>{{ $reply->user->name }} posted on {{ $reply->published_at }}</p>

				<article>{{ $reply->body }}</article>
			</section>
		@endforeach

		@if(auth()->check() && auth()->user()->hasRole('member'))
			<form action="/forum/reply" method="post" class="well-sub">
				
				<input type="hidden" name="slug" value="{{ $topic->slug }}">
				
				{{ csrf_field() }}
				
				<div class="form-group">
					<label>Reply</label>
					<textarea name="body" class="form-control">{{ old('body') }}</textarea>
				</div>
				
				<div class="form-group text-right">
					<a href="/forum/topic/{{ $topic->slug }}/reply" class="btn btn-default">Advanced Reply</a>
					<button type="submit" class="btn btn-primary">Add Reply</button>
				</div>

			</form>
		@endif

@endsection