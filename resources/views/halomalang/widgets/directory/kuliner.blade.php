<?php
	$required_variables = ['directories'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . "= \$$x: Required", 1);
		}
	}
?>

<div class="panel panel-halo panel-halo-warning">
	<div class="panel-body">
		<div class='title'>
			Kuliner Malang
		</div>
	</div>
	<div class="panel-body">
		{{$directories->first()->name}}
	</div>
	<div class="panel-body bg-warning">
		<div class='subtitle'>Promo Hari Ini</div>
	</div>
</div>

