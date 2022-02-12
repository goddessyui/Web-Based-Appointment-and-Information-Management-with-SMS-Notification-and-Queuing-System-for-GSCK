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
		<input class="" type="submit" name="button_register" value="create account" />
	</div>

	<p class="center"><br />
		Already have an account? <a href="<?php echo SITE_ADDR ?>/login">Login here</a>
	</p>
    <?php

if (isset($_POST['button_register'])) {

    $stmt = $db->prepare("SELECT *
    FROM student_record WHERE first_name = ? AND  last_name = ? AND student_id = ?");
    $stmt->bind_param("ss", $username, $password, $student_id);

    $username = $_POST['first_name'];
    $password = $_POST['last_name'];
    $student_id = $_POST['student_id']
</form>
       
</body>
</html>