<?php
if (isset($accept)){
    include '../sms_test/smsAPIcon.php';
    $receiver = $m_number;
    $message = $student_fullname.":\n\n". $fullnames . ", has accepted your request for ".$appointment_type." and is set on " . date("F d, Y", strtotime($appointment_date)).
    ". Your queue number is ".$queuenumber."\n\n -Goldenstate College";
    $send = new smsfunction();
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);


}

else if (isset($decline)){
    include '../sms_test/smsAPIcon.php';
    $receiver = $m_number;
    $message = $student_fullname.":\n\n". $fullnames . ", has declined your appointment request for ".$appointment_type."\n\n -Goldenstate College";
    $send = new smsfunction();
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
}

else if (isset($move)){
    include '../sms_test/smsAPIcon.php';
    $receiver = $m_number;
    $message = $student_fullname.":\n\n". $fullnames . ", has rescheduled the appointment for ".$appointment_type." the new date is on " . date("F d, Y", strtotime($newDate)).". Your new queue number is ".$queuenumber."\n\n -Goldenstate College";
    $send = new smsfunction();
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
}

else if (isset($cancel)){
    include '../sms_test/smsAPIcon.php';
    $receiver = $m_number;
    $message = $student_fullname.":\n\n". $fullnames . ", has cancelled the appointment for " .$appointment_type."\n\n -Goldenstate College";
    $send = new smsfunction();
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
}

?>
