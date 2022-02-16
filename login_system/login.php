<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php include_once("../dbconfig.php"); ?>
<body>

<h1>Log In</h1>
	<form class="login.php" method="POST">
    <div class="">
		<input type="text" name="username" value="" placeholder="Username" autocomplete="off" required />
	</div>
	<div class="">
		<input type="password" name="password" value="" placeholder="Password" autocomplete="off" required />
	</div>
	
	<div class="">
		<button class="" type="submit" name="button_login">Login</button>
	</div>
	
	<p class="center"><br />
        Don't have an account? <a href="verification.php">Register here</a>
	</p>
	</form>
	<?php


if (isset($_POST['button_login'])) {
    $username = $_POST['username']; 
    $password = $_POST['password']; 
	$query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username='{$username}' AND password='{$password}'");
	$query2 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username='{$username}' AND password='{$password}'");
	if (mysqli_num_rows($query) == 1){
        $row = $query->fetch_assoc();
        $student_id = $row["student_id"];
        $query1 = mysqli_query($db, "SELECT * FROM tbl_student_record WHERE student_id='{$student_id}'");
    if (mysqli_num_rows($query1) == 1){
        session_start();
		session_unset();
    	session_destroy();
		session_start();
		$_SESSION["student_id"] = $student_id;
		$_SESSION["student_username"] = $row["username"];
        $_SESSION["student_password"] = $row["password"];
		echo '<script type="text/javascript">alert("Student Verified");window.location.href="../Student/student_index.php"</script>';
    }
    else{
    echo '<script type="text/javascript">alert("Account not existing in student record");window.location.href="login.php"</script>';
    }
	}

	else if(mysqli_num_rows($query2) == 1){
        $row = $query2->fetch_assoc();
        $staff_id = $row["staff_id"];
        $position = $row["position"];
        $query3 = mysqli_query($db, "SELECT * FROM tbl_staff_record WHERE staff_id='{$staff_id}'");

    if (mysqli_num_rows($query3) == 1){
        if ($position == 'Registrar'){
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["registrar_staff_id"] = $staff_id;
            $_SESSION["registrar_position"] = $position;
            $_SESSION["registrar_username"] = $row["username"];
            $_SESSION["registrar_password"] = $row["password"];
            echo '<script type="text/javascript">alert("Successfully Log in as Registrar");window.location.href="../Staff/registrar/registrar_index.php"</script>';
        }   
        else if($position == 'Account Staff'){
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["accounting_staff_id"] = $staff_id;
            $_SESSION["accounting_position"] = $position;
            $_SESSION["accounting_username"] = $row["username"];
            $_SESSION["accounting_password"] = $row["password"];
            echo '<script type="text/javascript">alert("Successfully Log in as Accounting Staff");window.location.href="../Staff/accounting_staff/account_staff_index.php"</script>';
        }
        else if($position == 'Teacher'){
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["teacher_staff_id"] = $staff_id;
            $_SESSION["teacher_position"] = $position;
            $_SESSION["teacher_username"] = $row["username"];
            $_SESSION["teacher_password"] = $row["password"];
            echo '<script type="text/javascript">alert("Successfully Log in as Teacher");window.location.href="../Staff/teacher/teacher_index.php"</script>';
        }
    }
        else{
    echo '<script type="text/javascript">alert("Account not existing in Staff record");window.location.href="login.php"</script>';
    }
    }
    else {
		echo '<script type="text/javascript">alert("Username or Password Incorrect");window.location.href="login.php"</script>';
}
	}



	
?>




</body>
</html>