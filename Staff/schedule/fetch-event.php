<?php
session_start();
$staff_id = $_SESSION["staff_id"];
$username = $_SESSION["staff_username"];

if ($staff_id == "" || $username == ""){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}

    require_once "../../dbconfig.php";
    $json = array();
    $sqlQuery = "SELECT * FROM tbl_schedule WHERE staff_id = '".$staff_id."'";
    $result = mysqli_query($db, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($db);
    echo json_encode($eventArray);
?>