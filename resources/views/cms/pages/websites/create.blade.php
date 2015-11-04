@section('breadcrumb')
@include($views['widgets'] . 'breadcrumbs.breadcrumb', 	['breadcrumbs' => 	[
"Home"			=> route("cms.dashboard"),
"Website"		=> route("cms.website"),
"Create or edit" 	=> ''
]
]
)
@stop

@section('main')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				@include($views['pages'] . 'c.form', ['website' => $website])
			</div>
		</div>
	</div>
@stop