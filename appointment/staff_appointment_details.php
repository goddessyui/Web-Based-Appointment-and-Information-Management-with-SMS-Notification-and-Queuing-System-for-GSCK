<?php
    include_once("../dbconfig.php"); 
    session_start();
    $staff_id = $_SESSION["staff_id"];
    $position = $_SESSION["position"];
    $username = $_SESSION["staff_username"];
    if ($staff_id == "" && $username == "" && $position != "Accounting Staff/Scholarship Coordinator" && "Registrar" && "Teacher"){
        echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
    }
?>
<h2>Appointments</h2>
<ul>
    <li><a href="staff_pending_requests.php">Pending Appointment Requests</a></li>
    <li><a href="staff_accepted_requests.php">Active Appointments</a></li>
    <li><a href="staff_declined_requests.php">Cancelled/Declined Appointments</a></li>
    <li><a href="staff_done_requests.php">Past Appointments</a></li>

</ul>