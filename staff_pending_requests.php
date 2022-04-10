
<?php
if($position!="Accounting Staff/Scholarship Coordinator"){
?>
<!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->          
        <?php
            $staff_id = $_SESSION["staff_id"];
        if (isset($_GET['apde'])){
            $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year
                FROM tbl_appointment INNER JOIN tbl_staff_registry 
                ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_id = '".$_GET['apde']."' ORDER BY date_created ASC";
        }
        else{
            $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year
                FROM tbl_appointment INNER JOIN tbl_staff_registry 
                ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                AND tbl_staff_registry.staff_id = '$staff_id' ORDER BY date_created ASC";
        }
             $request_result = mysqli_query($db, $requests);
             //check whether the query is executed or not
            if($request_result==TRUE) 
            {   // count rows to check whether we have data in database or not
                $count = mysqli_num_rows($request_result);  //function to get all the rows in database
                //check the num of rows                 
                if($count>0) //we have data in database
                {
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($request_result)) {
                    //using while loop to get all the date from database
			        //and while loop will run as long as we have data in database
                    
        ?>
                        <div>
                            <td>
                                <?php  
		                  	           echo $i++; //Adds Row Counter
                                ?>
                            </td>
                            <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                            <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p> 
				            <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                            <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                            <p><span>Student's Note: </span><pre><?php echo $rows['note']; ?></pre></p> 
			            </div>
                        <div>
				            <?php
                                //set the time to local time
					            date_default_timezone_set('Asia/Manila');                           		
					            $currentdate = date("Y-m-d");
				            ?>
				            <span>
                            <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
				            <form action="appointment/acceptordecline.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                <label>Enter Date of Appointment:</label>
	      	 		            <input type="date" name="appointment_date" placeholder="" value=" "
	      	 				        min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', 
                                    strtotime($currentdate. ' + 20 days'));?>"><br><br>
                                <label>Comment:</label><br>
                                <textarea name="comment" placeholder="Comment here" value=""></textarea><br><br>
                                <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                <button  type="submit" name="accept">ACCEPT</button>
                                <button type="submit" name="decline">DECLINE</button>
                                
	      	 				<br>
	      		            </form>
                              <hr>
                            <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
	      		            </span>
		                </div>
        <?php 
                    }
                }
                else {
                    echo "No Pending Requests.";
                }
            }
            else {
                echo "The query was not executed.";
            }    
	    ?>
<!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->   
<?php
}

if($position=="Accounting Staff/Scholarship Coordinator") {?>
    
  
        <!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->          
        <?php
            $staff_id = $_SESSION["staff_id"];

            $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year
                FROM tbl_appointment INNER JOIN tbl_staff_registry 
                ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type != 'UniFAST - Claim Cheque' AND tbl_appointment.appointment_type != 'UniFAST - Submit Documents' ORDER BY date_created ASC";

            $request_result = mysqli_query($db, $requests);
            //check whether the query is executed or not
            if($request_result==TRUE) 
            {   // count rows to check whether we have data in database or not
                $count = mysqli_num_rows($request_result);  //function to get all the rows in database
                //check the num of rows                 
                if($count>0) //we have data in database
                {
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($request_result)) {
                    //using while loop to get all the date from database
                    //and while loop will run as long as we have data in database
                    
        ?>
                        <div>
                            <td>
                                <?php  
                                        echo $i++; //Adds Row Counter
                                ?>
                            </td>
                            <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                            <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p> 
                            <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                            <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                            <p><span>Student's Note: </span><pre><?php echo $rows['note']; ?></pre></p> 
                        </div>
                        <div>
                            <?php
                                //set the time to local time
                                date_default_timezone_set('Asia/Manila');                           		
                                $currentdate = date("Y-m-d");
                            ?>
                            <span>
                            <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                            <form action="appointment/acceptordecline.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                <label>Enter Date of Appointment:</label>
                                <input type="date" name="appointment_date" placeholder="" value=" "
                                    min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', 
                                    strtotime($currentdate. ' + 20 days'));?>"><br><br>
                                <label>Comment:</label><br>
                                <textarea name="comment" placeholder="Comment here" value=""></textarea><br><br>
                                <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                <button  type="submit" name="accept">ACCEPT</button>
                                <button type="submit" name="decline">DECLINE</button>
                                
                            <br>
                            </form>
                            <hr>
                            <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                            </span>
                        </div>
        <?php 
                    }
                }
                else {
                    echo "No Pending Requests.";
                }
            }
            else {
                echo "The query was not executed.";
            }    
        ?>
        <!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->   
    
    
    
<?php
}


?>

