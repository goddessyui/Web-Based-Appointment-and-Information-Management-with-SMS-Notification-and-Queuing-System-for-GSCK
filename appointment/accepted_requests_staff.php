<?php
    include_once("../dbconfig.php");
    // Staff Session
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
        <h3>List of Appointments</h3>
        
        <?php
        //if (isset($_SESSION['staff_username'])) {
         
            $requests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment ON tbl_appointment_detail.appointment_id =
            tbl_appointment.appointment_id INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
            WHERE tbl_appointment_detail.status = 'accepted' AND tbl_staff_registry.staff_id = '.$staff_id.'";
            //AND tbl_appointment.staff_id = '$staff_id'
            $request_result = mysqli_query($db, $requests);
            
            //check whether the query is executed or not
            if($request_result==TRUE) 
            { // count rows to check whether we have data in database or not
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
                            <p><span>Appointment Date: </span><?php echo $rows['date_accepted']; ?></p> 
                            <p><span>Date Accepted: </span><?php echo $rows['date_accepted']; ?></p> 
                            <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p> 
				            <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                            <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                            <p><span>Student's Note:</span><pre><?php echo $rows['note']; ?></pre></p> 
			            </div>
                        <div>
				            <?php
					            date_default_timezone_set('Asia/Manila');                           		
					            $currentdate = date("Y-m-d");
				            ?>
				            <span>
				            <form action="reschedule.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                <input type="date" name="appointment_date" placeholder="" value="<?php echo $rows["appointment_date"]; ?>" 
                                    min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', strtotime($rows["appointment_date"]. ' + 20 days'));?>">
                                <br>
                                <br>
                                <input id="reschedule" type="submit" name="reschedule" value="RESCHEDULE">
	      		            </form>
	      		            </span>
                            <form action ="cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">
                                <label>Comment:</label><br>
					            <textarea type="textarea" name="comment"></textarea><br>
                                <input id="cancel" type="submit" name="cancel" value="CANCEL"><br>
                            </form>
                            <button type="submit" id="done"><a href="done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">DONE</a> </button>
		                </div>
        <?php 
                    }
                }
            }
        //}    
	    ?>
    </div>
</main>