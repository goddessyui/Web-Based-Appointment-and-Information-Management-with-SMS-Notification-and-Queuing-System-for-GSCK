

        <h3>My Appointments</h3>
        <a href="staff_appointment_details.php">Back to Appointments</a>
        <hr>
<!-------------------------Sort Requests By Date------------------------------> 
        <?php 
            date_default_timezone_set('Asia/Manila');                           		
		    $currentdate = date("Y-m-d");
        ?>
        <form action="" method="post">
            <input type="date" name="sortbydate" placeholder="" value="<?php echo $currentdate;?>" 
            min="<?php echo $currentdate, - '30 days' ?>" max="<?php echo date('Y-m-d', strtotime($currentdate. ' + 90 days'));?>">
            <input type="submit" name="searchbydate" value="SORT BY DATE">
	    </form>
        <hr>
<!-------------------------Sort Requests By Date ------------------------------> 

<!-------------------------Show Accepted Requests ------------------------------>   
        <?php
            //-------------------------Show Accepted Requests After Pressing Sort By Date------------------------------> 
            if(isset($_POST['searchbydate'])){
                $sortdate = $_POST['sortbydate'];
                ?>
                <b><font color="blue">
                <?php echo "Appointments for ". $sortdate; ?>
                </font></b>
                <hr>
                <?php
               
               $acceptedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id' 
                AND tbl_appointment_detail.appointment_date= '$sortdate' ORDER BY tbl_appointment_detail.appointment_id ASC";
        
                $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
                
                //check whether the query is executed or not
                if($acceptedrequest_result==TRUE){ // count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($acceptedrequest_result);  //function to get all the rows in database
                    //check the num of rows                 
                    if($count>0){  //we have data in database
                        $i = 1;
                        while($rows=mysqli_fetch_assoc($acceptedrequest_result)){//using while loop to get all the date from database
                            //and while loop will run as long as we have data in database
                ?>
                            <div>
                                <p><?php echo $i++; ?></p>
                                <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                                <p><span>Appointment Date: </span><?php echo $rows['appointment_date']; ?></p> 
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
                                <!-------------------------To reschedule appointment. Send Form Data to reschedule.php --------------------------->       
                                <form action="appointment/reschedule.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                    <input type="date" name="appointment_date" placeholder="" 
                                        value="<?php echo $rows["appointment_date"]; ?>" 
                                        min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', 
                                        strtotime($rows["appointment_date"]. ' + 20 days'));?>">
                                        <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                        <input type="hidden" name="comment" value="<?php echo $rows['comment'];?>"> 
                                    <br>
                                    <br>
                                    <input id="reschedule" type="submit" name="reschedule" value="RESCHEDULE APPOINTMENT">
                                </form>
                                <!-------------------------Send Form Data to reschedule.php ------------------------------>    
                                </span>
                                <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php ---------------------->  
                                <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">
                                    <label>Comment:</label><br>
                                    <textarea type="textarea" name="comment"></textarea><br><br>
                                    <input id="cancel" type="submit" name="cancel" value="CANCEL APPOINTMENT"><br>
                                </form>
                                <!-------------------------Send Form Data to cancel.php ------------------------------>
                                <!-------------------------Send data to done.php ------------------------------>  
                                <button type="submit" id="done"><a href="appointment/done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
                                APPOINTMENT DONE</a> </button>
                                <!-------------------------Send data to done.php ------------------------------> 
                            </div>
            <?php 
                        }
                    }
                    else {
                        echo "No appointments scheduled for ". $sortdate;
                    }
                }
            }
            //-------------------------Show Accepted Requests After Pressing Sort By Date------------------------------>  
        
            //-------------------------Show All Accepted Requests WITHOUT Sorting By Date------------------------------>  
        
                else {
                ?>
                <h4><font color="blue">All Appointments</font></h4>
                <hr>
                <?php

                $acceptedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id' 
                ORDER BY tbl_appointment_detail.appointment_date ASC";
        
                $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
                
                //check whether the query is executed or not
                if($acceptedrequest_result==TRUE) 
                { // count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($acceptedrequest_result);  //function to get all the rows in database
                    //check the num of rows                 
                    if($count>0) //we have data in database
                    {
                        $i = 1;
                        while($rows=mysqli_fetch_assoc($acceptedrequest_result)) 
                        //using while loop to get all the date from database
                        //and while loop will run as long as we have data in database
                        {
            ?>
                            <div>
                                <p><?php echo $i++; ?></p>
                                <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                                <p><span>Appointment Date: </span><?php echo $rows['appointment_date']; ?></p> 
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
                                <!-------------------------To reschedule appointment. Send Form Data to reschedule.php -------------------------->       
                                <form action="appointment/reschedule.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                    <input type="date" name="appointment_date" placeholder="" value="<?php echo $rows["appointment_date"]; ?>" 
                                        min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', 
                                        strtotime($rows["appointment_date"]. ' + 20 days'));?>">
                                    <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                    <input type="hidden" name="comment" value="<?php echo $rows['comment'];?>">
                                    <br>
                                    <br>
                                    <input id="reschedule" type="submit" name="reschedule" value="RESCHEDULE APPOINTMENT">
                                </form>
                                <!-------------------------Send Form Data to reschedule.php ------------------------------>    
                                </span>
                                <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php --------------------->  
                                <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">
                                    <label>Comment:</label><br>
                                    <textarea type="textarea" name="comment"></textarea><br><br>
                                    <input id="cancel" type="submit" name="cancel" value="CANCEL APPOINTMENT"><br>
                                </form>
                                <!-------------------------Send Form Data to cancel.php ------------------------------>
                                <!-------------------------Send data to done.php ------------------------------>  
                                <button type="submit" id="done"><a href="appointment/done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
                                APPOINTMENT DONE</a> </button>
                                <!-------------------------Send data to done.php ------------------------------> 
                            </div>
            <?php 
                        }
                    }
                    else {
                        echo "No appointments scheduled";
                    }
                }
            } 
            //-------------------------Show All Accepted Requests WITHOUT Sorting By Date------------------------------> 
	    ?>
         
<!-------------------------Show Accepted Requests ------------------------------>            
