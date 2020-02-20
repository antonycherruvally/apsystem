<?php
 include 'includes/session.php'; 
$s_month = $_POST['dates'];?>

<div class="box-body tableresult">

              <table id="example1" class="table table-bordered ">
                <thead>
                  <th class="hidden"></th>
                  <!-- <th>Date</th> -->
                 <!--  <th>Employee ID</th> -->
                  <th>Name</th>
                  <th>Overtime Total/hr</th>
                  <th>No of Presents</th>
                  <th>No of Absents</th>
                  <!-- <th>Time Out</th> -->
                  
                </thead>
                <tbody>
<?php $sql = "select id,firstname,lastname from employees";
 $query = $conn->query($sql);
                   //  $absent=mysqli_num_rows($row['status'] = "Absent");
                    while($row = $query->fetch_assoc()){
                    	$name = $row['firstname'].$row['lastname'];
                    	$id = $row['id'];
                    	
                    	$sql1 = "SELECT *,
                                  COUNT(CASE WHEN `status` LIKE '%Present%' THEN 1 END) AS count1,
                                  COUNT(CASE WHEN `status` LIKE '%Absent%' THEN 1 END) AS count2
                                 from attendance att JOIN (SELECT *, sum(hours) as total from overtime) ov where att.employee_id = $id and att.date like '%$s_month%'";
                                

                        $query1 = $conn->query($sql1);
                       

                        while($row = $query1->fetch_assoc()){
                        	
                        	
                      echo "
                        <tr>
                          <td class='hidden'></td>
                           
                          
                          <td>".$name."</td>
                          <td>".$row['total']."</td>
                          <td>".$row['count1']."</td>
                          <td>".$row['count2']."</td>
                          
                        </tr>
                      ";
                        }


                    }

?>