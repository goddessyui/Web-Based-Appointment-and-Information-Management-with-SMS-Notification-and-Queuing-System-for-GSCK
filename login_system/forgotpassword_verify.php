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
	<form method="POST">
    <!-- <div class="">
	Enter Username: <input type="text" name="username" value="" placeholder="Username" autocomplete="off" required />
	</div>
	<div class="">
		<button class="" type="submit" name="button_verify">Verify</button>
	</div> -->

    <label>Enter Mobile No</label>
    <input type="text" name="mobile_no" value="<?php echo !empty($recipient_no)?$recipient_no:''; ?>" <?php echo ($otpDisplay == 1)?'readonly':''; ?>/>
    <?php if($otpDisplay == 1){ ?>
    <label>Enter OTP</label>
    <input type="text" name="otp_code"/>
    <a href="javascript:void(0);" class="resend">Resend OTP</a>
    <?php } ?>
    <input type="submit" name="<?php echo ($otpDisplay == 1)?'submit_otp':'submit_username'; ?>" value="VERIFY"/>

	</form>
	
    <?php
    $receipient_no = '';
    $otpDisplay = 0;
    if (isset($_POST['submit_username'])) {  
        $rand_no = rand(10000, 99999);
        $otpDisplay = 1;
        $recipient_no = $_POST['mobile_no'];

    // $username = $_POST["usename"];
    // $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username ='{$username}'");
    // $query1 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username ='{$username}'");
    //     if (mysqli_num_rows($query) == 1 && mysqli_num_rows($query1) == 0){
    //         session_start();
	// 	    session_unset();
    // 	    session_destroy();
	// 	    session_start();
    //         $_SESSION["student_username"] = $username;
    //         $_SESSION["verification_id"] = "student";
    //     }
    //     else if (mysqli_num_rows($query) == 0 && mysqli_num_rows($query1) == 1){
    //         session_start();
	// 	    session_unset();
    // 	    session_destroy();
	// 	    session_start();
    //         $_SESSION["staff_username"] = $username;
    //         $_SESSION["verification_id"] = "staff";

    //     }
    }
else if(isset($_POST['submit_otp']) && !empty($_POST['otp_code'])){
    $otpDisplay = 1;
}
        ?>
    
    </body>
    </html>