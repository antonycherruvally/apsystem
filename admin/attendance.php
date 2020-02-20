<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <!-- <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat btnnew"><i class="fa fa-plus"></i> New</a>
            </div> -->
           
            <div class="box-header with-border">
                  <label for="datepicker_add" class="col-sm-3 control-label">Select Month</label>
              <div class="col-sm-6"> 
                  <div class="date">
                      <input type="text" class="form-control  input-sm box-header with-border" id="datepicker_yearadd" name="date" required>
                  </div>
                </div>
             <button type="submit" class="btn btn-primary btn-flat" name="add" id="monthselect"><i class="fa fa-save"></i> Select</button>
              <button type="button" class="btn btn-success btn-sm btn-flat pdfbtn" id="payroll" style="display: none;float: right;
                margin-right: 24px;"><span class="glyphicon glyphicon-print"></span> Print</button>
            </div>
            <div class="box-body tableresult">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                 <!--  <th>Employee ID</th> -->
                  <th>Name</th>
                
                  <th>Status</th>
                  
                  <!-- <th>Time Out</th> -->
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC";
                 // $sql = "Select *,employees.id As empid From Employees left join attendance on attendance.employee_id=employees.id"
                    $query = $conn->query($sql);
                   //  $absent=mysqli_num_rows($row['status'] = "Absent");
                    while($row = $query->fetch_assoc()){

                      $status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          
                          
                          <td>".$row['status']."</td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['attid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['attid']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/attendance_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#editattendance').modal('show');
    var id = $(this).data('id');
    //alert(id);
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#deleteattendance').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});
$(function(){
   $('#monthselect').click(function(e){
       var dates= $('#datepicker_yearadd').val();

        $.ajax({
         type: 'POST',
          url: 'attendance_selectmonth.php',
         data: {dates:dates},
         
        success: function(data){
          
          $(".box-body").addClass("dataadd")
          $('.pdfbtn').show();
          $('.btnnew').hide();
           $(".tableresult").html(data);
          $('#example1').show();
         

         }
       });
        $('.pdfbtn').click(function(e){
   window.location = "attendancepdf.php?data="+dates;  
 });
   });

 });


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
