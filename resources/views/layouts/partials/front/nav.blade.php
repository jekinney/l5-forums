<nav class="navbar navbar-default">
  	<div class="container">
  		<!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
	    		data-target="#top-nav" 
	    		aria-expanded="false"
	    	>
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="#">Forums</a>
		</div>

		<div class="collapse navbar-collapse" id="top-nav">
      		<ul class="nav navbar-nav">
				<li><a href="/forum">Forums</a></li>
      		</ul>
      		<ul class="nav navbar-nav navbar-right">
				@if(auth()->check())
					<li class="dropdown">
          				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">	{{ auth()->user()->name }} <span class="caret"></span>
          				</a>
          				<ul class="dropdown-menu">
				            <li><a href="/auth/logout">logout</a></li>
				        </ul>
				    </li>
				@else 
					<li><a href="/auth/login">Login</a></li>
					<li><a href="/auth/register">Register</a></li>
				@endif
      		</ul>
      	</div>
	</div>
</nav>