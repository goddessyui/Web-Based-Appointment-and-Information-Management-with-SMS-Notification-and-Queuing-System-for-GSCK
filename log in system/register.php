<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<?php include_once("dbconfig.php"); ?>
<body>
    <h1>member system tutorial - register</h1> 
    
    <form action="./register.php" class="form" method="POST">
	
	<h1>create account</h1>

	<div class="">
	
	</div>

	<div class="">
		<input type="text" name="student_id" value="" placeholder="Your Student ID" autocomplete="off" required />
	</div>
    <div class="">
		<input type="text" name="first_name" value="" placeholder="Your First Name" autocomplete="off" required />
	</div>
	<div class="">
		<input type="text" name="last_name" value="" placeholder="Your Last Name" autocomplete="off" required />
	</div>
	
	<div class="">
		<input class="" type="submit" name="button_register" value="Verify" />
	</div>

	<p class="center"><br />
		Already have an account? <a href="<?php echo SITE_ADDR ?>/login">Login here</a>
	</p>
    <?php

if (isset($_POST['button_register'])) {
	
	$student_id = $_POST['student_id']; 
    $first_name = $_POST['first_name']; 
    $last_name = $_POST['last_name']; 
    

	$query = mysqli_query($conn, "SELECT * FROM student_record WHERE student_id='{$student_id}' AND first_name='{$first_name}' AND last_name='{$last_name}'");
	if (mysqli_num_rows($query) == 1){
		echo '<script type="text/javascript">alert("Login Successful!");window.location.href="student_index.php"</script>';
	
	}
	else
		$error_msg = 'The Student ID <i>'.$student_id.'</i> is not on the list. Please type another.';
}
	?>

</form>
       
</body>
</html>