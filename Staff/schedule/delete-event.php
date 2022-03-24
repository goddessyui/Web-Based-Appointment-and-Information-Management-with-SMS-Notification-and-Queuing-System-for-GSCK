<?php
session_start();
$staff_id = $_SESSION["staff_id"];
$username = $_SESSION["staff_username"];

if ($staff_id == "" || $username == ""){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}

require_once "../../dbconfig.php";

$id = $_POST['id'];
$sqlDelete = "DELETE from tbl_schedule WHERE id=".$id;

mysqli_query($db, $sqlDelete);
echo mysqli_affected_rows($db);

mysqli_close($db);
?>