<form action="/forum/reply" method="post">
	
	<input type="hidden" name="slug" value="{{ $slug }}">

	{{ csrf_field() }}

	<textarea name="body"></textarea>

	<button type="submit">Reply</button>
	
</form>