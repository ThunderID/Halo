@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
			@include($views['widgets'] . '.menu.manage_web')
			@include($views['widgets'] . '.menu.manage_company')
		</div>
	</div>
</div>
@stop