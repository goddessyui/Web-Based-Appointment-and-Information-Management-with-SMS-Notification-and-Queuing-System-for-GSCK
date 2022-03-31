<?php
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" || $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="../../index.php"</script>';
}

require_once "../../dbconfig.php";

$staff_id = isset($_POST['staff']) ? $_POST['staff'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
if (date("Y-m-d") <= $start){
 $query = mysqli_query($db, "SELECT tbl_schedule.date FROM tbl_schedule WHERE date='".$start."' AND staff_id ='".$staff_id."' ");
	        if (mysqli_num_rows($query) == 0){
                echo 'true';
            }
        }
?>