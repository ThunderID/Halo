<?php
	$required_variables = ['events', 'colcount_xs', 'colcount_sm', 'colcount_md', 'colcount_lg'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ": \$$x: Required", 1);
		}
	}

	if (12 % $colcount_xs != 0)
	{
		throw new Exception("\$colcount_xs must be a factor of 12", 1);
	}
	if (12 % $colcount_sm != 0)
	{
		throw new Exception("\$colcount_sm must be a factor of 12", 1);
	}
	if (12 % $colcount_md != 0)
	{
		throw new Exception("\$colcount_md must be a factor of 12", 1);
	}
	if (12 % $colcount_lg != 0)
	{
		throw new Exception("\$colcount_lg must be a factor of 12", 1);
	}
?>

<div class="row">
	@forelse ($events as $event)
		<div class="col-xs-{{12/$colcount_xs}} col-sm-{{12/$colcount_sm}} col-md-{{12/$colcount_md}} col-lg-{{12/$colcount_lg}}">
			<div class="thumbnail">
				<img src="{{$event->getImage('md')->path}}" alt="{{$event->title}}">
				<div class="caption">
					<h3>{{$event->title}}</h3>
					<p>{{$event->started_at->format('d M Y')}} {{ $event->started_at->diffInDays($event->ended_at) ? abs($event->started_at->diffInDays($event->ended_at)) . ' Hari ' : ''}}</p>
				</div>
			</div>
		</div>
	@empty
		No Event Found
	@endforelse
</div>
