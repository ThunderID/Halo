<div class="panel panel-default">
	{{-- HEADERS --}}
	<div class="panel-heading">
		<a href='{{ route("cms.website.create")}}' class='pull-right btn btn-primary'><i class="fa fa-plus"></i></a>
		<a class='pull-right btn btn-primary mr-s' data-toggle="collapse" href="#search_website">
			<i class="fa fa-search"></i>
		</a>
		<div class='h4 spacious-s'>Website {{$data->currentPage() > 1 ? '/ Page ' . $data->currentPage() : '' }}</div>
	</div>

	{{-- SEARCH --}}
	<div id='search_website' class='collapse panel-body bg-gray-dark'>
		{!! Form::open(['method' => 'get', 'url' => route('cms.website') ]) !!}
			<div class="row">
				<div class="col-xs-9 col-sm-4 col-md-4 col-lg-4">
					<div class="input-group">
						<div class="input-group-addon">website</div>
						{!! Form::text('name', $filters['name'], ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<button type='submit' class='btn btn-primary'>Search</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>

	{{-- FILTERS --}}
	@if (array_filter($filters))
	<div class="panel-body bg-primary">
		<a href='{{ route("cms.website") }}' class='pull-right text-white '>x reset</a>
		<i class='fa fa-search mr-s'></i>
		@foreach ($filters as $k => $v)
		<a href="{{ route('cms.website', array_except($filters, $k)) }}">
			<span class="label label-default">
				<i class="fa fa-remove"></i>
				{{$k}}: {{$v}} 
			</span>
		</a>
		@endforeach
	</div>
	@endif

	{{-- BODY --}}
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th class='hidden-xs'>Social Media</th>
					<th class='hidden-xs'>Launched At</th>
					<th width='100'></th>
				</tr>
			</thead>
			<tbody>
				@forelse ($data as $k => $v)
				<?php $k++; ?>
				<tr>
					<td valign='top'>{{$data->firstItem() + ($k - 1)}}.</td>
					<td valign='top'>{{$v->name}}</td>
					<td valign='top' class='hidden-xs'>
						<i class='fa fa-facebook-square blue-text text-darken-3'></i> {{$v->facebook}}
						<br><i class='fa fa-twitter-square light-blue-text'></i> {{$v->twitter}}
						<br><i class='fa fa-instagram brown-text'></i> {{$v->instagram}}
					</td>
					<td valign='top' class='hidden-xs'>{{$v->launched_at ? $v->launched_at->format('d-M-Y') : ''}}</td>
					<td valign='top' class='text-right'>
						<div class="btn-group">
							<a href="{{route('cms.website.edit', ['id' => $v->id])}}" class='btn btn-default' title='edit'><i class='fa fa-pencil'></i></a>
							<a href="{{route('cms.website.show', ['id' => $v->id])}}" class='btn btn-default' title='detail'><i class='fa fa-eye'></i></a>
						</div>
					</td>
				</tr>
				@empty
				<tr>
					<td valign='top' colspan='9'>
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