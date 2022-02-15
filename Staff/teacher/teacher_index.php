<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE staff_id='{$staff_id}'");
if (mysqli_num_rows($query) == 1){
$row = $query->fetch_assoc();
$staff_id1 = $row["staff_id"];
$position1 = $row["position"];
$password1 = $row["password"];
$username1 = $row["username"];
}
if ($staff_id != $staff_id1 && $username != $username1 && $password != $password1 && $position != "Teacher") {
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}
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