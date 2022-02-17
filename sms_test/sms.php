<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<?php include_once("../dbconfig.php"); ?>
<body>
    <h1>Verifiying Student/Staff info</h1> 

	
	<h1>create account</h1>
	<form class="sms.php" method="POST">
	
	<div class="">
		<input type="text" name="reciever" value="" placeholder="number" autocomplete="off" required />
	</div>
    <div class="">
		<input type="text" name="message" value="" placeholder="Message" autocomplete="off" required />
	</div>
	<div class="">
		<button class="" type="submit" name="button_register">Login</button>
	</div>
	
	<p class="center"><br />
		Already have an account? <a href="login.php">Login here</a>
	</p>
	</form>


	<?php
    if (isset($_POST['button_register'])) {
    include 'smsAPIcon.php';
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

    ?>
       
</body>
</html>