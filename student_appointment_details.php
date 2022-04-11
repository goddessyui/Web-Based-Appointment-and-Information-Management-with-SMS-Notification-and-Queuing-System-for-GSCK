<?php
include("header.php");
$student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
if (empty($_SESSION['student_id'])){
        echo '<script type="text/javascript">window.location.href="index.php"</script>';
    }

?>
<!-- Active/Accepted Appointments-->
<div class="parent-div">
    <div class="cs_container"><!---------Start of No. of Appointments (Active, Pending, Declined, Cancelled, Past)-------------------------------->
        <div class="count_status"><!---------Start of No. of Active Appointments-------------------------------->
            <h5>Active Appointments</h5><br>
            <p>
                <?php
                    $acceptedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                        tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Accepted'";
                    $accepted_appointment_list = mysqli_query($db, $acceptedappointment);
                    $count = mysqli_num_rows($accepted_appointment_list); 
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Active Appointments-------------------------------->
        <!---------Start of No. of Pending Appointments-------------------------------->
        <div class="count_status">
            <h5>Pending Appointments</h5><br>
            <p>
                <?php
                    $pendingappointment="SELECT * FROM tbl_appointment INNER JOIN tbl_staff_registry 
                    ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                    WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                    AND tbl_student_registry.student_id = '$student_id' AND tbl_appointment.status = 'Pending'";
                    $pending_appointment_list = mysqli_query($db, $pendingappointment);
                    $count = mysqli_num_rows($pending_appointment_list);
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Pending Appointments-------------------------------->
        <!---------Start of No. of Missed Appointments-------------------------------->
        <div class="count_status">
            <h5>Missed Appointments</h5><br>
            <p>
                <?php
                    $missedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
                        tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE DATE(tbl_appointment_detail.appointment_date) < CURDATE() 
                        AND tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Accepted'";
                    $missed_appointment_list = mysqli_query($db, $missedappointment);
                    $count = mysqli_num_rows($missed_appointment_list);
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Missed Appointments-------------------------------->
        <!---------Start of No. of Declined Appointments-------------------------------->
        <div class="count_status">
            <h5>Declined Appointments</h5><br>
            <p>
                <?php
                    $declinedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                        tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Declined'";
                    $declined_appointment_list = mysqli_query($db, $declinedappointment);
                    $count = mysqli_num_rows($declined_appointment_list); 
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Declined Appointments-------------------------------->
        <!---------Start of No. of Cancelled Appointments-------------------------------->
        <div class="count_status">
            <h5>Cancelled Appointments</h5><br>
            <p>
                <?php
                    $cancelledappointments="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                        tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Cancelled'";
                    $cancelled_appointment_list = mysqli_query($db, $cancelledappointments);
                    $count = mysqli_num_rows($cancelled_appointment_list); 
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Cancelled Appointments-------------------------------->
        <!---------Start of No. of Past Appointments-------------------------------->
        <div class="count_status">
            <h5>Past Appointments</h5><br>
            <p>
                <?php
                    $doneappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                        tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Done'";
                    $done_appointment_list = mysqli_query($db, $doneappointment);
                    $count = mysqli_num_rows($done_appointment_list); 
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Past Appointments-------------------------------->
    </div><!---------End of No. of Appointments (Active, Pending, Declined, Cancelled, Past)-------------------------------->
    
    <div><!---------Start of Show Appointment Based on Status----------------------------------->
    <h3 align="center">Student Appointment Details</h3><br><hr>

   <?php if (isset($_GET['status'])){
          ?> <hr><a href="student_appointment_details.php"><button type="button">View all appointment</button></a><hr> <?php 
          if($_GET['status'] == 'accepted'){
            include("reports/student_accepted_app.php");
          }
          if($_GET['status'] == 'declined'){
            include("reports/student_declined_app.php");
          }
          if($_GET['status'] == 'reschedule'){
            include("reports/student_accepted_app.php");
          }
          if($_GET['status'] == 'cancel'){
            include("reports/student_cancelled_app.php");
          }

        }
        else{
       ?>
        <!------Start of Appointment Status Buttons ---------------------->
        <button onclick="activeapp()">Active Appointments</button>
        <button onclick="pendingapp()">Pending Appointments</button>
        <button onclick="missedapp()">Missed Appointments</button>
        <button onclick="declinedapp()">Declined Appointments</button>
        <button onclick="cancelledapp()">Cancelled Appointments</button>
        <button onclick="doneapp()">Past Appointments</button>
         <!------End of Appointment Status Buttons ---------------------->
        <div> <!------Start of Appointment Status Includes ---------->
            <div id="appactive">
                <h4>Active Appointments</h4>
                <?php
                    include("reports/student_accepted_app.php");
                ?>
            </div>
            <div id="apppending">
                <h4>Pending Appointments</h4>
                <?php
                    include("reports/student_pending_app.php");
                ?>
            </div>
            <div id="appmissed">
                <h4>Missed Appointments</h4>
                <?php 
                    include("reports/student_missed_app.php");
                ?>
            </div>
            <div id="appdeclined">
                <h4>Declined Appointments</h4>
                <?php
                    include("reports/student_declined_app.php");
                ?>
            </div>
            <div id="appcancelled">
                <h4>Cancelled Appointments</h4>
                <?php
                    include("reports/student_cancelled_app.php");
                ?>
            </div>
            <div id="appdone">
                <h4>Past Appointments</h4>
                <?php
                    include("reports/student_done_app.php");
                ?>
            </div>
        </div> <!------End of Appointment Status Includes ----------><?php } ?>
    </div><!---------End of Show Appointment Based on Status----------------------------------->
    <?php
     include("backtotop.php");
    ?>
</div><!--End of parent-div-->
<style>
    .parent-div{
        padding-top: 150px;
        margin-left: 5%;
        margin-right: 30%;
    }
    
    .cs_container{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .count_status{
    width: 33.33%;
    background-color:lightgray;
    text-align: center;
    padding: 20px;
    }

    #appactive,
    #apppending,
    #appmissed,
    #appdeclined,
    #appcancelled,
    #appdone {
        display: none;
    }

</style>

<script>

    function activeapp() {
            document.getElementById('appactive').style.display = "block";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function pendingapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "block";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function missedapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "block";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function declinedapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "block";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function cancelledapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "block";
            document.getElementById('appdone').style.display = "none";
    }
    function doneapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "block";
    }

</script>

