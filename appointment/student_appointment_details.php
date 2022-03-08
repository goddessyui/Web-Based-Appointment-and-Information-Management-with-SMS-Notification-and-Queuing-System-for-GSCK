<?php
    include_once("../dbconfig.php");
    // Student Session
    session_start();
    $student_id = $_SESSION["student_id"];
    $username1 = $_SESSION["student_username"];
    $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
    $row = $query->fetch_assoc();
    if ($student_id == "" && $username1 == ""){
        echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
    }

?>
<!-- Active/Accepted Appointments-->
<h4>Active Appointments</h4>
<?php
include("student_accepted_app.php");
?>
<hr>

<!-- Pending Appointments-->
<h4>Pending Appointment Requests</h4>
<?php
include("student_pending_app.php");
?>
<hr>

<!-- Declined/Cancelled Appointments-->
<h4>Declined/Cancelled Appointments</h4>
<?php
include("student_declined_app.php");
?>
<hr>

<!-- Finished Appointments-->
<h4>Past Appointments</h4>
<?php
include("student_done_app.php");
?>
<hr>

