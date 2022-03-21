<?php
require_once "../../dbconfig.php";

$id = $_POST['id'];
$sqlDelete = "DELETE from tbl_schedule WHERE id=".$id;

mysqli_query($db, $sqlDelete);
echo mysqli_affected_rows($db);

mysqli_close($db);
?>