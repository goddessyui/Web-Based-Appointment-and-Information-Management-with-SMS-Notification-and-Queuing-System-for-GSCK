<?php

$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
if ($staff_id == "" && $username == "" && $position != "Accounting Staff/Scholarship Coordinator" && "Registrar" && "Teacher"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}

?>

    <div>
<!-------------------------Show Declined Requests in Descending Order or From Most Current------------------------------>  
        <?php
    
            $declinedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment ON tbl_appointment_detail.appointment_id =
            tbl_appointment.appointment_id INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
            WHERE tbl_appointment_detail.status = 'Cancelled' AND tbl_appointment.staff_id = '$staff_id' ORDER BY appointment_date DESC";
            $declinedrequest_result = mysqli_query($db, $declinedrequests);
            
            //check whether the query is executed or not
            if($declinedrequest_result==TRUE) 
            { // count rows to check whether we have data in database or not
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($declinedrequest_result)) 
                    //using while loop to get all the date from database
			        //and while loop will run as long as we have data in database
                    {
        ?>
                        <div>
                            <td>
                                <?php   echo $i; //display numbers on the side
		                  	            $i++; 
                                ?>
                            </td>
                            <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                            <p><span>Date Cancelled: </span><?php echo $rows['appointment_date']; ?></p>
                            <p><span>Request Date: </span><?php echo $rows['date_created']; ?></p>
				            <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                            <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                            <p><span>Student's Note: </span><pre><?php echo $rows['note']; ?></pre></p> 
                            <p><span>My Comment: </span><pre><?php echo $rows['comment']; ?></pre></p> 
			            </div>
        <?php 
                    }
                }   
	    ?>
<!-------------------------Show Declined Requests ------------------------------>          
    </div>