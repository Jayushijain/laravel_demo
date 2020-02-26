@extends('layouts.admin')

@section('content')

@if (Session::has('msg'))
	<div class="alert alert-success alert-block fade in" id="alert" style="display:block;">
	<button data-dismiss="alert" class="close close-sm" type="button">
		<i class="fa fa-times"></i>
	</button>
	<h4>
		<i class="icon-ok-sign"></i>
		Success!
	</h4>
	<p>{{ session('msg') }}</p>
</div>
@endif

<h1><b>Photos</b></h1>
<table class="table">
	<tr>
		<th>Id</th>		
		<th>name</th>		
		<th>size</th>
		<th>Created</th>
		<th>Updated</th>
		
	</tr>
	@if ($photos)

		@foreach ($photos as $photo)
	
			<tr>
				<td>{{ $photo->id}}</td>
				<td><img height = "50" width = "50" src="{{ $photo->file}}" alt=""></td>
				<td>{{ $photo->size }}</td>
				<td>{{ $photo->created_at->diffForHumans() }}</td>
				<td>{{ $photo->updated_at->diffForHumans() }}</td>
				<td>
					{!! Form::open(['method'=>'delete','action'=>['MediasController@destroy',$photo->id]]) !!}

					<div class="form-group">
						{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}		
					</div>

					{!! Form::close() !!}
				</td>
				{{-- <td><a href="{{ route('admin.media.edit',$photo->id) }}">Edit</a></td> --}}
			</tr>

		@endforeach

	@endif
</table>

@stop