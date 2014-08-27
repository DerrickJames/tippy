@extends('site.layouts.default')

{{-- Content --}}
@section('content')
@if (Auth::check())
    <a href="{{ URL::to('/create') }}" id="" class="btn btn-default pull-right">Add Tip</a>
@endif
@if(isset($tips))

@foreach ($tips as $tip)
<div class="row">
    <div class="col-md-8">
        <!-- Post Title -->
        <div class="row">
            <div class="col-md-8">
                <h4><strong><a href=""><?php echo $tip->title; ?></a></strong></h4>

            </div>
        </div>
        <!-- ./ post title -->

        <!-- Post Content -->
        <div class="row">
            <div class="col-md-2">

                <a href="" class="thumbnail"><img src="{{asset('assets/uploads/'.$tip->display_img) }}" alt=""></a>
            </div>
            <div class="col-md-6">
                <p>
                    {{ String::tidy(Str::limit($tip->description, 200)) }}
                </p>
                <!-- <p><a class="btn btn-mini btn-default" href="">Read more</a></p> -->
            </div>
        </div>
        <!-- ./ post content -->

        <!-- Post Footer -->
        <div class="row">
            <div class="col-md-8">
                <p></p>
                <p>
                    <span class="glyphicon glyphicon-user"></span> by <span class="muted">{{ $tip->username }}</span>
                    | <span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $tip->created_at }}}
                    | <span class="glyphicon glyphicon-comment"></span> <a href="{{ url('tips', $tip->id ) }}">Comment</a>
            </div>
        </div>
        <!-- ./ post footer -->
    </div>
</div>

<hr />
@endforeach
@endif

@stop
