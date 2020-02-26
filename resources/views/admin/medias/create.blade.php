@extends('layouts.admin')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">

@stop

@section('content')

<h1><b>Upload Photos</b></h1>

{!! Form::open(['method'=>'post','action'=>'MediasController@store','class'=>'dropzone']) !!}

{!! Form::close() !!}

@include('includes.form_errors')
@stop

@section('scripts')
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>

@stop