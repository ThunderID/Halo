@section('body_class')
bg-gray-lighter
@overwrite

@section('nav')
@overwrite

@section('main')
<div class='container mt-xxl pt-xxl'>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4 text-center">
			<h1 class="uppercase light large text-center mb-xl">Halo Media Nusantara</h1>
		</div>
		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
			<form action="{{ route('cms.login.post') }}" method="POST" role="form">
				{!! csrf_field() !!}
				<div class="well well-lg bg-white">
					@if ($errors->count())
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class='fa fa-exclamation-triangle fa-6'></i>
						@foreach ($errors->all() as $x)
						{{$x}}<br>
						@endforeach
					</div>
					@endif
					<p class='mb-l'>Sign in with your account</p>
					<div class='mb-l'>
						<input type="email" name="email" id="inputEmail" class="form-control" value="" required="required" title="" placeholder='email'>
					</div>
					<div class='mb-l'>
						<input type="password" name="password" id="input" class="form-control" value="" required="required" pattern="" title="" placeholder="password">
					</div>
					<div class='text-center'>
						<button type="submit" class="btn btn-primary uppercase pr-m pl-m">Login </button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@stop

@section('alert')
@overwrite

@section('footer')

@overwrite

