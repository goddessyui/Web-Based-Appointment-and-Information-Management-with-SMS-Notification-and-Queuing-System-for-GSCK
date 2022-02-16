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
    <h1>HELLO!!</h1>
</body>
</html>