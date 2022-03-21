<?php
require_once "../../dbconfig.php";

$staff_id = isset($_POST['staff_id']) ? $_POST['staff_id'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
 $query = mysqli_query($db, "SELECT tbl_schedule.date FROM tbl_schedule WHERE date='".$start."' AND staff_id ='".$staff_id."' ");
	        if (mysqli_num_rows($query) == 0){
                echo "true";
?>