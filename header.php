<?php
session_start();
$student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
if ($staff_id != "" && $staff_username != ""){
    if ($position == "Registrar && "){
        echo '<script type="text/javascript">window.location.href="admin.php"</script>';
    }
    else if ($position == "Accounting Staff/Scholarship Coordinator"){
        echo '<script type="text/javascript">window.location.href="admin.php"</script>';
    }
    else if ($position == "Teacher"){
        echo '<script type="text/javascript">window.location.href="admin.php"</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Goldenstate College of Koronadal - Student Portal</title>
</head>
<body>

<div class="header">
	<div class="nav_container">
		<div class="school_container">
			<img class="school_logo" src="images/logo.png" alt="logo" width="50">
			<h3 class="school_name">GOLDENSTATE COLLEGE OF KORONADAL</h3>
		</div>
		<div class="icon_container">
			<button class="btn_signin" onclick="BtnLogin()">LOG IN</button>
			<img class="bell_icon" src="icons/bell.png" alt="notification-bell" width="24px">
			<button class="burger_menu" id="burger" onclick="BtnMenu()"><img src="icons/menu.png" alt="burger-menu" width="29px"></button>
			<button class="close_menu" id="close" onclick="BtnClose()"><img src="icons/close.png" alt="burger-menu" width="29px"></button>
		</div>
	</div>
</div>

<div class="sign_in_form" id="sign-in">
	<div class="form_container">
	<small class="btn_close_login" onclick="Btn_close()">CANCEL</small>
		<?php
			include('login_system/login.php');
		?>
	</div>
</div>

<div class="menu" id="navigation">
	<div class="menu-container">
		<button class="btn-user-accnt">User Account</button>
		<button class="btn-log-out">Log out</button>
		<nav>
			<ul>
				<li>Home</li>
				<li>About</li>
				<li>Schedule</li>
				<li><a href="announcement.php">Announcement</a></li>
				<li>Contact</li>
				<li><a >My Appointments</a> </li>
			</ul>
		</nav>
		<button class="btn_set_appointment"><a href="student_appointment.php">Set an Appointment</a></button>
	</div>
</div>


<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}
	body {
		max-width: 1632px;
	}
	h1, h2, h3, h4, h5 {
		font-family: 'Montserrat';
		color: #202020;
	}
	p, small {
		font-family: 'poppins';
	}
	.header {
		width: 100%;
		height: 80px;
		position: fixed;
		top: 0;
		background: #fff;
		z-index: 999;
	}
	.nav_container {
		width: 90%;
		height: 80px;
		margin: 0 auto;
		display: flex;
		justify-content: space-between;
	}
	.school_container,
	.icon_container {
		display: flex;
		align-items: center;
	}
	.icon_container .btn_signin {
		border: none;
		padding: 7px 20px;
		font-family: 'montserrat';
		background: #324e9e;
		color: #FBFBFB;
	}
	.btn_signin:hover {
		background: #283e7e;
	}
	.school_logo {
		margin-right: 10px;
	}
	.btn_signin,
	.bell_icon {
		margin-right: 15px;
	}
	.school_name {
		color: #324e9e;
	}
	.sign_in_form {
		width: 100%;
		height: 100vh;
		position: fixed;
		background: #0005;
		z-index: 888;
		display: none;
	}
	.form_container {
		width: 380px;
		position: relative;
		margin: 0 auto;
		top: 50%;
		transform: translateY(-50%);
		background: white;
		padding: 40px;
		padding-bottom: 50px;
		box-shadow: 0 0 1px #0001;
	}
	.burger_menu {
		border: none;
		background: none;
	}
	.close_menu {
		border: none;
		background: none;
		display: none;
	}

	.menu {
		width: 100%;
		height: 100vh;
		position: fixed;
		right: 0;
		padding-top: 80px;
		background: #0005;
		display: none;
		
	}
	.menu-container {
		width: 380px;
		position: absolute;
		right: 0;
		background: #fff;
		padding: 60px 0;
		height: 100vh;

	}

	.menu nav {
		margin-top: 20px;
	}
	.menu nav ul {
		padding-top: 20px;
	}
	.menu nav ul li {
		list-style-type: none;
		font-family: 'Montserrat';
		color: #324e9e;
		padding: 12px 0;
		font-size: 15px;
		padding-left: 40px;
		text-transform: uppercase;
	}
	.menu nav ul li:hover {
		background: #324e9e;
		color: #fff;
	}
	.btn-user-accnt {
		border: none;
		outline: none;
		padding: 7px 18px;
		border: 2px solid #324e9e;
		color: #324e9e;
		font-weight: 600;
		background: none;
		margin-left: 40px;
		margin-right: 12px;
	}
	.btn-log-out {
		border: none;
		outline: none;
		padding: 8px 20px;
		background: #FFD93D;
	}
	.btn-log-out:hover {
        background: #ffdc50;
    }
	.btn_close_login {
		position: absolute;
		top: 8px;
		right: 10px;
		cursor: pointer;
	}
	.btn_close_login:hover {
		color: red;
	}
	.btn_set_appointment {
		border: none;
		padding: 8px 16px;
		margin-left: 40px;
		margin-top: 20px;
		background: #324e9e;
		color: #fff;
		font-size: 15px;
	}
	.btn_set_appointment:hover {
		background: #283e7e;
	}
	button {
		font-family: 'montserrat';
		cursor: pointer;
	}
</style>
 
<script>
	function BtnLogin() {
		document.getElementById('sign-in').style.display = "block";
	}
	function Btn_close() {
		document.getElementById('sign-in').style.display = "none";
	}
	function BtnMenu() {
		document.getElementById('navigation').style.display = "block";
		document.getElementById('burger').style.display = "none";
		document.getElementById('close').style.display = "block";
	}
	function BtnClose() {
		document.getElementById('navigation').style.display = "none";
		document.getElementById('burger').style.display = "block";
		document.getElementById('close').style.display = "none";
	}
</script>

