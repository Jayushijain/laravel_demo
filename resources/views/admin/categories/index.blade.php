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



<h1><b>Categories</b></h1>
<table class="table">
	<th>Id</th>
	<th>Name</th>
	<th>Created</th>
	<th>Updated</th>
	<th>Action</th>

	@if ($categories)
	
	@foreach ($categories as $category)
	<tr>
		<td>{{ $category->id }}</td>
		<td>{{ $category->name }}</td>
		<td>{{ $category->created_at->diffForHumans() }}</td>
		<td>{{ $category->updated_at->diffForHumans() }}</td>
		<td>
			<a href="{{ route('admin.categories.edit',$category->id) }}">Edit</a>
			{{-- <a href="{{ route('admin.users.destroy',$user->id) }}">Delete</a> --}}
		</td>
	</tr>
	@endforeach

	@endif
</table>
@stop