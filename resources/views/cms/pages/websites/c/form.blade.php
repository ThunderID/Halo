<form method='post' action="{{ route('cms.website.store', ['id' => $website->id]) }}">
	{!! csrf_field() !!}

	<div class="panel panel-default">
		<div class="panel-heading">
			<a href='{{ route("cms.website") }}' class='btn btn-primary pull-left mr-m'><i class='fa fa-chevron-left'></i></a>
			<div class="spacious strong h4">{{ $website->name or "Create new website"}}</div>
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
					Website Name {!! Form::text('name', $website->name, ['class' => 'form-control']) !!}
				</div>
				<div class="col-xs-12 mb-s col-sm-6">
					URL {!! Form::text('url', $website->url, ['class' => 'form-control','placeholder' => 'http://']) !!}
				</div>
				<div class="col-xs-12 mb-s col-sm-6">
					Launched At {!! Form::text('launched_at', $website->launched_at ? $website->launched_at->format('d/m/Y') : null, ['class' => 'form-control','placeholder' => 'dd/mm/yyyy', 'data-inputmask' => "'alias':'date'"]) !!}
				</div>

				{{-- SOCIAL MEDIA --}}
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<hr>
					<h5>SOCIAL MEDIA</h5>
					<hr>
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Facebook {!! Form::text('facebook', $website->facebook, ['class' => 'form-control']) !!}
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Twitter {!! Form::text('twitter', $website->twitter, ['class' => 'form-control']) !!}
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Instagram {!! Form::text('instagram', $website->instagram, ['class' => 'form-control']) !!}
				</div>

				{{-- LOGO --}}
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<hr>
					<h5>LOGO</h5>
					<hr>
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Small {!! Form::text('image_s', $website->small_images->first()->path, ['class' => 'form-control','placeholder' => 'http://']) !!}
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Medium {!! Form::text('image_m', $website->medium_images->first()->path, ['class' => 'form-control','placeholder' => 'http://']) !!}
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Large {!! Form::text('image_l', $website->large_images->first()->path, ['class' => 'form-control','placeholder' => 'http://']) !!}
				</div>
			</div>
		</div>
		<div class='panel-footer text-center'>
			<button type="{{ route('cms.website') }}" class="btn btn-default pl-m pr-m">Cancel</button>
			<button type="submit" class="btn btn-primary pl-m pr-m">Save</button>
		</div>
	</div>
</form>