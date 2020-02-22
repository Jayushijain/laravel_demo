@extends('layouts.admin');

@section('content')
<h1><b>Users</b></h1>
<table class="table">
	<th>Name</th>
	<th>Email</th>
	<th>Role</th>
	<th>Status</th>
	<th>Created</th>
	<th>Updated</th>
	@if ($users)
	
		@foreach ($users as $user)
			<tr>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->role->name }}</td>
			<td>{{ $user->is_active == 1 ? 'Active' : 'Inactive'}}</td>
			<td>{{ $user->created_at->diffForHumans() }}</td>
			<td>{{ $user->updated_at->diffForHumans() }}</td>
		</tr>
		@endforeach

	@endif
</table>
@stop