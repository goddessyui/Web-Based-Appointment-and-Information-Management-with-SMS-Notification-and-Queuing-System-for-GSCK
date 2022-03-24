<!-- This file will gather the data for schedules in schedules.php -->
<?php
    require_once "dbconfig.php";

    $json = array();
    $sqlQuery = "SELECT * FROM tbl_schedule WHERE `date` >= DATE(NOW())";

    $result = mysqli_query($db, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($db);
    echo json_encode($eventArray);
?>