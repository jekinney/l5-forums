
<form action="/auth/register" method="post">

	{{ csrf_field() }}
	
	<input type="text" name="name">

	<input type="email" name="email">

	<input type="password" name="password">
	
	<input type="password" name="password_confirmation">

	<button type="submit">Register</button>

</form>