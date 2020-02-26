@extends('layouts.blog-post');

@section('content')

<h1>{{ ucwords($post->title) }}</h1>

<!-- Author -->
<p class="lead">
	by <a href="#">{{ $post->user->name }}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/900x300' }}" alt="">

<hr>

<!-- Post Content -->
<p>{{ $post->body }}</p>

<hr>

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

<!-- Blog Comments -->
@if (Auth::check())
<!-- Comments Form -->
<div class="well">
	<h4>Leave a Comment:</h4>
	{!! Form::open(['method'=>'post','action'=>'PostCommentsController@store']) !!}

	<input type="hidden" name="post_id" value="{{ $post->id }}">
	{{ csrf_field() }}

	<div class="form-group">
		{!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
		
	</div>
	{!! Form::close() !!}
</div>
@endif

<hr>

<!-- Posted Comments -->
@if (count($comments) > 0)

@foreach ($comments as $comment)
<!-- Comment -->
<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" src="{{ $comment->photo }}" height="64" alt="">
	</a>
	<div class="media-body">
		<h4 class="media-heading">{{ $comment->author }}
			<small>{{ $comment->created_at->diffForHumans() }}</small>
		</h4>
		{{ $comment->body }}
	</div>

	@if (count($comment->replies) > 0 )

		@foreach ($comment->replies as $comment_reply)
	
			@if ($comment_reply->is_active == 1)
			
				<div class="media" >
					<a class="pull-left" href="#" style="margin-bottom:10px">
						<img class="media-object" height="64" src="{{ $comment_reply->photo }}" alt="">
					</a>
					<div class="media-body">
						<h4 class="media-heading">{{ $comment_reply->author }}
							<small>{{ $comment_reply->created_at->diffForHumans() }}</small>
						</h4>
						{{ $comment_reply->body }}
					</div>
				</div>

			@endif

			@endforeach

			

		<div class="comment-reply-container">

			<button class="toggle-reply btn btn-primary pull-right">Reply</button>

			<div class="comment-reply col-sm-6">
			
			{!! Form::open(['method'=>'post','action'=>'CommentRepliesController@createReply']) !!}

			<input type="hidden" name="comment_id" value="{{ $comment->id }}">
			{{ csrf_field() }}

			<div class="form-group">
				{!! Form::textarea('body',null,['class'=>'form-control','rows'=>1]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}				
			</div>

			{!! Form::close() !!}

			</div>

		</div>

		@endif


		

	

	

</div>

@endforeach

@endif

@stop

@section('scripts')

<script type="text/javascript">
	
	$(".comment-reply-container .toggle-reply").click(function()
	{
		$(this).next().slideToggle("slow");
	});

</script>

@stop