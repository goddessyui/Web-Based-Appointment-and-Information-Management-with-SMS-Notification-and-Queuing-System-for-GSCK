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
	<form class="verification.php" method="POST">
	
	<div class="">
		<input type="text" name="student_id" value="" placeholder="Your Student/Staff ID" autocomplete="off" required />
	</div>
    <div class="">
		<input type="text" name="first_name" value="" placeholder="Your First Name" autocomplete="off" required />
	</div>
	<div class="">
		<input type="text" name="last_name" value="" placeholder="Your Last Name" autocomplete="off" required />
	</div>
	
	<div class="">
		<button class="" type="submit" name="button_register">Verify</button>
	</div>
	</form>
	<?php


if (isset($_POST['button_register'])) {
	$student_id = $_POST['student_id']; 
    $first_name = $_POST['first_name']; 
    $last_name = $_POST['last_name']; 
	$query = mysqli_query($db, "SELECT * FROM tbl_student_record WHERE student_id='{$student_id}' AND first_name='{$first_name}' AND last_name='{$last_name}'");
	$query1 = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
	$query2 = mysqli_query($db, "SELECT * FROM tbl_staff_record WHERE staff_id='{$student_id}' AND first_name='{$first_name}' AND last_name='{$last_name}'");
	$query3 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE staff_id='{$student_id}'");
	if (mysqli_num_rows($query) == 1 && mysqli_num_rows($query1) == 0){
		session_start();
		session_unset();
    	session_destroy();
		session_start();
		$_SESSION["s_id"] = "1";
		$_SESSION["student_id"] = $student_id;
		echo '<script type="text/javascript">alert("Student Verified");window.location.href="student_registration.php"</script>';
	}
	else if(mysqli_num_rows($query2) == 1 && mysqli_num_rows($query3) == 0){
		session_start();
		session_unset();
    	session_destroy();
		session_start();
		$_SESSION["s_id"] = "2";
		$_SESSION["staff_id"] = $student_id;
		echo '<script type="text/javascript">alert("Staff Verified");window.location.href="staff_registration.php"</script>';
	}
	else if(mysqli_num_rows($query1) == 1 || mysqli_num_rows($query3) == 1){
	echo '<p color="red">The Student/Staff ID <i>'.$student_id.'</i> is alrady been signed up.</p>';
	}

	
	else {
		echo '<p color="red">The Student ID <i>'.$student_id.'</i> is not on the list. Please type another.</p>';
}
}
	
?>
      

       
</body>
</html>