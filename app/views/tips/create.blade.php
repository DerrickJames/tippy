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
  var FieldCount  = 1;
  $('body').on('click', '.upload_img', function(e){
    var id = $(this).attr('class');
    console.log(id);
    $('#' + id).fileapi({
      url: '{{ route("tips.store") }}',
      autoUpload: true,
      accept: 'image/*',
      multiple: true,
      maxSize: FileAPI.MB*10
    });
  });

  var MaxInputs      = 3;
  var InputWrapper   = $("#InputWrapper");
  var AddButton      = $("#AddMoreFiles");
  var x              = InputWrapper.length;
  

  $(AddButton).click(function(e) {
    if (x<= MaxInputs) {
      FieldCount++;

      var html = '<div class="form-group">';
          html += '<label for="avatar" class="col-lg-4 control-label">Display Image</label>';
          html += '<div class="col-lg-8"><input type="hidden" id="avatar-hidden" name="avatar" value="">';
          html +=  '<div id="upload_img" class="upload_img">';
          html +=  '<div class="userpic" style="">';
          html +=  '<div class="js-preview userpic__preview"></div>';
          html +=  '</div><div class="btn btn-sm btn-primary js-fileapi-wrapper"><div class="js-browse">';
          html +=  '<span class="btn-txt">Choose</span><input type="file" name="filedata">';
          html +=   '</div><div class="js-upload" style="display: none;">';
          html +=   '<div class="progress progress-success"><div class="js-progress bar"></div></div>';
          html +=   '<span class="btn-txt">Uploading</span></div></div></div></div><a href="#" class="removeclass">&times;</a></div>';

      $(InputWrapper).append(html);
      x++;
    } else {
      alert("Maximum");
    }

    return false;
  });

  $('body').on('click', '.removeclass', function(e) {
    if(x > 1) {
      $(this).parent('div').remove();
      x--;
    }

    return false;
  });

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

                <a href="#" id="AddMoreFiles" class="btn btn-primary">Add More Buttons</a>

                <div id="InputWrapper"></div>

  	            <div class="form-group">
  	              <label for="avatar" class="col-lg-4 control-label">Choose Display Image</label>
  	              <div class="col-lg-8">
  	                <input type="hidden" id="avatar-hidden" name="avatar" value="">
  	                <div id="upload_img" class="upload_img">
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

                {{ Form::close()}}
           </div>
		            
        </div>
    </div>
</div>
@stop