@extends('layouts.admin')

@section('content')

<h1><b>Create Category</b></h1>

{!! Form::open(['method'=>'post','action'=>'CategoriesController@store']) !!}
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
		{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
		
	</div>
{!! Form::close() !!}

@include('includes.form_errors')
@stop