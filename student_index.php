<?php
include_once("dbconfig.php"); 
session_start();
$student_id = $_SESSION["student_id"];
$username1 = $_SESSION["student_username"];
if ($student_id == "" && $username1 == ""){
    echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
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
                <li class="active"><a href="transaction.php">Request an Appointment</a></li>
		<li><a href="stransaction.php">Appointment Details</a></li>
                <li><a href="menu.php">Account</a></li>
            </ul>
            <ul class="">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
            </ul>


            <?php include 'announcement_display.php'; ?>


</body>
</html>