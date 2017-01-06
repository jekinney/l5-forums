@extends('layouts.main')

@section('header')
	<h1 class="text-center">{{ $forum->name }}</h1>
	<p class="text-center">{{ $forum->description }}</p>
@endsection

@section('contents')
	<section class="well">
		<form action="/forum/topic" method="post">
			
			<input type="hidden" name="forum" value="{{ $forum->slug }}">
			{{ csrf_field() }}
			
			<div class="form-group">
				<label class="control-label">Title</label>
				<input type="text" name="name" value="{{ old('name') }}" class="form-control">
			</div>
			
			<div class="form-group">
				<textarea name="body" class="form-control">{{ old('body') }}</textarea>
			</div>
			
			<div class="form-group text-right">
				<button type="submit" class="btn btn-primary">Add Topic</button>
			</div>
			
		</form>
	</section>
@endsection