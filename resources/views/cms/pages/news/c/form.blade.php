<form method='post' action="{{ route('cms.news.store', ['id' => $data->id]) }}">
	{!! csrf_field() !!}

	<div class="panel panel-default">
		<div class="panel-heading">
			<a href='{{ route("cms.news") }}' class='btn btn-primary pull-left mr-m'><i class='fa fa-chevron-left'></i></a>
			<div class="spacious strong h4">{{ $data->title or "Create new news"}}</div>
		</div>
		@if ($errors->count())
		<div class="panel-body bg-danger text-white">
			<i class="fa fa-exclamation-triangle text-white pull-left fa-2x"></i>
			@foreach ($errors->all() as $x)
			{{$x}}<br>
			@endforeach
		</div>
		@endif
		<div class="panel-body">

			<div class="row">
				<div class="col-xs-12 mb-s col-sm-12">
					Website {!! Form::select('websites', $website_list, $data->websites, ['class' => 'select2', 'multiple' => 'multiple', 'style' => 'width:100%']) !!}
				</div>
				<div class="col-xs-12 mb-s col-sm-12">
					Title {!! Form::text('title', $data->title, ['class' => 'form-control']) !!}
				</div>
				<div class="col-xs-12 mb-s col-sm-6">
					Slug {!! Form::text('slug', $data->slug, ['class' => 'form-control']) !!}
				</div>
				<div class="col-xs-12 mb-s col-sm-6">
					Tags {!! Form::select('tags[]', array_combine($data->tags, $data->tags), $data->tags, ['class' => 'select2-tags', 'multiple' => 'multiple', 'style' => 'width:100%']) !!}
				</div>

				<div class="col-xs-12 mb-s col-sm-12">
					Summary {!! Form::textarea('summary', $data->summary, ['class' => 'form-control']) !!}
				</div>

				<div class="col-xs-12 mb-s col-sm-12">
					Content 
					<br><span class='text-muted'>To add an image/video, paste the url to the content below and press enter</span>
					{!! Form::textarea('content', $data->content, ['class' => 'wysiwyg']) !!}
				</div>

				{{-- IMAGES --}}
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<hr>
					<h5>IMAGES</h5>
					<hr>
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Small {!! Form::text('image_s', $data->image_s, ['class' => 'form-control']) !!}
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Medium {!! Form::text('image_m', $data->image_m, ['class' => 'form-control']) !!}
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Large {!! Form::text('image_l', $data->image_l, ['class' => 'form-control']) !!}
				</div>

				{{-- IMAGES --}}
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<hr>
					<h5>PUBLICATION</h5>
					<hr>
				</div>
				<div class="col-xs-12 mb-s col-sm-4">
					Published At {!! Form::text('published_at', ($data->published_at ? $data->published_at->format('d/m/Y H:i') : null), ['class' => 'form-control', 'data-inputmask' => "'alias':'datetime'", 'placeholder' => 'dd/mm/yyyy hh:mm']) !!}
				</div>
				<div class="col-xs-12 mb-s col-sm-4">
					Created At <p class='pt-s'>{!! Form::label($data->created_at ? $data->created_at->format('d M Y [H:i]') : null) !!}</p>
				</div>
				<div class="col-xs-12 mb-s col-sm-4">
					Updated At <p class='pt-s'>{!! Form::label($data->updated_at ? $data->updated_at->format('d M Y [H:i]') : null) !!}</p>
				</div>
			</div>
		</div>
		<div class='panel-footer text-center'>
			<button type="{{ route('cms.news') }}" class="btn btn-default pl-m pr-m">Cancel</button>
			<button type="submit" class="btn btn-primary pl-m pr-m">Save</button>
		</div>
	</div>
</form>