<?php
$required_variables = ['events'];
foreach ($required_variables as $x)
{
	if (!array_key_exists($x, get_defined_vars(oid)))
	{
		throw new Exception($widget_name . ": \$$x: Required", 1);
	}
}
?>

<div class="panel panel-halo panel-halo-primary">
	<div class="panel-body">
		<div class="title">Upcoming Events</div>
		@forelse ($events as $event)
		<div class="row pt-s pb-s {{ $event->ads > 0 ? 'bg-warning' : ''}}">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				{{-- {!! Html::image($event->getImage('md')->path, $event->title, ['class' => 'img-responsive']) !!} --}}
				<div>
					<div class='bg-primary text-center pt-s pb-s'>{{$event->started_at->format('d')}}</div>
					<div class='bg-info text-center text-uppercase'>{{$event->started_at->format('M')}}</div>
				</div>
			</div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<a href="">{{ $event->title }}</a>
				<br>{{$event->location}}
			</div>
		</div>
		<hr class='mt-0 mb-0'>
		@empty
		No Event Found
		@endforelse

		@if ($events->count())
			<div class='mt-m'>
				<a href="" class='btn btn-block btn-primary'>LIHAT SEMUA</a>
			</div>
		@endif
	</div>
</div>
