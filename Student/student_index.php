<?php
include_once("../dbconfig.php"); 
session_start();
$student_id = $_SESSION["student_id"];
$username1 = $_SESSION["username"];
$password1 = $_SESSION["password"];
if ($student_id == "" && $username1 == "" && $password1 == ""){
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
    <h1>HELLO!!</h1>
</body>
</html>