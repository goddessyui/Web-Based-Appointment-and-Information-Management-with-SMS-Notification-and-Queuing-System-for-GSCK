<?php
include_once("dbconfig.php");
session_start();
$student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" && $username == "" && $position != "Accounting Staff/Scholarship Coordinator" && "Registrar" && "Teacher"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Goldenstate College of Koronadal - Admin Dashboard</title>
</head>
<body>

<div class="header">
	<div class="nav_container">
    <div class="icon_container">
			
			<button class="burger_menu" id="burger" onclick="BtnMenu()"><img src="icons/menu.png" alt="burger-menu" width="29px"></button>
			<button class="close_menu" id="close" onclick="BtnClose()"><img src="icons/close.png" alt="burger-menu" width="29px"></button>
		</div>
		<div class="school_container">
			<img class="school_logo" src="images/logo.png" alt="logo" width="50">
			<h3 class="school_name">GOLDENSTATE COLLEGE OF KORONADAL</h3>
            <img class="bell_icon" src="icons/bell.png" alt="notification-bell" width="24px">
		</div>
		
	</div>
</div>


<div class="menu" id="navigation">
	<div class="menu-container">
		<button class="btn-user-accnt">User Account</button>
		<button class="btn-log-out"><a href="logout.php">Log out</a></button>
		<nav>
			<ul>
                <li><a href="admin.php">Dashboard</li>
				<li>My Account</li>
				<li>Set My Schedule</li>
				<li>Post Announcement</li>
            <?php 
            if ($position == "Registrar"){
            ?>
                <li><a href="upload_student_records.php">Student Records</a></li>
                <li><a href="upload_staff_records.php">Staff Records</li>
                <?php
            }
            else if($position == "Accounting Staff/Scholarship Coordinator"){
                ?>
                <li>UniFAST Grantee Records</li>
                <?php
            }
                ?>
				<li><a href="staff_appointment_details.php">My Appointments</a></li>
                <li>Reports</li>
			</ul>
		</nav>
	
	</div>
</div>
<script>

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
<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}
  
	body {
		max-width: 1632px;
	}

    main {
        padding-top: 150px;
        padding-left: 500px;
        z-index: 998;
        
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
		background-color: orange;
	}
	.school_container,
	.icon_container {
		display: flex;
		align-items: center;
	}
	.icon_container {
		border: none;
		padding: 7px 20px;
		font-family: 'montserrat';
		background: #324e9e;
		color: #FBFBFB;
	}
	
	.school_logo {
		margin-right: 10px;
	}
	.bell_icon {
		margin-left: 15px;
	}
	.school_name {
		color: #324e9e;
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
		left: 0;
		padding-top: 80px;
		
		display: none;
		
	}
	.menu-container {
		width: 380px;
		position: absolute;
		left: 0;
		background: #324e9e;
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
		color: #fff;
		padding: 12px 0;
		font-size: 15px;
		padding-left: 40px;
		text-transform: uppercase;
	}
	.menu nav ul li:hover {
		background: #fff;
		color: #324e9e;
	}
	.btn-user-accnt {
		border: none;
		outline: none;
		padding: 7px 18px;
		border: 2px solid #fff;
		color: #fff;
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

	button {
		font-family: 'montserrat';
		cursor: pointer;
	}
 

</style>