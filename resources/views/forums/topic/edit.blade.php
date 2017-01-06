@extends('layouts.main')

@section('header')
	<h1 class="text-center">Edit Topic {{ $topic->name }}</h1>
@endsection

@section('contents')
	<section class="well">
		<form action="/forum/topic" method="post">
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="slug" value="{{ $topic->slug }}">
			{{ csrf_field() }}
			
			<div class="form-group">
				<label class="control-label">Title</label>
				<input type="text" name="name" value="{{ old('name')? old('name'):$topic->name }}" class="form-control">
			</div>
			
			<div class="form-group">
				<textarea name="body" class="form-control">{{ old('body')? old('body'):$topic->body }}</textarea>
			</div>
			
			<div class="form-group text-right">
				<button type="submit" class="btn btn-primary">Update Topic</button>
			</div>

		</form>
	</section>
@endsection