<?php
session_start();
$staff_id = $_SESSION["staff_id"];
$username = $_SESSION["staff_username"];

if ($staff_id == "" || $username == ""){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}

require_once "../../dbconfig.php";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$staff = isset($_POST['staff']) ? $_POST['staff'] : "";
$query = mysqli_query($db, "SELECT tbl_schedule.staff_id, tbl_schedule.date FROM tbl_schedule WHERE staff_id='".$staff."' AND date='".$start."'");
	if (mysqli_num_rows($query) == 0){
    $sqlInsert = "INSERT INTO tbl_schedule (staff_id,title,date) VALUES ('".$staff."','".$title."','".$start."')";
$result = mysqli_query($db, $sqlInsert);
if (! $result) {
    $result = mysqli_error($db);
}
}

?>