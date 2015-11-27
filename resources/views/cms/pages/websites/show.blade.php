@section('breadcrumb')
@include($views['widgets'] . 'breadcrumbs.breadcrumb', 	['breadcrumbs' => 	[
"Home"		=> route("cms.dashboard"),
"Website"	=> route("cms.website"),
$data->name	=> ""
]
]
)
@stop

@section('main')
<div class='container-fluid'>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="spacious strong h4">{{ $data->name }}</div>
				</div>
				<div class="panel-body">
					<div class='text-center mb-s'>
						{!! Html::image($data->logo['m'], $data->name, ['class' => 'img-circle']) !!}
					</div>

					<p>
						<strong>URL</strong>
						<br>{{$data->url}}
					</p>

					<p>
						<strong>Launched At</strong>
						<br>{{$data->launched_at ? $data->launched_at->format('d M Y') . ' (' . $data->launched_at->diffForHumans(). ')' : ''}}
					</p>
				</div>
				<div class="panel-footer">
					<a href='#delete' class="btn btn-danger" data-toggle='modal'>Delete</a>
					<a href='{{route("cms.website.edit", ["website" => $data->id])}}' class="btn btn-primary pull-right">Edit</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Confirmation</h4>
			</div>
			<div class="modal-body">
				Delete {{$data->name}}?
			</div>
			<div class="modal-footer">
				{!! Form::open(['url' => route('cms.website.delete', ['id' => $data->id]), 'method' => 'put']) !!}
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Yes, I am sure</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop


