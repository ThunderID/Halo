<?php
	$required_variables = ['news'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . "= \$$x: Required", 1);
		}
	}
?>

<div class="row">
	@forelse ($news as $x)
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<div class="thumbnail bg-white">
			<img src="{{ $x->small_images->path }}" alt="">
			<div class="caption">
				<h3>{{ $x->title }}</h3>
				<p>
					{{$x->summary}}
				</p>
				<p>
					<a href="#" class="btn btn-primary">Action</a>
					<a href="#" class="btn btn-default">Action</a>
				</p>
			</div>
		</div>
	</div>
	@empty
	@endforelse
</div>