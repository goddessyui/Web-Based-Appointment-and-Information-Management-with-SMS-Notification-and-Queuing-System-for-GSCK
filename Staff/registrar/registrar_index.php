<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["registrar_staff_id"];
$position = $_SESSION["registrar_position"];
$username = $_SESSION["registrar_username"];
$password = $_SESSION["registrar_password"];
if ($staff_id == "" && $username == "" && $password == "" && $position != "Registrar"){
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