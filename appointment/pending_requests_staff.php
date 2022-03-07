<?php
    include_once("../dbconfig.php"); 
    session_start();
    $staff_id = $_SESSION["staff_id"];
    $position = $_SESSION["position"];
    $username = $_SESSION["staff_username"];
    if ($staff_id == "" && $username == "" && $position != "Accounting Staff/Scholarship Coordinator" && "Registrar" && "Teacher"){
        echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
    }
?>

<main>
    <div>
        <h3>Pending Requests</h3>
<!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->          
        <?php
            $staff_id = $_SESSION["staff_id"];

            $requests="SELECT * FROM tbl_appointment 
            INNER JOIN tbl_staff_registry 
            ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
            WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
            WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
            AND `status` ='pending' AND tbl_staff_registry.staff_id = '$staff_id' ORDER BY appointment_id";

             $request_result = mysqli_query($db, $requests);
             //check whether the query is executed or not
            if($request_result==TRUE) 
            {   // count rows to check whether we have data in database or not
                $count = mysqli_num_rows($request_result);  //function to get all the rows in database
                //check the num of rows                 
                if($count>0) //we have data in database
                {
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($request_result)) 
                    //using while loop to get all the date from database
			        //and while loop will run as long as we have data in database
                    {
        ?>
                        <div>
                            <td>
                                <?php   echo $i;
		                  	            $i++; 
                                ?>
                            </td>
                            <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                            <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p> 
				            <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                            <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                            <p><span>Student's Note: </span><?php echo $rows['note']; ?></p> 
			            </div>
                        <div>
				            <?php
                                //set the time to local time
					            date_default_timezone_set('Asia/Manila');                           		
					            $currentdate = date("Y-m-d");
				            ?>
				            <span>
                            <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
				            <form action="acceptordecline.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                <label>Enter Date of Appointment:</label>
	      	 		            <input type="date" name="appointment_date" required placeholder="" value=""
	      	 				    min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', strtotime($currentdate. ' + 20 days'));?>"><br>
                                <label>Comment:</label>
                                <textarea name="comment" placeholder="Comment here" value=""></textarea></textarea><br>
                                <button  type="submit" name="accept" onclick="reminder()">ACCEPT</button>
                                <button type="submit" name="decline">DECLINE</button>
	      	 				<br>
	      		            </form>
                            <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
	      		            </span>
		                </div>
        <?php 
                    }
                }
            }    
	    ?>
<!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->            
    </div>
</main>

<script>

function reminder() {
  alert("Don't forget to set the Appointment Date!");
}

</script>