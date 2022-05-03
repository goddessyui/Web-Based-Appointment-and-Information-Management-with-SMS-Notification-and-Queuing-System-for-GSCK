<?php
include("admin_header.php");
?>
<main>

    <?php include("count_app.php");?>
    <h3>Pending Appointments</h3> 

    <div class="appointment_result">

        <div class="row">
            <!--success or error-->
            <?php 
            if(isset($_GET['success'])){
            ?>
            <p>
                <?php echo $_GET['success']; ?>
            </p> <?php
            }
            else{
            }
            if(isset($_GET['error'])){ ?>
                <p>
                    <?php echo $_GET['error']; ?>
                </p> <?php
            }
            else {
                echo "This is where the success or error statement appears. This statement is for testing. Please delete after designing.";
            }
            ?>
            <!--success or error-->
        </div>

        <div class="row_label">
    
            <div class="col_app">Date Requested</div>
            <div class="col_app">Appt. Type</div>
            <div class="col_app">Student Details</div>
            <div class="col_app">Student's Note</div>
            <div class="col_app">Set Appointment Date</div>
            <div class="col_app">Comment</div>
            <div class="col_app">Accept/Decline</div>

        </div>

                    
        <?php
        if($position!="Accounting Staff/Scholarship Coordinator") {?>
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
                    AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_id = '".$_GET['apde']."'";
            }
            else {
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
                if($request_result==TRUE) {
                    $count = mysqli_num_rows($request_result);
                                  
                    if($count>0) {
                  
                        while($rows=mysqli_fetch_assoc($request_result)) {?>
                            <div class="row_app">
                                
                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['date_created']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['appointment_type']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p><?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                    <p><?php echo $rows['course']."-".$rows['year']; ?></p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php
                                        if($rows['note']==""){
                                            ?><p><?php echo "No note."; ?></p><?php
                                        }
                                        else{
                                            ?><p><?php echo $rows['note']; ?></p><?php
                                        }?>
                                    </p>
                                </div>
                                
                                <div class="col_app">
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

                                <div class="col_app">
                                        <textarea name="comment" placeholder="Comment here..." value=""></textarea>
                                </div>

                                <div class="col_app">
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

                            </div><?php 
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

                if($request_result==TRUE) {
                    $count = mysqli_num_rows($request_result);
                                 
                    if($count>0) {
                        while($rows=mysqli_fetch_assoc($request_result)) {?>

                            <div class="row_app">
                                
                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['date_created']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['appointment_type']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p><?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                    <p><?php echo $rows['course']."-".$rows['year']; ?></p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php
                                        if($rows['note']==""){
                                            ?><p><?php echo "No note."; ?></p><?php
                                        }
                                        else{
                                            ?><p><?php echo $rows['note']; ?></p><?php
                                        }?>
                                    </p>
                                </div>
                                
                                <div class="col_app">
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

                                <div class="col_app">
                                        <textarea name="comment" placeholder="Comment here" value=""></textarea>
                                </div>

                                <div class="col_app">
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

                            </div><?php
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
    </div>

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