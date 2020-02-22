@extends('layouts.admin');

@section('content')
<h1><b>Users</b></h1>
<table class="table">
	<th>Name</th>
	<th>Photo</th>
	<th>Email</th>
	<th>Role</th>
	<th>Status</th>
	<th>Created</th>
	<th>Updated</th>
	<th>Action</th>
	@if ($users)
	
		@foreach ($users as $user)
			<tr>
			<td>{{ $user->name }}</td>
			<td><img height = "50" width = "50" src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}"></td>
			{{-- <td>{{ $user->photo ? {!! 'img height = "50" width = "50" src="{{$user->photo->file"}}' !!} : 'No PHOTO'}}</td> --}}
			<td>{{ $user->email }}</td>
			<td>{{ $user->role->name }}</td>
			<td>{{ $user->is_active == 1 ? 'Active' : 'Inactive'}}</td>
			<td>{{ $user->created_at->diffForHumans() }}</td>
			<td>{{ $user->updated_at->diffForHumans() }}</td>
			<td><a href="{{ route('admin.users.edit',$user->id) }}">Edit</a></td>
		</tr>
		@endforeach

	@endif
</table>
@stop