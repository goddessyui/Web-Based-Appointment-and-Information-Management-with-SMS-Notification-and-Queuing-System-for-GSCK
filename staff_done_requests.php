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
        <h2>Past Appointments</h2> 
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
        <div class="col_app" id="serialnum"></div>
        <div class="col_app" id="apptdate">Appt. Date</div>
        <div class="col_app" id="appttype">Appt.Type</div>
        <div class="col_app" id="studentfullname">Student</div> 
        <div class="col_app" id="thestudnote">Student's Note</div>
        <div class="col_app" id="staffcomment">Comment</div>
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
                        <div class="row_app">
                            <div class="col_app" id="serialnum">
                                <?php   
                                    echo $i++; 
                                ?>
                            </div>

                            <div class="col_app" id="apptdate">
                                <?php echo $rows['appointment_date']; ?>
                                <small>
                                    <p><b>Date Accepted:</b></p><p><?php echo $rows['date_accepted']; ?></p> 
                                    <p><b>Date Requested:</b></p><p><?php echo $rows['date_created']; ?></p>
                                </small>
                            </div>

                            <div class="col_app" id="appttype">
                                <?php echo $rows['appointment_type']; ?>
                            </div>

                            <div class="col_app" id="studentfullname">
                                <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                <small>
                                    <p><b>Course and Year:</b></p><p><?php echo $rows['course']." ".$rows['year']; ?></p>
                                </small>
                            </div>

                            <div class="col_app" id="thestudnote">
                                <?php
                                if($rows['note']==""){
                                    echo "No note.";
                                }
                                else{
                                    ?><?php echo $rows['note'];  ?><?php
                                }
                                ?>
                            </div>

                            <div class="col_app" id="staffcomment">
                            <?php
                                if($rows['note']==""){
                                    echo "No note.";
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