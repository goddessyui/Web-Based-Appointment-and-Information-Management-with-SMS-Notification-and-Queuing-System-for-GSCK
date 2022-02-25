<?php
include_once("../dbconfig.php"); 
session_start();
$student_username =  $_SESSION["student_username"];
$staff_username = $_SESSION["staff_username"];
$v_id = $_SESSION["verification_id"];
$v_number = $_SESSION["verification_no"];
$m_number = $_SESSION["m_number"];
$otpDisplay = "";
// if ($student_username == "" && $staff_username ==""){
//     echo '<script type="text/javascript">window.location.href="forgotpassword_verify.php"</script>';
// }
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
<h1>FORGOT PASSWORD we send to your number ****<?php echo substr($m_number, -1, 2);  ?></h1>
	<form  method="POST">
    <label>Enter Verification Code <?php echo $v_number ?></label>
    <input type="text" name="mobile_no" value="<?php echo !empty($verification)?$verification:''; ?>" <?php echo ($otpDisplay == 1)?'readonly':''; ?>/>
    
    
    <label>New Password</label>
    <div class="">
		<input type="text" name="verification" value="" placeholder="New Password" autocomplete="off" <?php echo !empty($verification)?'required':'disabled'; ?> />
	</div>
    <label>Re-enter new password</label>
    <div class="">
		<input type="text" name="OTP" value="" placeholder="Re enter new Password" autocomplete="off" <?php echo !empty($verification)?'required':'disabled'; ?> />
   
    <input type="submit" name="<?php echo ($otpDisplay == 1)?'new_password':'submit_verification'; ?>" value="VERIFY"/>
</form>


    <!-- <div class="">
	Verification Code: <input type="text" name="username" value=""  autocomplete="off" required />
	</div>
	<div class="">
		<input type="text" name="OTP" value="" placeholder="New Password" autocomplete="off" required />
	</div>
    <div class="">
		<input type="text" name="OTP" value="" placeholder="Re enter new Password" autocomplete="off" required />
	</div>
	<div class="">
		<button class="" type="submit" name="button_verify">Verify</button>
	</div>
	</form> -->

    <?php
    if (isset($_POST['submit_verification'])) {
        $verification = $_POST['mobile_no'];
        if ($verification == $v_number){
            $otpDisplay = 1;
        
            
         }else{
             echo "not match";
         }
        }
        $sql = "UPDATE tbl_staff_registry SET password = $newpassword WHERE username = $staff_username";
        if ($db->query($sql) === TRUE) {
            echo "Password updated successfully";
          } else {
            echo "Error changing password: " . $conn->error;
          }
        
    // if (isset($_POST['new_password'])) {
    //     $username = $_POST["usename"];
    //     $query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username ='{$username}'")
    //     }
        

    ?>

</body>
</html>