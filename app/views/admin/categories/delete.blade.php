<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Are you sure?</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to remove this category?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="{{$link}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Remove Category</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- Modal -->
     <div class="modal fade" id="delete_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Are you sure?</h4>
           </div>
           <div class="modal-body">
                <p class="lead text-center">This Category will be deleted!</p>
           </div>
           <div class="modal-footer">
                <a data-dismiss="modal" href="#delete_category" class="btn btn-default">Keep</a>
                <a href="" id="delete_link" class="btn btn-danger">Delete</a>
           </div>
         </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->  