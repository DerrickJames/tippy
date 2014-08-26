@section('title', 'Create New Tip')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
              <h1>Create New Tip</h1>
            </div>

           	<div class="">
                @if($errors->all())
                    <div class="bs-callout bs-callout-danger">
                        <h4>Please fix the errors below:</h4>
                        {{ HTML::ul($errors->all())}}
                    </div>
                @endif
                {{ Form::open(['route' => 'tips.store', 'class'=>'form-horizontal'])}}
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Title</label>
                    <div class="col-lg-10">
                        {{ Form::text('title',null,array('class'=>'form-control'))}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                        {{ Form::textarea('description',null,array('class'=>'form-control','rows'=>'4'))}}
                    </div>
                </div>

	            <div class="form-group">
	              <label for="avatar" class="col-lg-4 control-label">Display Image</label>
	              <div class="col-lg-8">
	                <input type="hidden" id="avatar-hidden" name="avatar" value="">
	                <div id="upload-avatar" class="upload-avatar">
	                  <div class="userpic" style="background-image: '';">
	                     <div class="js-preview userpic__preview"></div>
	                  </div>
	                  <div class="btn btn-sm btn-primary js-fileapi-wrapper">
	                     <div class="js-browse">
	                        <span class="btn-txt">Choose</span>
	                        <input type="file" name="filedata">
	                     </div>
	                     <div class="js-upload" style="display: none;">
	                        <div class="progress progress-success"><div class="js-progress bar"></div></div>
	                        <span class="btn-txt">Uploading</span>
	                     </div>
	                  </div>
	                </div>
	              </div>
	            </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                    {{ Form::submit('Create',array('class'=>'btn btn-lg btn-primary btn-block')); }}
                    </div>
                </div>
                {{ Form::close()}}
           </div>
		            
        </div>
    </div>
</div>
@stop