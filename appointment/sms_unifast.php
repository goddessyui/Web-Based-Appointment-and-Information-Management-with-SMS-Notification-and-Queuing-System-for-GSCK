<?php
if (isset($accept)){
    $receiver = $m_number;
    // $message = $student_fullname.":\n\n". $fullnames . ", has accepted your request for ".$appointment_type." and is set on " . date("F d, Y", strtotime($appointment_date)).
    // " from 8AM - 5PM only. Your unique queue number is ".$queuenumber."\n\n -Goldenstate College";
    $message =  "accepted your request for ".$appointment_type." and is set on " . date("F d, Y", strtotime($appointment_date)).
    " from 8AM - 5PM only. ".$queuenumber;
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);

}
else if (isset($accept_unifast)){
    $receiver = $m_number;
    // $message =  $student_fullname.":\n\nCongratulations! You are a TES grantee, your schedule is on " . date("F d, Y", strtotime($appointment_date))." from 8AM - 5PM only. Your unique queue number is ".$queuenumber."\n\n -Goldenstate College";;
    $message =  "You are a TES grantee,  on " . date("F d, Y", strtotime($appointment_date))." from 8AM - 5PM only.  ".$queuenumber;
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);

}

else if (isset($decline)){
    $receiver = $m_number;
    // $message = $student_fullname.":\n\n". $fullnames . ", has declined your appointment request for ".$appointment_type."\n\n -Goldenstate College";
    $message = " declined your appointment request for ".$appointment_type;
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
}

else if (isset($move)){
    $receiver = $m_number;
    // $message = $student_fullname.":\n\n". $fullnames . ", has rescheduled the appointment for ".$appointment_type.". Your new schedule is set on " . date("F d, Y", strtotime($newDate))." from 8AM - 5PM only. Your new unique queue number is ".$queuenumber."\n\n -Goldenstate College";
    $message = "rescheduled for ".$appointment_type.". on " . date("F d, Y", strtotime($newDate))." from 8AM - 5PM only.".$queuenumber;
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
}

else if (isset($cancel)){
    $receiver = $m_number;
    // $message = $student_fullname.":\n\n". $fullnames . ", has cancelled the appointment for " .$appointment_type."\n\n -Goldenstate College";
    $$message = "cancelled the appointment for " .$appointment_type;
}
?>




