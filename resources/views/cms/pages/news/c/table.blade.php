<div class="panel panel-default">
	{{-- HEADERS --}}
	<div class="panel-heading">
		<a href='{{ route("cms.news.create")}}' class='pull-right btn btn-primary'><i class="fa fa-plus"></i></a>
		<a class='pull-right btn btn-primary mr-s' data-toggle="collapse" href="#search_data">
			<i class="fa fa-search"></i>
		</a>
		<div class='h4 spacious-s'>News {{$data->currentPage() > 1 ? '/ Page ' . $data->currentPage() : '' }}</div>
	</div>

	{{-- SEARCH --}}
	<div id='search_data' class='collapse panel-body bg-gray-dark'>
		{!! Form::open(['method' => 'get', 'url' => route('cms.news') ]) !!}
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<div class="input-group">
						<div class="input-group-addon">web</div>
						{!! Form::select('web', $website_list, $filters['web'], ['class' => 'select2', 'style' => 'width:100%', 'multiple' => 'multiple']) !!}
					</div>
				</div>

				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<div class="clearfix hidden-sm hidden-md hidden-lg">&nbsp;</div>
					<div class="input-group">
						<div class="input-group-addon">title</div>
						{!! Form::text('title', $filters['title'], ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<div class="clearfix hidden-sm hidden-md hidden-lg">&nbsp;</div>
					<div class="input-group">
						<div class="input-group-addon">tags</div>
						{!! Form::text('tags', $filters['tags'], ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<div class="clearfix hidden-sm hidden-md hidden-lg">&nbsp;</div>
					<button type='submit' class='btn btn-primary'>Search</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>

	{{-- FILTERS --}}
	@if (array_filter($filters))
	<div class="panel-body bg-primary">
		<a href='{{ route("cms.news") }}' class='pull-right text-white '>x reset</a>
		<i class='fa fa-search mr-s'></i>
		@foreach (array_filter($filters) as $k => $v)
		<a href="{{ route('cms.news', array_except($filters, $k)) }}">
			<span class="label label-default mr-s">
				<i class="fa fa-remove"></i>
				{{$k}}: {{$v}} 
			</span>
		</a>
		@endforeach
	</div>
	@endif

	{{-- BODY --}}
	<div class="panel-body">
		<table class="table table-hover small">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th class='hidden-xs'>Tags</th>
					<th>Status</th>
					<th width='95'></th>
				</tr>
			</thead>
			<tbody>
				@forelse ($data as $k => $v)
				<?php $k++; ?>
				<tr>
					<td valign='top'>{{$data->firstItem() + ($k - 1)}}.</td>
					<td valign='top'>{{$v->title}}</td>
					<td valign='top' class='hidden-xs'>
						@foreach ($v->tags as $tag)
							<span class="label label-primary pr-s pl-s">#{{$tag}}</span>
						@endforeach
					</td>
					<td valign='top'>
						{{$v->published_at ? 'Published ' . $v->published_at->diffForHumans() : 'draft'}}
						@foreach ($v->websites as $website)
							{{$website}}
						@endforeach
					</td>
					<td valign='top' class='text-right'>
						<div class="btn-group">
							<a href="{{route('cms.news.edit', ['id' => $v->id])}}" class='btn btn-default' title='edit'><i class='fa fa-pencil'></i></a>
							<a href="{{route('cms.news.show', ['id' => $v->id])}}" class='btn btn-default' title='detail'><i class='fa fa-eye'></i></a>
						</div>
					</td>
				</tr>
				@empty
				<tr>
					<td valign='top' colspan='100'>
						<em class='grey-text thin'>No data found</em>
					</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	<div class="panel-footer">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 pt-s">
				@if ($data->count())
					<p>Showing {{$data->firstItem()}} - {{$data->lastItem()}} of {{$data->total()}}</p>
				@endif
			</div>
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 text-right pt-0 pb-0">
				@if ($data->lastPage() > 1)
					{!! $data->appends($filters)->render() !!}
				@endif
			</div>
		</div>
	</div>
</div>