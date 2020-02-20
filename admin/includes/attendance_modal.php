

<!-- Edit -->
<div class="modal fade" id="editattendance">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_edit.php">
            		<input type="hidden" id="attid" name="id">
                <div class="form-group">
                    <label for="datepicker_edit1" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit1" name="edit_date">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_in" class="col-sm-3 control-label">Status</label>

                  	<div class="col-sm-9">
                  		<select class="form-control" name="daystatus">
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>

                      </select>
                  	</div>
                </div>
                
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="deleteattendance">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="attendance_date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_delete.php">
            		<input type="hidden" id="del_attid" name="id">
            		<div class="text-center">
	                	<p>DELETE ATTENDANCE</p>
	                	<h2 id="del_employee_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

     