<?php
if ($staff_id == "" || $staff_username == ""){
    echo '<script type="text/javascript">window.location.href="index.php"</script>';
 }
include 'sms_test/smsAPIcon.php';
$send = new smsfunction();

// insert data into tbl_notification if staff added an announcement
if (!empty($check)){
$querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
$rows = $querys->fetch_assoc();
$fullnames = $rows['first_name'].' '.$rows['last_name'];


switch ($year) {
    case "1":
      $year_lvl = '1st';
      break;
    case "2":
        $year_lvl = '2nd';
      break;
    case "3":
        $year_lvl = '3rd';
      break;
    case "4":
        $year_lvl = '4th';
        break;
    default:
 
  }



if ($course=='ALL' && $year=='ALL'){
    $sql_sms = "SELECT
    mobile_number
    FROM
    tbl_student_registry";

    $res_sms = mysqli_query($db, $sql_sms);
    if (mysqli_num_rows($res_sms) > 0) {

    while ($row_sms = mysqli_fetch_assoc($res_sms)) {
        $receiver = $row_sms['mobile_number'];
        $message = "Hello, Good day!\n\n". $fullnames . ", added new announcement in gsck.online/announcements.php \n\n -Goldenstate College";
        $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
        
    }

    }
}


else if ($course=='ALL' && $year!='ALL'){
    $sql_sms = "SELECT
    mobile_number
    FROM
    tbl_student_registry
    WHERE `year` = '$year'";
    $res_sms = mysqli_query($db, $sql_sms);
    if (mysqli_num_rows($res_sms) > 0) {

    while ($row_sms = mysqli_fetch_assoc($res_sms)) {
        $receiver = $row_sms['mobile_number'];
        $message = "Hello, Good day!\n\n". $fullnames . ", added new announcement specifically for " . $year_lvl . " year student in gsck.online/announcements.php \n\n -Goldenstate College";
        $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
      
    }

    }
}


else if ($course!='ALL' && $year=='ALL'){
    $sql_sms = "SELECT
    mobile_number
    FROM
    tbl_student_registry
    WHERE course = '$course'";
    $res_sms = mysqli_query($db, $sql_sms);
    if (mysqli_num_rows($res_sms) > 0) {

    while ($row_sms = mysqli_fetch_assoc($res_sms)) {
        $receiver = $row_sms['mobile_number'];
        $message = "Hello, Good day!\n\n". $fullnames . ", added new announcement specifically for " . $course . " student in gsck.online/announcements.php \n\n -Goldenstate College";
        $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
      
    }

    }
}


else {
    $sql_sms = "SELECT
    mobile_number
    FROM
    tbl_student_registry
    WHERE `year` = '$year' AND course = '$course'";
    $res_sms = mysqli_query($db, $sql_sms);
    if (mysqli_num_rows($res_sms) > 0) {

    while ($row_sms = mysqli_fetch_assoc($res_sms)) {
        $receiver = $row_sms['mobile_number'];
        $message = "Hello, Good day!\n\n". $fullnames . ", added new announcement specifically for ". $year_lvl ." year " . $course . " student in gsck.online/announcements.php \n\n -Goldenstate College";
        $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
      
    }

    }
}


}


?>