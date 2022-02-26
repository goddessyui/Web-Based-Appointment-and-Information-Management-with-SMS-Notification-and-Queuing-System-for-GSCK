<?php
include_once("../dbconfig.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>FORGOT PASSWORD</h1>
	<form class="forgotpassword_verify.php" method="POST">
    <div class="">
	Enter Username: <input type="text" name="username" value="" placeholder="Username" autocomplete="off" required />
	</div>
	<div class="">
		<button class="" type="submit" name="submit_username">Next</button>
	</div>
	</form>
	
    <?php
    if (isset($_POST['submit_username'])) { 
        $username = $_POST['username']; 
        $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username ='{$username}'");
        $query1 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username ='{$username}'");
        if (mysqli_num_rows($query) == 1){
            $row = $query->fetch_assoc();
            $m_number = $row["mobile_number"];
            $rand_no = rand(10000, 99999);
            include '../sms_test/smsAPIcon.php';
            $receiver = $m_number;
            $message = "Your One Time Password is " . $rand_no;
            $smsAPICode = "TR-CHRIS092678_LZ1J8";
            $smsAPIPassword = "hn9$2((%3{";
            $send = new smsfunction();
            $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
            if ($send == false){
                echo '<script type="text/javascript">alert("text messge not send")';
            }else{
            session_start();
		    session_unset();
    	    session_destroy();
		    session_start();
            $_SESSION["student_username"] = $username;
            $_SESSION["verification_id"] = "student";
            $_SESSION["verification_no"] = $rand_no;
            $_SESSION["m_number"] = $m_number;
            echo '<script type="text/javascript">alert("Student Username Verified");window.location.href="forgotpassword.php"</script>';
        }}
        else if (mysqli_num_rows($query1) == 1){
            $row = $query1->fetch_assoc();
            $m_number = $row["mobile_number"];
            $rand_no = rand(10000, 99999);
            include '../sms_test/smsAPIcon.php';
            $receiver = $m_number;
            $message = "Your One Time Password is " . $rand_no;
            $smsAPICode = "TR-CHRIS092678_LZ1J8";
            $smsAPIPassword = "hn9$2((%3{";
            $send = new smsfunction();
            $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
            echo '<script type="text/javascript">alert("Staff Username Verified");window.location.href="forgotpassword.php"</script>';
            if ($send == false){
                echo '<script type="text/javascript">alert("error message not sent")';
            }else{
                session_start();
		    session_unset();
    	    session_destroy();
		    session_start();
            $_SESSION["staff_username"] = $username;
            $_SESSION["verification_id"] = "staff";
            $_SESSION["verification_no"] = $rand_no;
            $_SESSION["m_number"] = $m_number;
            echo '<script type="text/javascript">alert("Staff Username Verified");window.location.href="forgotpassword.php"</script>';
        }}
        else {
            echo "Username not exist";
        }
    }
        ?>
    
    </body>
    </html>