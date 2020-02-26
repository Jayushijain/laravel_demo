@extends('layouts.admin')

@section('content')

<h1><b>Comments</b></h1>
@if (count($comments) > 0)

<table class="table">
	<th>Id</th>
	<th>Name</th>
	<th>Email</th>
	<th>Body</th>
	<th>Created</th>
	<th>Updated</th>
	<th>Action</th>

	
	
	@foreach ($comments as $comment)
	<tr>
		<td>{{ $comment->id }}</td>
		<td>{{ $comment->author }}</td>
		<td>{{ $comment->email }}</td>
		<td>{{ $comment->body }}</td>
		<td>{{ $comment->created_at->diffForHumans() }}</td>
		<td>{{ $comment->updated_at->diffForHumans() }}</td>
		<td>
			@if ($comment->is_active == 1)

			{!! Form::open(['method'=>'patch','action'=>['PostCommentsController@update',$comment->id]]) !!}
			{{ csrf_field() }}

			<input type="hidden" name="is_active" value="0">

			<div class="form-group">
				{!! Form::submit('Un-approve',['class'=>'btn btn-danger']) !!}				
			</div>

			{!! Form::close() !!}

			@else
	
				{!! Form::open(['method'=>'patch','action'=>['PostCommentsController@update',$comment->id]]) !!}
			{{ csrf_field() }}

			<input type="hidden" name="is_active" value="1">

			<div class="form-group">
				{!! Form::submit('Approve',['class'=>'btn btn-success']) !!}				
			</div>

			{!! Form::close() !!}

			@endif
		</td>
		<td>
			{!! Form::open(['method'=>'delete','action'=>['PostCommentsController@destroy',$comment->id]]) !!}
			{{ csrf_field() }}

			<div class="form-group">
				{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}				
			</div>

			{!! Form::close() !!}
		</td>
		<td><a href="{{ route('home.post',$comment->post_id) }}">View Post</a></td>
	</tr>
	@endforeach

	@else

	<h1 class="text-center">No Comments</h1>

	@endif
</table>

@stop