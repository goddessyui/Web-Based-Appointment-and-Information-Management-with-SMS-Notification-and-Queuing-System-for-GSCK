<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["teacher_staff_id"];
$position = $_SESSION["teacher_position"];
$username = $_SESSION["teacher_username"];
$password = $_SESSION["teacher_password"];
if ($staff_id == "" && $username == "" && $password == "" && $position != "Teacher"){
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
<div class="">
            <div class="">
                <a class="" href="#">GSCK Appointment System</a>
            </div>
            <ul class="">
                <li class="active"><a href="transaction.php">Set Appointment</a></li>
		        <li><a href="stransaction.php">Set an announcement</a></li>
                <li><a href="stransaction.php">Set schedule</a></li>
                <li><a href="stransaction.php">Appointment Details</a></li>
                <li><a href="menu.php">Account</a></li>
            </ul>
            <ul class="">
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
            </ul>


<h1>This is the index(announcement schedule etc etc)</h1>
</body>
</html>