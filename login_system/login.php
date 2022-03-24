<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="user_account">
        <h4 class="account_login"><i class="fa fa-user-circle-o icon"></i>ACCOUNT LOGIN</h4>
    </div>
    
    <small>
        Only registered students and staff of GSCK can login or register.
    </small>
    <br>
    <br>
	<form class="login_form" method="POST">
		<input type="text" name="username" placeholder="Username" autocomplete="off" required />
		<input type="password" name="password" placeholder="Password" autocomplete="off" required />
		<button class="login_button" type="submit" name="button_login">LOGIN</button>

        <div class="pass">
            <small>
                <a class="forget_password" href="forgotpassword_verify.php">Forget Password?</a>
            </small>
         </div>

        <div class="accnt">
            <small class="no_account">Don't have an account?</small>
        </div>
            
        
       
        <a href="verification.php"><button class="register_button">REGISTER HERE</button></a>
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
		echo '<script type="text/javascript">alert("Student Verified");window.location.href="../student_index.php"</script>';
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
            $_SESSION["staff_id"] = $staff_id;
            $_SESSION["position"] = $position;
            $_SESSION["staff_username"] = $row["username"];
            echo '<script type="text/javascript">alert("Successfully Log in as Registrar");window.location.href="../Staff/registrar/registrar_index.php"</script>';
        }   
        else if($position == 'Accounting Staff/Scholarship Coordinator'){
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["staff_id"] = $staff_id;
            $_SESSION["position"] = $position;
            $_SESSION["staff_username"] = $row["username"];
            echo '<script type="text/javascript">alert("Successfully Log in as Accounting Staff");window.location.href="../Staff/accounting_staff/accounting_staff_index.php"</script>';
        }
        else if($position == 'Teacher'){
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["staff_id"] = $staff_id;
            $_SESSION["position"] = $position;
            $_SESSION["staff_username"] = $row["username"];
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


<style>
    .login_form {
        width: 300px;
    }
    .user_account {
        margin-bottom: 30px;
        align-items: center;
    }
    .login_form input {
        width: 300px;
        padding: 10px 2px;
        margin-bottom: 16px;
        border: none;
        border-bottom: 1px solid #324e9e;
        outline: none;
    }
    .account_login {
        text-align: center;
        color: #324e9e;
    }
    .login_button {
        width: 300px;
        border: none;
        background: #324e9e;
        color: #FBFBFB;
        padding: 10px 0;
        margin-top: 12px;
    }
    .login_button:hover {
        background: #283e7e;
    }
    .register_button {
        width: 300px;
        border: none;
        background: #FFD93D;
        padding: 10px 0;
    }
    .register_button:hover {
        background: #ffdc50;
    }
    .pass {
        text-align: center;
        margin-bottom: 20px;
        padding: 5px;
    }
    .accnt {
        text-align: center;
        padding: 5px;
    }
    .icon {
        margin-right: 10px;
    }
</style>