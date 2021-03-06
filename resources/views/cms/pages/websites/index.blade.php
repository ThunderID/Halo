@section('breadcrumb')
	@include($views['widgets'] . 'breadcrumbs.breadcrumb', 	['breadcrumbs' => 	[
																					"Home"		=> route("cms.dashboard"),
																					"Website"	=> "",
																				]
															]
	)
@stop

@section('main')
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				@include($views['pages'] . 'c.table', ['websites' => $websites])
			</div>
		</div>
	</div>
@stop