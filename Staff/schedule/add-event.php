<?php
require_once "../../dbconfig.php";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? "" : "";

$sqlInsert = "INSERT INTO tbl_schedule (staff_id,title,date) VALUES ('".$title."','".$title."','".$start."')";

$result = mysqli_query($db, $sqlInsert);

if (! $result) {
    $result = mysqli_error($db);
}
?>