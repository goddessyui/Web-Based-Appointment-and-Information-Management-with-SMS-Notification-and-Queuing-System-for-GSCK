<?php
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" || $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="../../index.php"</script>';
}

require_once "../../dbconfig.php";

$id = $_POST['id'];
$sqlDelete = "DELETE from tbl_schedule WHERE id=".$id;

mysqli_query($db, $sqlDelete);
echo mysqli_affected_rows($db);

mysqli_close($db);
?>