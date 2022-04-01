<?php 
    include("admin_header.php");
?>

<main>
    <!---------------Set Appointment Limit------------------------------------------------->
    <div>
        <form action="appointment_limit.php" method="post">
            <h5>Limit the No. of Appointments Per Day:</h5>
            <?php
                $limit = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
                $limitvalue= mysqli_query($db, $limit);
                if($limitvalue==TRUE){
                    while($al=mysqli_fetch_assoc($limitvalue)){
            ?>
                        <input type="text" name="limit_value" value="<?php echo $al['appointment_limit'];?>" 
                        min="1" max="5000">
                        <input type="submit" name="limit" value="Limit">
            <?php
                    }
                }
            ?>
        </form>
    </div>
    <hr>
    <!---------------Set Appointment Limit------------------------------------------------->

    <!---------------Reports for Registrar------------------------------------------------->
    <?php
    if ($position == "Registrar"){//Start of show if Registrar?>
    <div>
        <div>
            <h5>No. of Enrolled Students</h5>
            <p>
                <?php
                    $enrolledstudents = "SELECT * FROM tbl_student_record";
                    $enrolledstudents_result = mysqli_query($db, $enrolledstudents);
                    $count = mysqli_num_rows($enrolledstudents_result);
                    echo $count;
                ?>
            </p>
        </div>
        <div>
            <h5>No. of Employed Staff</h5>
            <p>
                <?php
                    $enrolledstaff = "SELECT * FROM tbl_staff_record";
                    $enrolledstaff_result = mysqli_query($db, $enrolledstaff);
                    $count = mysqli_num_rows($enrolledstaff_result);
                    echo $count;
                ?>
            </p>
        </div>
        <div>
            <h5>No. of Registered Students</h5>
            <p>
                <?php
                    $registeredstudents = "SELECT * FROM tbl_student_registry";
                    $registeredstudents_result = mysqli_query($db, $registeredstudents);
                    $count = mysqli_num_rows($registeredstudents_result);
                    echo $count;
                ?>
            </p>
        </div>
        <div>
            <h5>No. of Registered Staff</h5>
            <p>
                <?php
                    $registeredstaff = "SELECT * FROM tbl_staff_registry";
                    $registeredstaff_result = mysqli_query($db, $registeredstaff);
                    $count = mysqli_num_rows($registeredstaff_result);
                    echo $count;
                ?>
            </p>
        </div>
        <div>
            <h5>Total No. of Appointments</h5>
            <p>
                <?php
                    $app = "SELECT * FROM tbl_appointment_detail WHERE `status`='Accepted'";
                    $app_result = mysqli_query($db, $app);
                    $count = mysqli_num_rows($app_result);
                    echo $count;
                ?>
            </p>
        </div>
        <div>
            <h5>No. of Appointments Today</h5>
        </div>
    </div>
    <?php
    }//End of show if Registrar
    ?>
    <!---------------Reports for Registrar------------------------------------------------->

    <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
    <div>
        <!--------------Start of No. of Active Requests-------------->
        <div>
            <h5>Active Requests</h5>
            <p>
                <?php
                    $acceptedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id'";
                    $acceptedrequest_result = mysqli_query($db, $acceptedrequest);
                    $count = mysqli_num_rows($acceptedrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Active Requests-------------->
        <!--------------Start of No. of Pending Requests-------------->
        <div>
            <h5>Pending Requests</h5>
            <p>
                <?php
                    $pendingrequest="SELECT * FROM tbl_appointment INNER JOIN tbl_staff_registry 
                        ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                        WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                        AND tbl_staff_registry.staff_id = '$staff_id'";
                    $pendingrequest_result = mysqli_query($db, $pendingrequest);
                    $count = mysqli_num_rows($pendingrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Pending Requests-------------->
        <!--------------Start of No. of Missed Requests-------------->
        <div>
            <h5>Missed Requests</h5>
            <p>
                <?php
                    $missedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE DATE(tbl_appointment_detail.appointment_date) < CURDATE() 
                        AND tbl_appointment_detail.status = 'Accepted' 
                        AND tbl_staff_registry.staff_id = '$staff_id'";
                    $missedrequest_result = mysqli_query($db, $missedrequest);
                    $count = mysqli_num_rows($missedrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Missed Requests-------------->

        <!--------------Start of No. of Declined Requests-------------->
        <div>
            <h5>Declined Requests</h5>
            <p>
                <?php
                    $declinedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_appointment_detail.status = 'Declined' AND tbl_appointment.staff_id = '$staff_id'";
                    $declinedrequest_result = mysqli_query($db, $declinedrequest);
                    $count = mysqli_num_rows($declinedrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Declined Requests-------------->
        <!--------------Start of No. of Cancelled Requests-------------->
        <div>
            <h5>Cancelled Requests</h5>
            <p>
                <?php
                    $cancelledrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_appointment_detail.status = 'Cancelled' AND tbl_appointment.staff_id = '$staff_id'";
                    $cancelledrequest_result = mysqli_query($db, $cancelledrequest);
                    $count = mysqli_num_rows($cancelledrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Cancelled Requests-------------->
        <!--------------Start of No. of Past Requests-------------->
        <div>
            <h5>Past Requests</h5>
            <p>
                <?php
                    $donerequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                        WHERE tbl_appointment_detail.status = 'done' AND tbl_appointment.staff_id = '$staff_id'";
                    $donerequest_result = mysqli_query($db, $donerequest);
                    $count = mysqli_num_rows($donerequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Declined Requests-------------->
    </div>
    <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->

    <!----------Viewable only by Registrar----------------------->  
    <!----------Viewable only by Registrar----------------------->  

    <!----------Includes----------------------->  
    <div id="unifastrec">UniFAST Grantee Records
        <?php include("Staff/accounting_staff/upload_unifast_grantee.php");?>    
    </div>
    <div id="appointment">My Appointments
        <?php include("staff_appointment_details.php");?>   
    </div>

</main>
</body>
</html>
<style>
   
   #unifastrec, 
   #appointment
     {
        display: none;
    }
</style>
<script>
     function unifastgranteerecords() {
     
        document.getElementById('unifastrec').style.display = "block";
        document.getElementById('appointment').style.display = "none";
        return false;
       
    }
    function myappointments() {
        document.getElementById('unifastrec').style.display = "none";
        document.getElementById('appointment').style.display = "block";
        return false;
    }
</script>

 


