@extends('layouts.admin')

@section('content')
<h1><b>Replies</b></h1>
@if (count($replies)>0)

<table class="table">
	<th>Id</th>
	<th>Name</th>
	<th>Email</th>
	<th>Body</th>
	<th>Created</th>
	<th>Updated</th>
	<th>Action</th>

	
	
	@foreach ($replies as $reply)
	<tr>
		<td>{{ $reply->id }}</td>
		<td>{{ $reply->author }}</td>
		<td>{{ $reply->email }}</td>
		<td>{{ $reply->body }}</td>
		<td>{{ $reply->created_at->diffForHumans() }}</td>
		<td>{{ $reply->updated_at->diffForHumans() }}</td>
		<td>
			@if ($reply->is_active == 1)

			{!! Form::open(['method'=>'patch','action'=>['CommentRepliesController@update',$reply->id]]) !!}
			{{ csrf_field() }}

			<input type="hidden" name="is_active" value="0">

			<div class="form-group">
				{!! Form::submit('Un-approve',['class'=>'btn btn-danger']) !!}				
			</div>

			{!! Form::close() !!}

			@else
	
				{!! Form::open(['method'=>'patch','action'=>['CommentRepliesController@update',$reply->id]]) !!}
			{{ csrf_field() }}

			<input type="hidden" name="is_active" value="1">

			<div class="form-group">
				{!! Form::submit('Approve',['class'=>'btn btn-info']) !!}				
			</div>

			{!! Form::close() !!}

			@endif
		</td>
		<td>
			{!! Form::open(['method'=>'delete','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}
			{{ csrf_field() }}

			<div class="form-group">
				{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}				
			</div>

			{!! Form::close() !!}
		</td>
		<td><a href="{{ route('home.post',$reply->comment->post->id) }}">View Post</a></td>
	</tr>
	@endforeach

	@else

	<h1 class="text-center">No Replies</h1>

	@endif
</table>

@stop