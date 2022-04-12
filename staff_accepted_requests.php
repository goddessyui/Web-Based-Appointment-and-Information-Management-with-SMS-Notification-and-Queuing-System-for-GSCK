

<!-------------------------Sort Requests By Date------------------------------> 
        <?php 
            date_default_timezone_set('Asia/Manila');                           		
		    $currentdate = date("Y-m-d");
        ?>
        <form action="#" method="post" onSubmit="return savesortdate()">
            <input type="date" name="sortbydate" id="sort_date" value="<?php echo $currentdate;?>" 
            min="<?php echo date('Y-m-d', strtotime($currentdate. ' - 90 days'));?>" max="<?php echo date('Y-m-d', strtotime($currentdate. ' + 90 days'));?>">
            <input type="submit" name="searchbydate" id="searchbydate" value="SORT BY DATE">
            <input type="submit" onclick="deletestorage()" name="show_all" id="show_all" value="SHOW ALL">
            
	    </form>
        
        <hr>
        
<!-------------------------Sort Requests By Date ------------------------------> 
<script>
    document.getElementById("sort_date").value = localStorage.getItem("sortingdate");

    function savesortdate() {
        
        var sortingdate = document.getElementById("sort_date").value;
        if (sortingdate == "") {
            alert("Please enter a date in first!");
            return false;
        }
        localStorage.setItem("sortingdate", sortingdate);
        return true;   
    }
    function deletestorage(){
        window.localStorage.clear();
        var sortingdate = document.getElementById("sort_date").value = 
            new Date().toJSON().slice(0,10);//change to sortdata to current date
    }

</script>

<!-------------------------Show Accepted Requests ------------------------------>   
        <?php
            //-------------------------Show Accepted Requests After Pressing Sort By Date------------------------------> 
            if(isset($_POST['searchbydate'])) {
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
                    AND tbl_appointment_detail.appointment_date= '$sortdate' 
                    ORDER BY tbl_appointment_detail.appointment_id ASC";
                
                $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
                
                //check whether the query is executed or not
                if($acceptedrequest_result==TRUE){ // count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($acceptedrequest_result);  //function to get all the rows in database
                    //check the num of rows                 
                    if($count>0){  //we have data in database
                        $i = 1;
                        while($rows=mysqli_fetch_assoc($acceptedrequest_result)){//using while loop to get all the date from database
                            //and while loop will run as long as we have data in database
                            date_default_timezone_set('Asia/Manila');                           		
                            $currentdate = date("Y-m-d");
                ?>  
                            <div>
                                <p><?php echo $i++; ?></p>
                                <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                                <p><span>Appointment Date: </span><?php 
                                    $appointment_date = $rows['appointment_date'];
                                    
                                    if($appointment_date<=$currentdate){
                                        echo "<font color='red';>" . $appointment_date . "</font>";
                                    }
                                    else {
                                        echo $rows['appointment_date'];


                                    }
                                ?></p> 
                                <p><span>Date Accepted: </span><?php echo $rows['date_accepted']; ?></p> 
                                <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p> 
                                <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                                <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                                <p><span>Student's Note:</span><pre><?php echo $rows['note']; ?></pre></p> 
                            </div>
                            <div>
                               
                                <span>
                                <!-------------------------To reschedule appointment. Send Form Data to reschedule.php --------------------------->       
                                <form action="appointment/reschedule.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                    <input type="date" name="appointment_date" 
                                        value="<?php echo $rows["appointment_date"]; ?>" 
                                        min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                        strtotime($rows["appointment_date"]. ' + 90 days'));?>">
                                        <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                        <input type="hidden" name="comment" value="<?php echo $rows['comment'];?>">
                                        <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                        <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>"> 
                                        <?php echo $rows['student_id']; ?>
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
                                    <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                    <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                    <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                    <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
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
                        echo "No Appointments Scheduled for ". $sortdate;
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
                            <p><span>Appointment Date: </span>
                                <?php 
                                    $appointment_date = $rows['appointment_date'];
                                    
                                    if($appointment_date>=$currentdate) {
                                        echo $rows['appointment_date'];
                                    }
                                    else {
                                        echo "<font color='red';>" . $appointment_date . ": MISSED APPOINTMENT" . "</font>";
                                    }
                                ?></p> 
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
                                <input type="date" name="appointment_date" value="<?php echo $rows["appointment_date"]; ?>" 
                                    min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                    strtotime($rows["appointment_date"]. ' + 90 days'));?>">
                                <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                <input type="hidden" name="comment" value="<?php echo $rows['comment'];?>">
                                <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
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
                                <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
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
                    echo "No Appointments Scheduled.";
                }
            }
        } 
            //-------------------------Show All Accepted Requests WITHOUT Sorting By Date------------------------------> 
	    if(isset($_POST['show_all'])) {
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
                            <p><span>Appointment Date: </span>
                                <?php 
                                    $appointment_date = $rows['appointment_date'];
                                    
                                    if($appointment_date>=$currentdate) {
                                        echo $rows['appointment_date'];
                                    }
                                    else {
                                        echo "<font color='red';>" . $appointment_date . ": MISSED APPOINTMENT" . "</font>";
                                    }
                                ?></p> 
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
                                <input type="date" name="appointment_date" value="<?php echo $rows["appointment_date"]; ?>" 
                                    min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                    strtotime($rows["appointment_date"]. ' + 90 days'));?>">
                                <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                <input type="hidden" name="comment" value="<?php echo $rows['comment'];?>">
                                <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
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
                                <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
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
                    echo "No Appointments Scheduled.";
                }
            }
        }
        
        ?>
         

<!-------------------------Show Accepted Requests ------------------------------>     

<?php

    if(isset($_POST['show_all'])){
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
                            <input type="date" name="appointment_date" value="<?php echo $rows["appointment_date"]; ?>" 
                                min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                strtotime($rows["appointment_date"]. ' + 90 days'));?>">
                            <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                            <input type="hidden" name="comment" value="<?php echo $rows['comment'];?>">
                            <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
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
                            <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                            <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
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
                echo "No Appointments Scheduled.";
            }
        }


    }

?>
