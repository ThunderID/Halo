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
					Website Name
					<input value="{{ Input::old('name', $website->name)}}" name="name" type="text" class="form-control" id="" placeholder="">
				</div>
				<div class="col-xs-12 mb-s col-sm-6">
					URL
					<input value="{{ Input::old('url', $website->url)}}" name="url" type="text" class="form-control" id="" placeholder="http://">
				</div>
				<div class="col-xs-12 mb-s col-sm-6">
					Launched At
					<input type="text" name="launched_at" id="input" class="form-control" value="{{ Input::old('launched_at', $website->launched_at ? $website->launched_at->format('d/m/Y') : '' )}}" required="required" title="" data-inputmask="'alias': 'date'">
				</div>

				{{-- SOCIAL MEDIA --}}
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h5>SOCIAL MEDIA</h5>
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Facebook
					<input value="{{ Input::old('facebook', $website->facebook)}}" name="facebook" type="text" class="form-control" id="" placeholder="">
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Twitter
					<input value="{{ Input::old('twitter', $website->twitter)}}" name="twitter" type="text" class="form-control" id="" placeholder="">
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Instagram
					<input value="{{ Input::old('instagram', $website->instagram)}}" name="instagram" type="text" class="form-control" id="" placeholder="">
				</div>

				{{-- LOGO --}}
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h5>LOGO</h5>
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Small Logo
					<input value="{{ Input::old('small_logo', $website->small_logo)}}" name="small_logo" type="text" class="form-control" id="" placeholder="http://drive.thunder.id/">
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Medium Logo
					<input value="{{ Input::old('medium_logo', $website->medium_logo)}}" name="medium_logo" type="text" class="form-control" id="" placeholder="http://drive.thunder.id/">
				</div>

				<div class="col-xs-12 mb-s col-sm-4">
					Large Logo
					<input value="{{ Input::old('large_logo', $website->large_logo)}}" name="large_logo" type="text" class="form-control" id="" placeholder="http://drive.thunder.id/">
				</div>
			</div>
		</div>
		<div class='panel-footer text-center'>
			<button type="{{ route('cms.website') }}" class="btn btn-default pl-m pr-m">Cancel</button>
			<button type="submit" class="btn btn-primary pl-m pr-m">Save</button>
		</div>
	</div>
</form>