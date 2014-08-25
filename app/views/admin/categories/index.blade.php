@section('title', 'Categories')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
              <h1>Tippy Categories<span class="pull-right"> <a data-toggle="modal" href="#add_category" class="btn btn-primary btn-lg">Add new Category</a></span></h1>
            </div>

            <table class="table">
               <thead>
                 <tr>
                   <th>Title</th>
                   <th>Description</th>
                   <th># of Tips</th>
                   <th class="col-lg-3 text-right">Actions</th>
                 </tr>
               </thead>
               <tbody id="sortable">
                @foreach($categories as $category)
                <tr rel="{{ $category->id }}">
                    <td><a href="{{url('admin/categories/view/'.$category->id)}}">{{ $category->name }}</a></td>
                    <td>{{ $category->description}}<br>
                    </td>
                    <td></td>
                    <td>
                        <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/categories/view/'.$category->id)}}">Edit</a>
                        <a class="delete_toggler btn btn-danger btn-sm" rel="{{$category->id}}">Delete</a>
                        </div>
                    </td>
                 </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- Modal -->
     <div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Adding new category</h4>
           </div>
           <div class="modal-body">
                @if($errors->all())
                    <div class="bs-callout bs-callout-danger">
                        <h4>Please fix the errors below:</h4>
                        {{ HTML::ul($errors->all())}}
                    </div>
                @endif
                {{ Form::open(['route' => 'admin.categories.store', 'class'=>'form-horizontal'])}}
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-10">
                        {{ Form::text('name',null,array('class'=>'form-control'))}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                        {{ Form::textarea('description',null,array('class'=>'form-control','rows'=>'4'))}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                    {{ Form::submit('Create',array('class'=>'btn btn-lg btn-primary btn-block')); }}
                    </div>
                </div>
                {{ Form::close()}}
           </div>
         </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            @if($errors->all())
                $('#add_category').modal('show');
            @endif
        });
    </script>
@stop