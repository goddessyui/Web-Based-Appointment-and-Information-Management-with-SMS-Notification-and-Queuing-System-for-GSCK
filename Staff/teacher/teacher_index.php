<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];

if ($staff_id == "" && $username == "" && $position != "Teacher"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
              
           
                <ul class="">
                <li class="active"><a href="#">Appointments</a></li>
		        <li><a href="../announcement/announcement_test.php">Make Announcements</a></li>
                <li><a href="#">Schedules</a></li>
                <li><a href="../staff_profile.php">Account</a></li>
            </ul>
            <ul class="">
                <li><a href="../../logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
            </ul>
            </div>

            <h1>TEACHER PAGE</h1>

</body>
</html>