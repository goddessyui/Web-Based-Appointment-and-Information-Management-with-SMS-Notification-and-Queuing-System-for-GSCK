<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
if ($staff_id == "" && $username == "" && $position != "Registrar"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}
?>


<div >
<div class="">
                <a class="" href="#">GSCK Appointment System</a>
            </div>             
           
            <ul class="">
                <li class="active"><a href="../../appointment/staff_appointment_details.php">Appointments</a></li>
		        <li><a href="../announcement/announcements_admin.php">Make Announcements</a></li>
                <li><a href="../schedule/schedule_admin.php">Set Schedules</a></li>
                <li><a href="upload_student_records.php">Student Records</a></li>
                <li><a href="upload_staff_records.php">Staff Records</a></li>
                <li><a href="../staff_profile.php">Account</a></li>

            </ul>
            <ul class="">
                <li><a href="../../logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
            </ul>
            </div>

<h1>REGISTRAR'S PAGE!!</h1>

</body>
</html>