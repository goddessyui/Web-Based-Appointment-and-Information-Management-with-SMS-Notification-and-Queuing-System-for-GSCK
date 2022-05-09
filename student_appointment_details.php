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
            <button onclick="activeapp()">  
                    <h3>Active Appointments</h3>   
                    <h1>
                    <?php
                    date_default_timezone_set('Asia/Manila');                           		
                    $currentdate = date("Y-m-d");


                        $acceptedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                            tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                            tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                            FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                            ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                            INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                            WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Accepted'
                            AND tbl_appointment_detail.appointment_date >= '$currentdate'";
                        $accepted_appointment_list = mysqli_query($db, $acceptedappointment);
                        $count = mysqli_num_rows($accepted_appointment_list); 
                        echo $count;
                    ?>
                    </h1> 
            </button>

        </div>
        <!---------End of No. of Active Appointments-------------------------------->
        <!---------Start of No. of Pending Appointments-------------------------------->
        <div class="count_status">
            <button onclick="pendingapp()">
                <h3>Pending Appointments</h3>
                <h1>
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
                </h1>
               
            </button>
        </div>
        <!---------End of No. of Pending Appointments-------------------------------->
        <!---------Start of No. of Missed Appointments-------------------------------->
        <div class="count_status">
            <button onclick="missedapp()">
                <h3>Missed Appointments</h3>
                <h1>
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
                </h1>
                
            </button>
        </div>
        <!---------End of No. of Missed Appointments-------------------------------->
        <!---------Start of No. of Declined Appointments-------------------------------->
        <div class="count_status">
            <button onclick="declinedapp()">
                <h3>Declined Appointments</h3>
                <h1>
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
                </h1>
                
            </button>
        </div>
        <!---------End of No. of Declined Appointments-------------------------------->
        <!---------Start of No. of Cancelled Appointments-------------------------------->
        <div class="count_status">
            <button onclick="cancelledapp()">
                <h3>Cancelled Appointments</h3>
                <h1>
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
                </h1>
                
            </button>
        </div>
        <!---------End of No. of Cancelled Appointments-------------------------------->
        <!---------Start of No. of Past Appointments-------------------------------->
        <div class="count_status">
            <button onclick="doneapp()">
                <h3>Past Appointments</h3>
                <h1>
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
                </h1>
                
            </button>
        </div>
        <!---------End of No. of Past Appointments-------------------------------->
    </div><!---------End of No. of Appointments (Active, Pending, Declined, Cancelled, Past)-------------------------------->
    
    <div class="appnt_stud_result">
        <div class="white_appnt">
        <!---------Start of Show Appointment Based on Status----------------------------------->
            <h3 class="s_appnt">Student Appointment Details</h3>


   <?php if (isset($_GET['status'])){
          ?> <a href="student_appointment_details.php"><button type="button">View all appointment</button></a> <?php 
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
        

        
        <div> <!------Start of Appointment Status Includes ---------->
            <div id="appactive">
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
        </div>
    </div>
    <!---------End of Show Appointment Based on Status----------------------------------->
</div><!--End of parent-div-->

<?php
     include("backtotop.php");
?>



<style>
    body {
        background: #EFF0F4;
    }
    .parent-div{
        margin-top: 80px;
    }
    .cs_container{
       background: rgba(50, 78, 158, .8);
       position: relative;
       display: flex;
       align-items: center;
       justify-content: space-between;
       height: 80px;
       width: 100%;
       padding: 0 2%;
    }
    .count_status {
       transform: translateY(40px);
       width: 220px;
    }
 

    .count_status button {
       width: 220px;
       height: 80px;
       border: none;
       background: #fff;
       cursor: pointer;
    }
    .count_status h1 {
        margin-top: 8px;
        color: #324E9E;
        font-family: 'Roboto Serif';
    }
    .count_status h3 {
       color: #333;
       font-family: 'Roboto';
       font-size: 14px;
       font-weight: 400;
    }


    #apppending,
    #appmissed,
    #appdeclined,
    #appcancelled,
    #appdone {
        display: none;
    }
    .appnt_stud_result {
        background: none;
        margin-top: 80px;
        padding: 20px 0;
        padding-bottom: 0;
    }
    .appnt_stud_result .white_appnt {
        background: #fff;
        background-image: url("./image/calendar.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        padding: 20px 30px;
        padding-bottom: 40px;
        min-height: 68vh;
    }
    .appnt_stud_result .white_appnt .s_appnt {
        font-family: 'Roboto';
        font-size: 16px;
        margin-bottom: 15px;
        font-weight: 500;
        color: #eee;
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

