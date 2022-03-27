
    <div>
 <!-------------------------Show Done Appointments ------------------------------------------------------------------------------------------------>        
        <?php

            $donerequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                WHERE tbl_appointment_detail.status = 'done' AND tbl_appointment.staff_id = '$staff_id' 
                ORDER BY tbl_appointment_detail.appointment_date DESC";
          
            $donerequest_result = mysqli_query($db, $donerequest);
            
            //check whether the query is executed or not
            if($donerequest_result==TRUE) 
            { // count rows to check whether we have data in database or not
                $count = mysqli_num_rows($donerequest_result);
                //check the num of rows                 
                if($count>0) //we have data in database
                {
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($donerequest_result)) 
                    //using while loop to get all the date from database
			        //and while loop will run as long as we have data in database
                    {
        ?>
                        <div>
                            <td>
                                <?php   echo $i;//display numbers on the side
		                  	            $i++; 
                                ?>
                            </td>
                            <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                            <p><span>Appointment Date: </span><?php echo $rows['appointment_date']; ?></p>
                            <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p>
                            <p><span>Date Accepted: </span><?php echo $rows['date_accepted']; ?></p>
				            <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                            <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                            <p><span>Stuudent's Note: </span><pre><?php echo $rows['note']; ?></pre></p> 
                            <p><span>My Comment: </span><pre><?php echo $rows['comment']; ?></pre></p> 
			            </div>
        <?php 
                    }
                }
                else{
                    echo "No Past Appointments.";
                }
            }   
	    ?>
 <!-------------------------Show Done Appointments ----------------------------------------------------------------------------------------->          
    </div>
