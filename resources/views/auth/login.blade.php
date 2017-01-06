
<form action="/auth/login" method="post">

	{{ csrf_field() }}

	<input type="email" name="email">

	<input type="password" name="password">

	<button type="submit">Login</button>

</form>