<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
<div class="login-box" style="background: white;">
  	<div class="login-logo">
  		<p id="date"></p>
      <p id="time" class="bold"></p>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Select Employee</h4>

    	<form id="attendance">
          <div class="form-group">
             <select class="form-control" name="status">
             <?php
                    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN schedules ON schedules.id=employees.schedule_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
           
              <option value="<?php echo $row['empid']; ?>"><?php echo $row['firstname'].' '.$row['lastname']; ?></option>
             
             <?php 
           }
             ?>

            </select>
          </div>
      		<div class="form-group has-feedback">
        		 <select class="form-control" name="daystatus">
              <option value="Present">Present</option>
              <option value="Absent">Absent</option>

             </select>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Save</button>
        		</div>
      		</div>
    	</form>
  	</div>
		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  		
</div>
 <?php include 'includes/footer.php'; ?>
  <?php include 'includes/employee_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
	
<?php include '../scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
   
    $.ajax({
      type: 'POST',
      url: 'attendance_control.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        
        if(response.error){

          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
 
  });
    
});
</script>
</body>
</html>