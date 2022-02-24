<?php
include_once("../dbconfig.php"); 
start_session();
$student_username =  $_SESSION["student_username"];
$staff_username = $_SESSION["staff_username"];
if ($student_username == "" && $staff_username ==""){
    echo '<script type="text/javascript">window.location.href="forgotpassword_verify.php"</script>';
}
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
	<form class="login.php" method="POST">
    <div class="">
	Username: <input type="text" name="username" value="<?php echo $row["staff_id"]?>"  autocomplete="off" required readonly/>
	</div>
	<div class="">
		<input type="text" name="OTP" value="" placeholder="Verification Code" autocomplete="off" required />
	</div>
	<div class="">
		<button class="" type="submit" name="button_verify">Verify</button>
	</div>
	</form>
	
    <?php
    if (isset($_POST['button_verify'])) {
    $username = $_POST["usename"];
    $query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username ='{$username}'")
        if (mysqli_num_rows($query) == 0 && mysqli_num_rows($query1) == 0){

        include '../smsAPIcon.php';
        $receiver = $_POST["reciever"];
        $message = $_POST["message"];
        $smsAPICode = "TR-CHRIS092678_LZ1J8";
        $smsAPIPassword = "hn9$2((%3{";
        $send = new smsfunction();
        $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
        
    if ($send == false){
        echo '<script type="text/javascript">alert("text messge not send")';
    }
    }
    }

    ?>

</body>
</html>