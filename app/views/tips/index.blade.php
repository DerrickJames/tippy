@section('title', 'Tips')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
              <h1>Tips<span class="pull-right"> <a data-toggle="modal" href="{{ URL::route('tips.create') }}" class="btn btn-primary btn-lg">Add new Category</a></span></h1>
            </div>

            <table class="table">
               <thead>
                 <tr>
                 	<th>Display</th>
                   	<th>Title</th>
                   	<th>Description</th>
                   	<th class="col-lg-3 text-right">Actions</th>
                 </tr>
               </thead>
               <tbody id="sortable">
                @foreach($tips as $tip)
                <tr rel="{{ $tip->id }}">
                	<td></td>
                    <td><a href="{{URL::route('tips.edit', $tip->id)}}">{{ $tip->title }}</a></td>
                    <td>{{ $tip->description}}<br>
                    </td>
                    <td>
                        <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-sm" href="{{URL::route('tips.edit', $tip->id)}}">Edit</a>
                        <a class="delete_toggler btn btn-danger btn-sm" href="" rel="{{$tip->id}}">Delete</a>
                        @include('tips.destroy',[])
                        </div>
                    </td>
                 </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script type="text/javascript">

    </script>
@stop