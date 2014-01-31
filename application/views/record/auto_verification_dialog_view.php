
<!-- Modal -->
<div class="container" id="add_modal_div">
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Notice</h4>
        </div>
        <div class="modal-body">
           
		  <?php
                  echo '<h2> These ic are already in the system.</h2><br/>';
                  echo 'Do you want to update? If yes click ok<br/>';
                  //print_r($ic_no);
                  for($i = 0 ; $i < sizeof($ic_no); $i++)
                  echo $ic_no[$i].'<br>';
                  
                  $link_for_ok_btn = 'record/do_upload_xlsx_final/'.$fileName;
		  ?>
        </div>
        <div class="modal-footer">
          <a href="<?php echo site_url('record/view_bulk_import/') ?>" class="btn btn-default" data-dismiss="modal">Close</a>
          <a href="<?php echo site_url($link_for_ok_btn) ?>" class="btn btn-primary">OK</a>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
  <br/><br/><br/><br/><br/><br/><br/>
  </div>
