<?php
    include_once("dbconfig.php");
    session_start();
    $student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
    $student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
    $staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
    $position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
    $staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
    if ($staff_id != "" && $staff_username != ""){
        if ($position == "Registrar" OR "Accounting Staff/Scholarship Coordinator" OR "Teacher"){
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Web-base Appointment & Information System</title>
</head>
<body>
<div class="header">
    <div class="school-title">
        <img src="image/logo.png" alt="gsck-logo" width="50px">
    <h3>GOLDENSTATE COLLEGE OF KORONADAL</h3>
    </div>

    <div class="menu-bar">
<?php 
	if(isset($_SESSION['student_id'])) {

        $student_id = $_SESSION['student_id'];
        $fnln="SELECT * FROM tbl_student_registry WHERE student_id = '$student_id'";
        $name= mysqli_query($db, $fnln);
        $rows=mysqli_fetch_assoc($name);

        ?>
            <small class="student_id"><i class="fa fa-id-card" aria-hidden="true"></i><?php echo $rows['student_id']; ?></small>
        <?php
		}

		else {
?>
		<button onclick="btn_login()">LOGIN</button>
        <button onclick="open_register()">REGISTER</button>
<?php		
		}
?>		
        <i class="fa fa-bell"></i>
        <div class="menu-btn">
            <div class="menu-btn-burger"></div>
        </div>
    </div>
</div>


<?php
    include('login_system/login.php');
?>


<div class="nav_container" id="nav">
<nav>
    <ul>
        <?php
            if(!empty($_SESSION['student_id'])) {

                $student_id = $_SESSION['student_id'];
                $fnln="SELECT first_name, last_name FROM tbl_student_registry WHERE student_id = '$student_id'";
                $name= mysqli_query($db, $fnln);
                $rows=mysqli_fetch_assoc($name);
                
    ?>
                <div class="session_name">
                    <?php echo $rows['first_name'] . " " . $rows['last_name'] ; ?>
                </div>
    
    
    <?php
                ?>
                    <button class="account"><i class="fa fa-user"></i>PROFILE</button>
                    <a href="logout.php"><button class="logout">LOGOUT</button></a>
                    <a href="index.php"><li><i class="fa fa-home" aria-hidden="true"></i> Home</li></a>
                    <a href="about.php"><li><i class="fa fa-question-circle" aria-hidden="true"></i>About</li></a>
                <?php
            }
            else {
                ?>
                    <a href="index.php"><li><i class="fa fa-home" aria-hidden="true"></i> Home</li></a>
                    <a href="about.php"><li><i class="fa fa-question-circle" aria-hidden="true"></i> About</li></a>
                <?php
            }
        ?>
       
<?php 
	if(isset($_SESSION['student_id'])){
?>
        <a href="student_appointment_details.php"><li><i class="fa fa-home"></i> My Appointment</li></a>
<?php
		}
		?>
        <a href="announcements.php"><li><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcement</li></a>
        <a href="contact.php"><li><i class="fa fa-phone-square" aria-hidden="true"></i> Contact</li></a>
        <a href="schedule.php"><li><i class="fa fa-calendar" aria-hidden="true"></i> Schedule</li></a>
<?php 
	if(isset($_SESSION['student_id'])){
?>
        <a href="student_appointment.php"><button class="set-appoint">SET AN APPOINTMENT</button></a>
<?php
		}
		?>
    </ul>
</nav>
</div>

<div class="reg_container" id="regcontainer">
    <div class="register_div">
        <div class="content">
            <h4>Register as : </h4>
            <button class="reg_btn_cancel" onclick="regbtnCancel()">Cancel</button>
        </div>
        <div class="content">
            <button class="reg_btn_choice">Student</button>
            <h4>or</h4>
            <button class="reg_btn_choice">Teacher</button>
        </div>
    </div>
</div>


<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.header {
    width: 100%;
    height: 80px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 5%;
    position: fixed;
    z-index: 999;
    top: 0;
    background: #fff;
}
.menu-bar {
    display: flex;
    align-items: center;
}

.school-title {
    display: flex;
    align-items: center;
    justify-content: left;
    width: 70%;
}
.school-title h3 {
    letter-spacing: 1px;
    color: #324e9e;
}
.school-title img {
    margin-right: 10px;
}

/*-----.menu-bar-----*/

.menu-btn {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    cursor: pointer;
    transition: all .5s ease-in-out;
    margin-left: 5px;
    transform: translateX(5px);
}
.menu-btn-burger {
    width: 22px;
    height: 2px;
    background: #324e9e;
    transition: all .5s ease-in-out;
}
.menu-btn-burger::before,
.menu-btn-burger::after {
    content: '';
    position: absolute;
    width: 22px;
    height: 2px;
    background: #324e9e;
    transition: all .5s ease-in-out;
}
.menu-btn-burger::before {
    transform: translateY(-8px);
}
.menu-btn-burger::after {
    transform: translateY(8px);
}

/*-----Animation-----*/

.menu-btn.open .menu-btn-burger {
    background: transparent;
}
.menu-btn.open .menu-btn-burger::before {
    height: 1px;
    transform: rotate(45deg);
}
.menu-btn.open .menu-btn-burger::after {
    height: 1px;
    transform: rotate(-45deg);
}

.menu-bar button {
    padding: 5px 12px;
    background: transparent;
    color: #324e9e;
    border: 2px solid #324e9e;
    transition: all .2s ease-in-out;
    margin-right: 20px;
    font-weight: 600;
    font-size: 11px;
    letter-spacing: 1px;
}
.menu-bar button:hover {
    transform: scale(1.02);
    cursor: pointer;
}
.menu-bar button:nth-child(1) {
    background: #324e9e;
    color: #fff;
}

/*-----end of header---*/

.nav_container {
    width: 420px;
    position: fixed;
    right: 0;
    top: 80px;
    transform: translateX(420px);
    opacity: 0;
    transition: all 0.5s ease-in-out;
    border-top: .5px solid lightgrey;
}
.nav_container nav {
    width: 365px;
    padding: 40px;
    background: #fff;
    margin-left: 10px;
}
nav ul {
    width: 380px;
}
nav ul a {
    text-decoration: none;
    color: #000;
}
nav ul .fa {
    margin-right: 10px;
}
nav ul a li {
    list-style-type: none;
    padding: 12px 0;
}
nav ul li {
    transition: all .1s ease-in-out;
}
nav ul li:hover {
    color: #324e9e;
    font-weight: bold;
    letter-spacing: .5px;
}
nav ul button {
    border: none;
    padding: 8px 16px;
    font-weight: 500;
}
.account {
    background: none;
    border: 1px solid #000;
}
.logout {
    margin-bottom: 20px;
    margin-top: 20px;
    margin-left: 10px;
    border: 1px solid #000;
    background: none;
}
.set-appoint {
    margin-top: 20px;
    padding: 10px 20px;
    background: #324e9e;
    color: #fff;
}

.reg_container {
    width: 420px;
    position: fixed;
    right: 0;
    top: 80px;
    opacity: 0.9;
    transform: translateX(420px);
    opacity: 0;
    transition: all 0.4s ease-in-out;
    border-top: .5px solid lightgrey;
}
.register_div {
    width: 365px;
    padding: 0 40px;
    background: #fff;
    padding-top: 40px;
    padding-bottom: 15px;
    margin-left: 10px;
}
.content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}
.content:nth-child(1) {
    border-bottom: 1px solid lightgrey;
    padding-bottom: 10px;
}

.reg_btn_cancel {
    margin-right: 5px;
    border: none;
    background: transparent;
    font-size: 14px;
    color: #DA1212;
    transition: all 0.3s ease-in-out;
}
.reg_btn_cancel:hover {
    color: red;
}
.content h4 {
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 500;
}
.content .reg_btn_choice {
    border: none;
    background: #324e9e;
    color: #fff;
    padding: 7px 22px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 13px;
}
.reg_btn_choice:hover {
    background: #283E7E;
}
.session_name {
    text-transform: uppercase;
    font-weight: 500;
    font-size: 14px;
    border-bottom: 1px solid lightgrey;
    padding-bottom: 15px;
}
.fa.fa-bell {
    font-size: 20px;
    color: #324e9e;
}
.student_id {
    margin-right: 20px;
    color: #324e9e;
}
.fa.fa-id-card {
    margin-right: 10px;
}


</style>



<script>

    const menuBtn = document.querySelector('.menu-btn');
    let menuOpen = false;

    menuBtn.addEventListener('click', () => {
        if(!menuOpen) {
            menuBtn.classList.add('open');
            menuOpen = true;
            document.getElementById('nav').style.transform = "translateX(0)";
            document.getElementById('nav').style.opacity = "1";
            document.getElementById('sign_in').style.transform = "translateX(420px)";
            document.getElementById('sign_in').style.opacity = "0";
            document.getElementById('regcontainer').style.transform = "translateX(420px)";
            document.getElementById('regcontainer').style.opacity = "0";
        }
        else {
            menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('nav').style.transform = "translateX(420px)";
            document.getElementById('nav').style.opacity = "0";
        }
    });

    function regbtnCancel() {
        document.getElementById('regcontainer').style.transform = "translateX(420px)";
        document.getElementById('regcontainer').style.opacity = "0";
    }
    function open_register() {
        document.getElementById('regcontainer').style.transform = "translateX(0)";
        document.getElementById('regcontainer').style.opacity = "1";
        document.getElementById('nav').style.transform = "translateX(420px)";
        document.getElementById('nav').style.opacity = "0";
        document.getElementById('sign_in').style.transform = "translateX(420px)";
        document.getElementById('sign_in').style.opacity = "0";
        menuBtn.classList.remove('open');
        menuOpen = false;
    }
</script>
