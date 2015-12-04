<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . "= \$$x: Required", 1);
		}
	}
?>

<div class="row headline-container">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 headline-item">
		<a href="">
			{!! Html::image('https://c1.staticflickr.com/5/4032/4656100038_e616b7f820_b.jpg', '', ['style' => 'height:100%']) !!}
			<div class='caption'>
				Malang
			</div>
		</a>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 headline-item">
		<a href="">
			{!! Html::image('https://c1.staticflickr.com/5/4032/4656100038_e616b7f820_b.jpg', '') !!}
			<div class='caption'>
				Malang
			</div>
		</a>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 headline-item">
		<a href="">
			{!! Html::image('https://c1.staticflickr.com/5/4032/4656100038_e616b7f820_b.jpg', '') !!}
			<div class='caption'>
				Malang
			</div>
		</a>
	</div>
</div>