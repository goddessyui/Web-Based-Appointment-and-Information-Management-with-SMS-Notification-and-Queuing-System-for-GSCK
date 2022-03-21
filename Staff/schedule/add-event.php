<?php
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