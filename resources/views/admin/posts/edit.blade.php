@extends('layouts.admin')

@section('content')

<h1><b>Edit Posts</b></h1>

{!! Form::model($post,['method'=>'PATCH','action'=>['PostsController@update',$post->id],'files'=>true]) !!}
{{ csrf_field() }}

	<div class="form-group">
		<img height = "100" width = "100" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" class="img-responsive img-rounded">
	</div>

	<div class="form-group">
		{!! Form::label('photo_id','File:') !!}
		{!! Form::file('photo_id',['class'=>'form-control']) !!}
	</div>

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
		{!! Form::label('body','Body:') !!}
		{!! Form::textarea('body',null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
		
	</div>
{!! Form::close() !!}

{!! Form::open(['method'=>'delete','action'=>['PostsController@destroy',$post->id]]) !!}

	<div class="form-group">
		{!! Form::submit('Delete',['class'=>'btn btn-primary']) !!}		
	</div>
{!! Form::close() !!}

@include('includes.form_errors')
@stop