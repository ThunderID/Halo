<div class='container-fluid'>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="well bg-white">
				<?php $i = 0; ?>
				@forelse ($breadcrumbs as $label => $link)
				@if ($i)
				/
				@endif

				@if ($link)
				<a href="{{$link}}" class='pl-xs pr-xs'>{{$label}}</a>
				@else
				<span class='pl-xs strong xl'>{{$label}}</span>
				@endif
				<?php $i ++; ?>
				@empty
				Breadcrumb is not set
				@endforelse
			</div>
		</div>
	</div>
</div>
