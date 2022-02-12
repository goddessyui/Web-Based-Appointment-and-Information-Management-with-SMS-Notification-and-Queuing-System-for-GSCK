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

	
	<h1>create account</h1>
	<form class="register.php" method="POST">
	
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
		<button class="" type="submit" name="button_register">Login</button>
	</div>
	
	<p class="center"><br />
		Already have an account? <a href="student_index.php">Login here</a>
	</p>
	</form>
	<?php


if (isset($_POST['button_register'])) {
	$student_id = $_POST['student_id']; 
    $first_name = $_POST['first_name']; 
    $last_name = $_POST['last_name']; 
	$query = mysqli_query($db, "SELECT * FROM student_record WHERE student_id='{$student_id}' AND first_name='{$first_name}' AND last_name='{$last_name}'");
	$query1 = mysqli_query($db, "SELECT * FROM student_registry WHERE student_id='{$student_id}'");
	if (mysqli_num_rows($query) == 1){
		session_start();
		session_unset();
    	session_destroy();
		session_start();
		$_SESSION["s_id"] = "1";
		$_SESSION["student_id"] = $student_id;
		echo '<script type="text/javascript">alert("Student Verified");window.location.href="student_index.php"</script>';
	}else if(mysqli_num_rows($query1) == 1){
		echo '<p color="red">The Student ID <i>'.$student_id.'</i> is alrady signed up.</p>';
	}
	
	else {
		echo '<p color="red">The Student ID <i>'.$student_id.'</i> is not on the list. Please type another.</p>';
}
}
	
?>
      

       
</body>
</html>