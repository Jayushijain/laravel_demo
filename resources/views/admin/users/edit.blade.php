@extends('layouts.admin')

@section('content')
<h1><b>Edit Users</b></h1>

@include('includes.form_errors')

{!! Form::model($user,['method'=>'PATCH','action'=>['UsersController@update',$user->id],'files'=>true]) !!}
{{ csrf_field() }}

	<div class="form-group">
		<img height = "100" width = "100" src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" class="img-responsive img-rounded">
	</div>
	<div class="form-group">
		{!! Form::label('photo_id','File:') !!}
		{!! Form::file('photo_id') !!}
	</div>

	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		{!! Form::label('name','Name:') !!}
		{!! Form::text('name',null,['class'=>'form-control']) !!}
		@if ($errors->has('name'))		
			<div class="alert alert-danger">
				@foreach ($errors->get('name') as $msg)
					{{$msg}}
				@endforeach
			</div>
	@endif
	</div>

	<div class="form-group">
		{!! Form::label('email','Email:') !!}
		{!! Form::email('email',null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('role_id','Role:') !!}
		{!! Form::select('role_id',[''=>'Select Roles']+ $roles,null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('is_active','Status:') !!}
		{!! Form::select('is_active',array(1=>'Active',0=>'Inactive'),null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('password','Password:') !!}
		{!! Form::password('password',['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
		
	</div>
{!! Form::close() !!}

{!! Form::open(['method'=>'DELETE','action'=>['UsersController@destroy',$user->id]]) !!}
{{ csrf_field() }}
	<div class="form-group">
		{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
		
	</div>

{!! Form::close() !!}


@stop