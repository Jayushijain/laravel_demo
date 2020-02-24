@extends('layouts.admin')

@section('content')

<h1><b>Create Posts</b></h1>

{!! Form::open(['method'=>'post','action'=>'PostsController@store','files'=>true]) !!}
{{ csrf_field() }}

	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		{!! Form::label('title','Title:') !!}
		{!! Form::text('title',null,['class'=>'form-control']) !!}
		@if ($errors->has('title'))		
			<div class="alert alert-danger">
				@foreach ($errors->get('title') as $msg)
					{{$msg}}
				@endforeach
			</div>
	@endif
	</div>

	<div class="form-group">
		{!! Form::label('category_id','category:') !!}
		{!! Form::select('category_id',[''=>'Select category'] + $categories,null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('photo_id','File:') !!}
		{!! Form::file('photo_id',['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('body','Body:') !!}
		{!! Form::textarea('body',null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
		
	</div>
{!! Form::close() !!}

@include('includes.form_errors')
@stop