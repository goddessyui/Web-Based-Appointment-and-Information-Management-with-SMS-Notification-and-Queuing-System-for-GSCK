<?php
include("admin_header.php");
?>
<main>
    <div class="row">
        <?php
                include("count_app.php");
        ?>
    </div>
  

    <div class="row">
        <h2>Pending Appointments</h2> 
    </div>

    <div class="row">
            <!--success or error-->
            <?php 
                    if(isset($_GET['success'])){
                ?>
                        <p align="center">
                            <?php 
                                echo $_GET['success'];
                            ?>
                        </p>
                <?php
                    }
                    if(isset($_GET['error'])){
                ?>
                                <p align="center">
                                    <?php 
                                        echo $_GET['error'];
                                    ?>
                                </p>
                        <?php
                            }
                    else{
                    }
                ?>
                <!--success or error-->
    </div>
    
        <div class="row_app">
            <div class="col_app" id="serialno_pend"></div>
            <div class="col_app" id="datecreated">Request Date</div>
            <div class="col_app" id="apptype_pend">Appt.Type</div>
            <div class="col_app" id="studentname_pend">Student</div> 
            <div class="col_app" id="courseandyear">Course & Year</div>
            <div class="col_app" id="studnote_pend">Student's Note</div>

            <div class="col_app" id="setdate">Set Appt. Date</div> 
            <div class="col_app" id="comment_pend">Comment</div>
            <div class="col_app" id="acceptdecline"></div>
        </div>
    
                    


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
                tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_student_registry.mobile_number
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
                tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_student_registry.mobile_number
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
                        <div class="row_app">
                            <div class="col_app" id="serialno_pend">
                                <?php  echo $i++; ?>
                            </div>
                            <div class="col_app" id="datecreated">
                                <?php echo $rows['date_created']; ?>
                            </div>
                            <div class="col_app" id="apptype_pend">
                                <?php echo $rows['appointment_type']; ?>
                            </div>
                            <div class="col_app" id="studentname_pend">
                                <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                            </div>
                            <div class="col_app" id="courseandyear">
                                <?php echo $rows['course']." ".$rows['year']; ?>
                            </div>
                            <div class="col_app" id="studnote_pend">
                                <?php
                                         if($rows['note']==""){
                                            echo "No note.";
                                        }
                                        else{
                                            echo $rows['note'];
                                        }
                                        ?>
                            </div>
                            <div class="col_app" id="setdate">
                                <?php
                                    //set the time to local time
                                    date_default_timezone_set('Asia/Manila');                           		
                                    $currentdate = date("Y-m-d");
                                ?>
                                
                                <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                                <form action="appointment/acceptordecline.php" method="post">
                               
                                    <input type="date" name="appointment_date" id="appointmentdate" value=" "
                                        min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                        strtotime($currentdate. ' + 90 days'));?>">
                            </div>
                            <div class="col_app" id="comment_pend">
                                    <textarea name="comment" placeholder="Comment here" value=""></textarea>
                            </div>
                            <div class="col_app" id="acceptdecline">
                                    <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                    <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                    <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                    <input type="hidden" name="student_fullname" value="<?php echo $rows['first_name'].' '.$rows['last_name']; ?>">
                                    <input type="hidden" name="number" value="<?php echo $rows['mobile_number']; ?>">
                                    <button  type="submit" name="accept" id="accept">ACCEPT</button>
                                    <button type="submit" name="decline" id="decline">DECLINE</button>
                                </form>
                                 <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                            </div>

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
                tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_student_registry.mobile_number
                FROM tbl_appointment INNER JOIN tbl_staff_registry 
                ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type != 'UniFAST - Claim Cheque' 
                AND tbl_appointment.appointment_type != 'UniFAST - Submit Documents' ORDER BY date_created ASC";

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
                        <div class="row_app">
                            <div class="col_app" id="serialno_pend">
                                <?php  echo $i++; ?>
                            </div>
                            <div class="col_app" id="datecreated">
                                <?php echo $rows['date_created']; ?>
                            </div>
                            <div class="col_app" id="apptype_pend">
                                <?php echo $rows['appointment_type']; ?>
                            </div>
                            <div class="col_app" id="studentname_pend">
                                <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                            </div>
                            <div class="col_app" id="courseandyear">
                                <?php echo $rows['course']." ".$rows['year']; ?>
                            </div>
                            <div class="col_app" id="studnote_pend">
                                <?php
                                         if($rows['note']==""){
                                            echo "No note.";
                                        }
                                        else{
                                           echo $rows['note'];
                                        }
                                        ?>
                            </div>
                            <div class="col_app" id="setdate">
                                <?php
                                    //set the time to local time
                                    date_default_timezone_set('Asia/Manila');                           		
                                    $currentdate = date("Y-m-d");
                                ?>
                                
                                <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                                <form action="appointment/acceptordecline.php" method="post">
                               
                                    <input type="date" name="appointment_date" id="appointmentdate" value=""
                                        min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                        strtotime($currentdate. ' + 90 days'));?>">
                            </div>
                            <div class="col_app" id="comment_pend">
                                    <textarea name="comment" placeholder="Comment here" value=""></textarea>
                            </div>
                            <div class="col_app" id="acceptdecline">
                                    <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                    <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                    <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                    <input type="hidden" name="student_fullname" value="<?php echo $rows['first_name'].' '.$rows['last_name']; ?>">
                                    <input type="hidden" name="number" value="<?php echo $rows['mobile_number']; ?>">
                                    <button  type="submit" name="accept" id="accept">ACCEPT</button>
                                    <button type="submit" name="decline" id="decline">DECLINE</button>
                                </form>
                                 <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                            </div>

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


</main>

<style>
    #pendingrequests {
        background: #324e9e;
    }
    #pendingrequests .card_title,
    #pendingrequests .card_body {
        color: #fff;
    }
</style>