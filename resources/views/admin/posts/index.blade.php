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
				<td>{{ str_limit(ucwords($post->body),3) }}</td>
				<td>{{ $post->created_at->diffForHumans() }}</td>
				<td>{{ $post->updated_at->diffForHumans() }}</td>
				<td><a href="{{ route('admin.comments.show',$post->id,) }}">View Comments</a></td>
				<td><a href="{{ route('home.post',$post->id,) }}">View Post</a></td>
				<td><a href="{{ route('admin.posts.edit',$post->id) }}">Edit</a></td>

			</tr>

		@endforeach

	@endif
</table>

<div class="row">
	<div class="col-sm-6 col-sm-offset-5">
		{{ $posts->render() }}
	</div>
</div>
@stop