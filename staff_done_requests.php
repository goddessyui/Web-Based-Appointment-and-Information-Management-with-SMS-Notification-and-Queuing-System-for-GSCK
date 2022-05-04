<?php
include("admin_header.php");
?>
<main>
  
    <?php include("count_app.php");?>
    <h3>Past Appointments</h3> 

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
               
            }
            ?>
            <!--success or error-->
        </div>

        <div class="row_label">
           
            <div class="col_app">Appt. Date</div>
            <div class="col_app">Date Accepted</div>
            <div class="col_app">Date Requested</div>
            <div class="col_app">Appt.Type</div>
            <div class="col_app">Student</div> 
            <div class="col_app">Student's Note</div>
            <div class="col_app">Comment</div>

        </div>

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
 
                if($donerequest_result==TRUE) {
                    $count = mysqli_num_rows($donerequest_result);
                                    
                    if($count>0) {
                      
                        while($rows=mysqli_fetch_assoc($donerequest_result)) {?>
                            <div class="row_app">

                                <div class="col_app">
                                    <?php echo $rows['appointment_date']; ?>
                                    <small>
                                        <p><b>Date Accepted:</b></p><p><?php echo $rows['date_accepted']; ?></p> 
                                        <p><b>Date Requested:</b></p><p><?php echo $rows['date_created']; ?></p>
                                    </small>
                                </div>

                                <div class="col_app">
                                    <?php echo $rows['appointment_type']; ?>
                                </div>

                                <div class="col_app">
                                    <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                    <small>
                                        <p><b>Course and Year:</b></p><p><?php echo $rows['course']."-".$rows['year']; ?></p>
                                    </small>
                                </div>

                                <div class="col_app">
                                    <?php
                                    if($rows['note']==""){
                                        echo "No note.";
                                    }
                                    else{
                                        ?><?php echo $rows['note'];  ?><?php
                                    }
                                    ?>
                                </div>

                                <div class="col_app">
                                    <?php
                                    if($rows['comment']==""){
                                        echo "You did not comment.";
                                    }
                                    else{
                                        ?><?php echo $rows['comment'];  ?><?php
                                    }
                                    ?>
                                </div>
                                
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
    </div>
</main>

<style>
    #pastrequests {
        background: #324e9e;
    }
    #pastrequests .card_title,
    #pastrequests .card_body {
        color: #fff;
    }
</style>