@extends('layouts.admin')

@section('content')

<h1><b>Posts</b></h1>
<table class="table">
	<tr>
		<th>Id</th>		
		<th>Photo</th>		
		<th>User</th>
		<th>Category</th>
		<th>Title</th>
		<th>Body</th>
		<th>Created</th>
		<th>Updated</th>
		<th>Actions</th>
	</tr>
	@if ($posts)

		@foreach ($posts as $post)
	
			<tr>
				<td>{{ $post->id}}</td>
				<td><img height = "50" width = "50" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" alt=""></td>
				<td>{{ $post->user->name }}</td>
				<td>{{ $post->category ? $post->category->name : 'No category'}}</td>
				<td>{{ ucwords($post->title) }}</td>
				<td>{{ ucwords($post->body) }}</td>
				<td>{{ $post->created_at->diffForHumans() }}</td>
				<td>{{ $post->updated_at->diffForHumans() }}</td>
				<td><a href="">Edit</a></td>
			</tr>

		@endforeach

	@endif
</table>
@stop