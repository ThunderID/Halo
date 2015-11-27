@section('breadcrumb')
@include($views['widgets'] . 'breadcrumbs.breadcrumb', 	['breadcrumbs' => 	[
"Home"			=> route("cms.dashboard"),
"News"			=> route("cms.news"),
$data->title	=> ""
]
]
)
@stop

@section('main')

{{-- DELETE CONFIRMATION --}}
<div class='container-fluid'>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{-- ACTION --}}
					<div class='pull-right'>
						<a href='#delete' class="btn btn-danger pull-right" data-toggle='modal'>Delete</a>
						<a href='{{route("cms.news.edit", ["id" => $data->id])}}' class="btn btn-primary pull-right mr-s">Edit</a> 
					</div>
					<div class="spacious strong h4">{{ $data->title }}</div>
				</div>
				<div class="panel-body bg-gray-dark text-white">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							@foreach ($data->tags as $tag)
								<span class="label label-primary pl-s pr-s">{{$tag}}</span>
							@endforeach
							
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
							<blockquote>{!! $data->summary !!}</blockquote>
							<div>{!! $data->content !!}</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<strong>Image: Small</strong>
									<p>{!! Html::image($data->image_s,'', ['class' => 'img-thumbnail img-responsive']) !!}
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
										<strong>Image: Medium</strong>
										<p>{!! Html::image($data->image_s,'', ['class' => 'img-thumbnail img-responsive']) !!}
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											<strong>Image: Large</strong>
											<p>{!! Html::image($data->image_s,'', ['class' => 'img-thumbnail img-responsive']) !!}
											</div>
										</div>

									</div>
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
										<p>
											<strong>Published At:</strong>
											<br>{{$data->published_at ? $data->published_at->format('d-M-Y [H:i]') : 'draft'}}
										</p>
										<p>
											<strong>Views:</strong>
											<br>{{number_format($data->views)}}
										</p>

										<hr>
										<p>
											<strong>Created By:</strong>
											<br>{{$data->user->name }}
										</p>
										<p>
											<strong>Created At:</strong>
											<br>{{$data->created_at ? $data->created_at->format('d-M-Y [H:i]') : 'draft'}}
										</p>
										<p>
											<strong>Updated At:</strong>
											<br>{{$data->updated_at ? $data->updated_at->format('d-M-Y [H:i]') : 'draft'}}
										</p>
									</div>
								</div>
							</div>
							{{-- ACTION --}}
							<div class="panel-footer">
								<a  href='#delete' class="btn btn-danger" data-toggle='modal'>Delete</a>
								<a href='{{route("cms.news.edit", ["id" => $data->id])}}' class="btn btn-primary pull-right">Edit</a>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								{{-- ACTION --}}
								<div class="spacious strong h4">Update History</div>
							</div>
							<div class="panel-body">
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- DELETE CONFIRMATION --}}
			<div class="modal fade" id="delete">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Delete Confirmation</h4>
						</div>
						<div class="modal-body">
							Delete {{$data->title}}?
						</div>
						<div class="modal-footer">
							{!! Form::open(['url' => route('cms.news.delete', ['id' => $data->id]), 'method' => 'put']) !!}
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Yes, I am sure</button>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
			@stop


