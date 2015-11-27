@section('body_class')
bg-grey
@stop

@section('nav')
@include($views['widgets'] . 'nav.nav')
@stop

@section('footer')
@stop

@section('alerts')
	@foreach (['success' => 'check-circle', 'danger' => 'exclamation-triangle', 'info' => 'info-circle', 'warning' => 'exclamation-circle'] as $alert_type => $icon)
		@if (Session::has('alert_' . $alert_type))
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="alert alert-{{$alert_type}}">
							<div class='pull-left mr-m'><i class='fa fa-{{$icon}} fa-3x'></i></div>
							<div class='pt-s mb-s'>
								{{ Session::get('alert_' . $alert_type) }}
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	@endforeach
@stop

@section('js')
{!! Html::script(asset('plugins/redactor/redactor.js')) !!}
{!! Html::style(asset('plugins/redactor/redactor.css') )!!}

{!! Html::script(asset('plugins/select2/select2.min.js')) !!}
<script>
	$(document).ready(function() {
		// INPUT MASK
		$("input").inputmask();

		// WYSIWYG
		$('.wysiwyg').redactor({
			minHeight : $(this).attr('data-height') ? $(this).attr('data-height') + 'px' : 500,
			toolbarFixed: true,
			dir: '/images/'
		});

		// TAGS
		$('.select2').select2();
		$('.select2-tags').select2({
			tags: true
		});
	});
</script>
@stop
