@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ String::title($tip['title']) }}} ::
@parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')
@parent

@stop

{{-- Update the Meta Description --}}
@section('meta_description')
@parent

@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')
@parent

@stop

{{-- Content --}}
@section('content')

<!-- Tip -->
<div class="row">
    <div class="col-md-2">

        <a href="" class="thumbnail"><img src="{{asset('assets/uploads/'.$tip['display_img']) }}" alt=""></a>
    </div>
    <div class="col-md-6">
        <p>
            {{ String::tidy(Str::limit($tip['description'], 200)) }}
        </p>
    </div>
</div>

<div>
	<span class="badge badge-info">Posted {{{ $tip['created_at'] }}}</span>
</div>

<hr />

<a id="comments"></a>
<h4>{{{ $comments->count() }}} Comments</h4>

@if ($comments->count())
@foreach ($comments as $comment)
<div class="row">
<!-- 	<div class="col-md-1">
		<img class="thumbnail" src="http://placehold.it/60x60" alt="">
	</div> -->
	<div class="col-md-11">
		<div class="row">
			<div class="col-md-11">
				<span class="glyphicon glyphicon-user"></span> by <span class="muted">{{ $comment->username }}</span>
				 |  <span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $comment->created_at }}}
			</div>

			<div class="col-md-11">
				<hr />
			</div>

			<div class="col-md-11">
				{{{ $comment->content }}}
			</div>
		</div>
	</div>
</div>
<hr />
@endforeach
@else
<hr />
@endif

@if ( ! Auth::check())
You need to be logged in to add comments.<br /><br />
Click <a href="{{{ URL::to('user/login') }}}">here</a> to login into your account.
@else

@if($errors->has())
<div class="alert alert-danger alert-block">
<ul>
@foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<h4>Add a Comment</h4>
<form  method="post" action="{{{ URL::route('comment.store', $tip['id']) }}}">
	<input type="hidden" name="post_id" value="{{{ $tip['id'] }}}" />

	<textarea class="col-md-12 input-block-level" rows="4" name="comment" id="comment">{{{ Request::old('comment') }}}</textarea>

	<div class="form-group">
		<div class="col-md-12">
			<input type="submit" class="btn btn-default" id="submit" value="Submit" />
		</div>
	</div>
</form>
@endif
@stop
