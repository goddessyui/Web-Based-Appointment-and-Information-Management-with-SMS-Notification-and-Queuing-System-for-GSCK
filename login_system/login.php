<?php
include_once("dbconfig.php");
?>
<div class="sign_in_form" id="sign_in">
    <div class="form_container">
       <div class="title">
           <h3>ACCOUNT LOGIN</h3>
           <button onclick="btn_cancel()"><small>Cancel</small></button>
       </div>
        <small>
            Only registered students and staff of GSCK can login or register.
        </small>
        <br>
        <br>
        <form class="login_form" method="POST">
            <div class="input_box">
                <input type="text" name="username" placeholder="Username" autocomplete="off" required />
                <div class="icon"><i class="fa fa-user"></i></div>
            </div>
            <div class="input_box">
                <input type="password" name="password" placeholder="Password" autocomplete="off" required />
                <div class="icon"><i class="fa fa-lock"></i></div>
            </div>
            <div class="option_div">
                <div class="check_box">
                    <input type="checkbox">
                    <span>Remember me?</span>
                </div>
                <div class="forget_div">
                    <a class="forget_password" href="forgotpassword_verify.php">Forget Password?</a>
                </div>
            </div>
            <div class="input_box">
                
                    <button class="login_button" type="submit" name="button_login">LOGIN</button>
                </a>
            </div>
        </form>
    </div>
</div>


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
		echo '<script type="text/javascript">alert("Student Verified");window.location.href="index.php"</script>';
    }
    else{
    echo '<script type="text/javascript">alert("Account not existing in student record");window.location.href="index.php"</script>';
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
            echo '<script type="text/javascript">alert("Successfully Log in as Registrar");window.location.href="admin.php"</script>';
        }   
        else if($position == 'Accounting Staff/Scholarship Coordinator'){
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["staff_id"] = $staff_id;
            $_SESSION["position"] = $position;
            $_SESSION["staff_username"] = $row["username"];
            echo '<script type="text/javascript">alert("Successfully Log in as Accounting Staff");window.location.href="admin.php"</script>';
        }
        else if($position == 'Teacher'){
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["staff_id"] = $staff_id;
            $_SESSION["position"] = $position;
            $_SESSION["staff_username"] = $row["username"];
            echo '<script type="text/javascript">alert("Successfully Log in as Teacher");window.location.href="admin.php"</script>';
        }
    }
        else{
    echo '<script type="text/javascript">alert("Account not existing in Staff record");window.location.href="index.php"</script>';
    }
    }
    else {
		echo '<script type="text/javascript">alert("Username or Password Incorrect");window.location.href="index.php"</script>';
}
	}

?>

<style>
    .sign_in_form {
        width: 420px;
        height: 60vh;
        position: fixed;
        top: 80px;
        right: 0;
        display: flex;
        font-family: 'montserrat';
        transform: translateX(420px);
        opacity: 0;
        transition: all 0.5s ease-in-out;
        border-top: .5px solid lightgrey;
    }
    .form_container {
        width: 365px;
        height: 55vh;
        padding: 40px;
        background: #fff;
        margin-left: 10px;
    }
    .form_container .title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 34px;
        padding-right: 5px;
        padding-bottom: 10px;
        border-bottom: 1px solid lightgrey;
    }
    .title h3 {
        font-weight: 500;
        font-size: 14px;
    }
    .title button {
        cursor: pointer;
        border: none;
        background: none;
        font-family: 'montserrat';
        font-size: 17px;
        color: #DA1212;
    }
    .title button:hover {
        color: red;
    }

    .login_form .input_box {
        height: 36px;
        width: 100%;
        position: relative;
        margin-top: 20px;
    }
    .input_box input {
        height: 100%;
        width: 100%;
        outline: none;
        font-size: 15px;
        padding-left: 45px;
        border: 1px solid lightgrey;
        transition: all .3s ease-in-out;
        font-family: 'montserrat';
    }
    .input_box input:focus {
        border-color: #324e9e;
    }
    .input_box .icon {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        color: grey;
    }
    .login_form .option_div {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
    .option_div .check_box {
        display: flex;
        align-items: center;
        padding-left: 5px;
    }
    .option_div span {
        margin-left: 5px;
        font-size: 14px;
        color: #333;
    }
    .option_div .forget_div a{
        font-size: 14px;
        color: #324e9e;
        padding-right: 5px;

    }
    .login_button {
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        border: none;
        padding: 10px 20px;
        background: #324e9e;
        height: 36px;
        width: 100%;
        cursor: pointer;
        transition: all .3s ease-in-out;
        margin-top: 16px;
        letter-spacing: 1px;
    }
    .login_button:hover {
        background: #283E7E;
    }
</style>

<script>
    function btn_login() {
        document.getElementById('sign_in').style.transform = "translateX(0)";
        document.getElementById('sign_in').style.opacity = "1";
        menuBtn.classList.remove('open');
        menuOpen = false;
        document.getElementById('nav').style.transform = "translateX(420px)";
        document.getElementById('nav').style.opacity = "0";
        document.getElementById('regcontainer').style.transform = "translateX(420px)";
        document.getElementById('regcontainer').style.opacity = "0";
    }
    function btn_cancel() {
        document.getElementById('sign_in').style.transform = "translateX(420px)";
        document.getElementById('sign_in').style.opacity = "0";
    }
</script>