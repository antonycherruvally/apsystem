<?php

include 'includes/session.php';
require_once('../tcpdf/tcpdf.php');  
	$s_month = $_GET['data'];
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payroll:');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage(); 
    $month = date("F",strtotime($s_month));
 $content = '';  
    $content .= '
      	<h2 align="center">TechSoft IT Solutions</h2>
      	<h4 align="center">Attendance sheet '.$month.'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="35%" align="center"><b>Employee Name</b></th>
                <th width="20%" align="center"><b>Presents</b></th>
				<th width="20%" align="center"><b>Absents</b></th> 
				<th width="20%" align="center"><b>Overtime</b></th> 

           </tr>  
      ';  
		
	$sql = "select id,firstname,lastname from employees";
    $query = $conn->query($sql);
        while($row = $query->fetch_assoc()){
             $name = $row['firstname'].$row['lastname'];
              $id = $row['id'];
              $sql1 = "SELECT *,
                                  COUNT(CASE WHEN `status` LIKE '%Present%' THEN 1 END) AS count1,
                                  COUNT(CASE WHEN `status` LIKE '%Absent%' THEN 1 END) AS count2
                                  from attendance where employee_id = $id and date like '%$s_month%'";

              $query1 = $conn->query($sql1);
              while($row = $query1->fetch_assoc()){
             		 $content .= '
			 						<tr>
			 						<td>'.$name.'</td>
			 	
			 						<td align="right">'.$row['count1'].'</td>
			 						<td align="right">'.$row['count2'].'</td>
			 						<td>'.date('h:i A', strtotime($row['time_in'])).'</td>
								 </tr>
							 ';
						}
					}

	
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I');



?>