<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#"><img src="{{asset('images/logo/hmn.png')}}" height='40' style='margin-top:-10px;'></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dashboard <b class="caret"></b></a>
				<ul class="dropdown-menu">
					@include($views['widgets'] . 'nav._dashboard')
				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Content <b class="caret"></b></a>
				<ul class="dropdown-menu">
					@include($views['widgets'] . 'nav._content')
				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
				<ul class="dropdown-menu">
					@include($views['widgets'] . 'nav._settings')
				</ul>
			</li>

		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Your Account <b class="caret"></b></a>
				<ul class="dropdown-menu">
					@include($views['widgets'] . 'nav._account')
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>
