<?php
	$required_variables = ['promo'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . "= \$$x: Required", 1);
		}
	}
?>

<div class="panel panel-halo panel-halo-success">
	<div class="panel-body">
		<div class='title'>
			Promo Hari Ini
			<small class='pull-right'>{{ \Carbon\Carbon::now()->format('d M Y') }}</small>
		</div>
	</div>
</div>

