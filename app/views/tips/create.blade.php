@section('title', 'Create New Tip')

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.Jcrop.min.css') }}">
@stop

@section('scripts')
<script type="text/javascript">
  var FileAPI = {
          debug: true
          , staticPath: "{{ URL::asset('assets/js/vendor/uploader') }}/"
          , postNameConcat: function (name, idx){
        return  name + (idx != null ? '['+ idx +']' : '');
      }
  };
</script>
<script src="{{ asset('assets/js/vendor/uploader/FileAPI.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploader/FileAPI.exif.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploader/jquery.fileapi.js') }}"></script>
<script src="{{ asset('assets/js/vendor/uploader/jquery.Jcrop.min.js') }}"></script>

<script type="text/javascript">
jQuery(function ($){
  $('#cropper-preview').on('click', '.js-upload', function (){
     $('#upload-img').fileapi('upload');
     $('#cropper-preview').fadeOut();
  });
  $('#upload_img').fileapi({
    url: '{{ route("tips.upload") }}',
    autoUpload: true,
    accept: 'image/*',
    maxSize: FileAPI.MB*10
  });
  // $('#upload-img').fileapi({
  //    url: '{{ route("tips.upload") }}',
  //    accept: 'image/*',
  //    data: { _token: "{{ csrf_token() }}" },
  //    imageSize: { minWidth: 100, minHeight: 100 },
  //    elements: {
  //       active: { show: '.js-upload', hide: '.js-browse' },
  //       preview: {
  //          el: '.js-preview',
  //          width: 96,
  //          height: 96
  //       },
  //       progress: '.js-progress'
  //    },

  //    onSelect: function (evt, ui){
  //       var file = ui.all[0];
  //       if( file ){
  //         $('#cropper-preview').show();

  //         $('.js-img').cropper({
  //            file: file,
  //            bgColor: '#fff',
  //            maxSize: [$('#cropper-preview').width()-40, $(window).height()-100],
  //            minSize: [100, 100],
  //            selection: '90%',
  //            aspectRatio: 1,
  //            onSelect: function (coords){
  //               $('#upload-img').fileapi('crop', file, coords);
  //            }
  //         });
  //       }
  //    },

  //   onComplete: function(evt, xhr)
  //    {
  //     try {
  //       var result = FileAPI.parseJSON(xhr.xhr.responseText);
  //       $('#avatar-hidden').attr("value",result.images.filename);

  //       alert(result.images.filename);
  //     } catch (er){
  //       FileAPI.log('PARSE ERROR:', er.message);

  //       alert(er.message);
  //     }
  //    }
  // });
});
</script>
@stop

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
                {{ Form::open(['role' => 'form', 'route' => 'tips.store', 'class'=>'form-horizontal'])}}
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
	                <div id="upload_img" class="upload-img">
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