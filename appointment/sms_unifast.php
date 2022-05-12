<?php
if (isset($accept)){
    $receiver = $m_number;
    $message = $student_fullname.":\n\n". $fullnames . ", has accepted your request for ".$appointment_type." and is set on " . date("F d, Y", strtotime($appointment_date)).
    ". Your queue number is ".$queuenumber."\n\n -Goldenstate College";
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);

}
else if (isset($accept_unifast)){
    $receiver = $m_number;
    $message =  $student_fullname.":\n\nCongratulations! You are a TES grantee, your schedule is on " . date("F d, Y", strtotime($appointment_date)).". Your queue number is ".$queuenumber."\n\n -Goldenstate College";;
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);

}

else if (isset($decline)){
    $receiver = $m_number;
    $message = $student_fullname.":\n\n". $fullnames . ", has declined your appointment request for ".$appointment_type."\n\n -Goldenstate College";
    $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
}
?>




