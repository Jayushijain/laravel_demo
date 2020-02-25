@extends('layouts.admin')

@section('content')

<h1><b>Edit Category</b></h1>

{!! Form::model($category,['method'=>'patch','action'=>['CategoriesController@update',$category->id]]) !!}
{{ csrf_field() }}

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
		{!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
		
	</div>
{!! Form::close() !!}

{!! Form::open(['method'=>'delete','action'=>['CategoriesController@destroy',$category->id]]) !!}
<div class="form-group">
		{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
		
	</div>
{!! Form::close() !!}

@include('includes.form_errors')
@stop