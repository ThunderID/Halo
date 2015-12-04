@section('main')

{{-- MOBILE --}}
<div class="visible-xs container">
	<div class="row">
		<div class="col-xs-3 text-center">
			<a href='' class='btn btn-facebook'><i class='fa fa-facebook'></i></a>
		</div>
		<div class="col-xs-3 text-center">
			<a href='' class='btn btn-twitter'><i class='fa fa-twitter'></i></a>
		</div>
		<div class="col-xs-3 text-center">
			<a href='' class='btn btn-instagram'><i class='fa fa-instagram'></i></a>
		</div>
		<div class="col-xs-3 text-center">
			<a href='' class='btn btn-youtube'><i class='fa fa-youtube'></i></a>
		</div>
	</div>
</div>


{{-- DESKTOP --}}
<div class='hidden-xs container-fluid'>

	{{-- HEADLINE --}}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			{{-- @include($views['widgets'] . 'headline.home') --}}
		</div>
	</div>

</div>

<div class='hidden-xs container'>
	<div class="row mt-l">
		{{-- MAIN --}}
		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-5">

			{{-- KULINER --}}
			@include($views['widgets'] . 'directory.kuliner', ['directories' => $kuliner, 'colcount_xs' => 3,'colcount_sm' => 3,'colcount_md' => 3,'colcount_lg' => 3])

			{{-- NEWS --}}

			{{-- AREMA --}}
			{{-- BIOSKOP --}}
			{{-- TRANSPORTASI --}}
			{{-- SEKOLAH --}}
			{{-- KESEHATAN --}}
			{{-- @include($views['widgets'] . '.news.index_grid', ['news' => $news]) --}}

			{{-- INFO KULINER TERBARU --}}
			{{-- LIPSUS --}}
			{{-- ADS --}}
		</div>

		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-4">

			{{-- UPCOMING EVENTS --}}
			@include($views['widgets'] . 'events.list', ['events' => $upcoming_events, 'colcount_xs' => 3,'colcount_sm' => 3,'colcount_md' => 3,'colcount_lg' => 3])

			{{-- NEWS --}}
			{{-- @include($views['widgets'] . '.news.index_grid', ['news' => $news]) --}}

			{{-- INFO KULINER TERBARU --}}
			{{-- LIPSUS --}}
			{{-- ADS --}}
		</div>

		{{-- SIDEBAR --}}
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-3">
			{{-- STAY UPDATED --}}
			@include($views['widgets'] . '.promo.today', ['promo' => null])

			{{-- SUBSCRIPTION --}}
			@include($views['widgets'] . '.promo.today', ['promo' => null])
			
			{{-- BIOSKOP --}}
			{{-- @include($views['widgets'] . '.promo.today') --}}

			{{-- CUACA --}}
			{{-- @include($views['widgets'] . '.promo.today') --}}

			{{-- LALU LINTAS --}}
			{{-- @include($views['widgets'] . '.promo.today') --}}
			<a class="twitter-timeline" href="https://twitter.com/hashtag/halolalin" data-widget-id="672080199551352832">#halolalin Tweets</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

			{{-- SUARA NGALAMERS --}}

		</div>

	</div>

	{{-- PARTNERS --}}

</div>
@stop