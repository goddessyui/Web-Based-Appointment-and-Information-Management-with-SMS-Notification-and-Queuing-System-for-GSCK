<?php
    include_once("dbconfig.php");
        session_start();
        $student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
        $student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
        $staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
        $position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
        $staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

    if ($staff_id == ""){
        echo '<script type="text/javascript">window.location.href="index.php"</script>';
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="image/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="jquery_offline.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GSCK Appointment Portal</title>
</head>
<body>

<div class="main_header">
    <div class="navbar_panel">
        <div class="admin_container">

            <div class="admin_icon">
                <img src="icon/white/user_white.svg" alt="" width="25">
            </div>

            <div class="admin_name">
                <?php
                    $admin = "SELECT * FROM tbl_staff_registry where username = '$staff_username'";
                    $admin_query = mysqli_query($db, $admin);

                    while ($AdminRow = mysqli_fetch_assoc($admin_query)) {
                        ?><h3><?php echo $AdminRow['first_name']." ".$AdminRow['last_name']; ?></h3>
                        <p><?php echo $AdminRow['position']; ?></p><?php
                    }
                ?>
            </div>
         
        </div>
        <nav>
        <ul>
            <a href="admin.php">
                <li>
                    <img src="icon/white/dashboard_white.svg" alt="" width="25">
                    <span>Dashboard</span>
                </li>
            </a>


            <a  href="schedule_admin.php">
                <li>
                    <img src="icon/white/appointment_white.svg" alt="" width="25">
                    <span>Set my schedule</span>
                </li>
            </a>

            <a href="announcement_admin.php">
                <li>
                    <img src="icon/white/announcement_white.svg" alt="" width="25">
                    <span>Announcement</span>
                </li>
            </a>

			<?php 
				if ($position == "Registrar") {
			?>

            <a href="upload_student_records.php">
                <li>
                    <img src="icon/white/record_white.svg" alt="" width="25">
                    <span>Student Records</span>
                </li>
            </a>

            <a href="upload_staff_records.php">
                <li>
                    <img src="icon/white/record_white.svg" alt="" width="25">
                    <span>Staff Records</span>
                </li>
            </a>
            

            <a href="staff_accepted_requests.php">
                <li>
                    <img src="icon/white/schedule_white.svg" alt="" width="25">
                    <span>My Appointments</span>
                </li>
            </a>
				
			<?php
            	}
            	else if($position == "Accounting Staff/Scholarship Coordinator") {
            ?>
				
            <a href="upload_unifast_grantee.php">
                <li>
                    <img src="icon/white/record_white.svg" alt="" width="25">
                    <span>Grantee Records</span>
                </li>
            </a>

            <a>
                <li href="claimcheque_pendingapp.php">
                    <img src="icon/white/schedule_white.svg" alt="" width="25">
                    <span>Claim Cheque</span>
                </li>
            </a>

            <a href="submitdocu_pendingapp.php">
                <li>
                    <img src="icon/white/schedule_white.svg" alt="" width="25">
                    <span>Submit Documents</span>
                </li>
            </a>

            <a href="staff_accepted_requests.php">
                <li>
                    <img src="icon/white/schedule_white.svg" alt="" width="25">
                    <span>My Appointments</span>
                </li>
            </a>

			<?php
            	}
				else if($position == "Teacher") {
            ?>
				<a href="staff_accepted_requests.php">
					<li>
                        <img src="icon/white/schedule_white.svg" alt="" width="25">
						<span>My Appointments</span>
					</li>
				</a>

			<?php

			}
            
			?>		

                <a href="staff_accepted_requests.php">
                    <li>
                        <img src="icon/white/schedule_white.svg" alt="" width="25">
                        <span>Records</span>
                    </li>
                </a>

                <a href="staff_profile.php">
                    <li>
                        <img src="icon/white/user_white.svg" alt="" width="25">
                        <span>Account</span>
                    </li>
                </a>	

			</ul>
        </nav>
    </div>

    <div class="content_panel">
        <div class="header">

            <div class="menu_container">
                <p><?php echo $staff_id; ?></p>
            </div>

            <div class="title_container">
                <div class="title_text">
                    <h3>Goldenstate College of Koronadal</h3>
                    <p>Appointment System Portal</p>
                </div>
            </div>

            <div class="notif_container">

                <div class="dropdown-toggle" data-toggle="dropdown">
                    <button onclick="BtnDropdown()" class="btn_no_bg">
                        <i class="fa fa-bell-o"><p class="count" id="count_red" style="text-decoration: none; color: #fff;"></p></i>
                    </button>
                    <div class="dropdown-menu" id="dropdown_id"></div>
                </div>

                <button class="btn_logout_admin"><a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></button>
            </div>

        </div>

        <main></main>
    </div>
</div>





<div class="mobile_header"></div>

</body>
</html>





<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap');

    body {
        overflow: hidden;
    }
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        list-style-type: none;
        font-family: 'Open Sans', sans-serif;
        font-family: 'Quicksand', sans-serif;
    }
    /* width */
        ::-webkit-scrollbar {
        width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #2D303A;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555;
        }
    .main_header {
        width: 100%;
        height: 100vh;
        display: flex;
        position: flex;
        top: 0;
    }
    .main_header .navbar_panel {
        width: 20vw;
        height: 100vh;
    }
    .navbar_panel .admin_container {
        width: 20vw;
        height: 10vh;
        background: #424F59;
        display: flex;
        align-items: center;
        padding-left: 2.5vw;
    }
    .admin_icon {
        margin-right: 16px;
    }
    .admin_name h3 {
        color: #eee;
        font-size: 20px;
    }
    .admin_name p {
        font-size: 14px;
        color: #BBBBBD;
    }


    .navbar_panel nav {
        background: #2D303A;
        height: 90vh;
        width: 20vw;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .navbar_panel nav ul {
        width: 20vw;
        padding-top: 5vh;
    }
    .navbar_panel nav ul a {
        text-decoration: none;
        color: #BBBBBD;
        font-family: 'Quicksand', sans-serif;
        font-size: 16px;
        text-transform: capitalize;
    }
    .navbar_panel nav ul li {
        width: 20vw;
        height: 52px;
        display: flex;
        align-items: center;
        padding-left: 2.5vw;
    }
    .navbar_panel nav ul li:hover {
        background: #424F59;
    }
    .navbar_panel nav ul li img {
        opacity: .8;
        margin-right: 16px;
    }

    .main_header .content_panel {
        width: 80vw;
        height: 100vh;
        background: teal;
    }
    .header {
        width: 100%;
        height: 10vh;
        background: #FFFEFE;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .menu_container,
    .title_container,
    .notif_container {
        height: 10vh;
    }
    .menu_container,
    .notif_container {
        width: 20vw;
    }
    .notif_container {
        display: flex;
        align-items: center;
        justify-content: right;
        padding-right: 25px;
    }
    .notif_container  .btn_logout_admin {
        background: #2D303A;
        margin-left: 12px;
        border: none;
        padding: 4px 10px;
        font-size: 12px;
    }
    .notif_container  .btn_logout_admin:hover {
        background: #424F59;
    }
    .notif_container a {
        color: #eee;
        text-decoration: none;
    }
    .fa.fa-bell-o {
        font-size: 18px;
        cursor: pointer;
        transform: translateY(1.5px);
    }
    .btn_no_bg {
		border: none;
		background: none;
	}

    .fa.fa-bell-o:hover {
        animation-name: bell_icon;
        animation-duration: .5s;
        animation-iteration-count: 3;
    }
    @keyframes bell_icon {
        0% {
            transform: rotate(-10deg) translateY(2px);
        }
        50% {
            transform: rotate(10deg) translateY(2px);
        }
        100% {
            transform: rotate(-10deg) translateY(2px);
        }
    }


    .menu_container {
        padding-left: 15px;
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .title_container {
        width: 80vw;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .title_container .title_text h3 {
        text-transform: uppercase;
        font-family: 'Roboto';
        color: #333;
    }
    .title_container p {
        font-size: 14px;
        text-align: center;
    }
    main {
        width: 100%;
        height: 90vh;
        background: #F1F3F6;
        overflow-y: scroll;
    }
    .mobile_header {
        width: 100%;
        height: 100vh;
        background: gold;
        display: none;
    }

    @media only screen and (max-width: 600px) {
        .main_header {
            display: none;
        }
        .mobile_header {
            display: block;
        }
    }
</style>