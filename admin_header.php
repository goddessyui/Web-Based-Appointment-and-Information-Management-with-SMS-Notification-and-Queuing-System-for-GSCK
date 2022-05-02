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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/admin_style.css">
    <title>Goldenstate College of Koronadal - Admin Dashboard</title>
</head>
<body>

	<input type="checkbox" id="nav-toggle">

	<div class="sidebar">
		<div class="sidebar_brand">
	</div>

		<div class="sidebar_menu">
			<ul>
				<li>
					<img src="icon/gold/artboard_gold.svg" alt="">
					<a href="admin.php">
						<span>Dashboard</span>
					</a>
				</li>

				<li>
					<img src="icon/gold/account_gold.svg" alt="">
					<a href="staff_profile.php">
						<span>Account</span>
					</a>
				</li>

				<li>
					<img src="icon/gold/schedule_gold.svg" alt="">
					<a href="schedule_admin.php">
						<span>Set my schedule</span>
					</a>
				</li>

				<li>
					<img src="icon/gold/anouncement_gold.svg" alt="">
					<a href="announcement_admin.php">
						<span>Announcement</span>
					</a>
				</li>
			<?php 
				if ($position == "Registrar"){
			?>
				<li>
					<img src="icon/gold/record_gold.svg">
					<button class="dropdown_btn"><span class="navname">Records</span><i class="fa fa-caret-down"></i></button>
					
					<div class="dropdown_container">
						<a href="upload_student_records.php">Student</a>
						<a href="upload_staff_records.php">Staff</a>
					</div>
				</li>

				<li>
					<img src="icon/gold/appointment_gold.svg">
					<span><button class="dropdown_btn">
						<span class="navname">Appointments</span><i class="fa fa-caret-down"></i></button>
					<div class="dropdown_container">
						<a href="staff_accepted_requests.php">Active </a>
						<a href="staff_pending_requests.php">Pending </a>
						<a href="staff_missed_requests.php">Missed </a>
						<a href="staff_declined_requests.php">Declined </a>
						<a href="staff_cancelled_requests.php">Cancelled </a>
						<a href="staff_done_requests.php">Past </a>
					</div>
					</span>
					
				</li>
				
			<?php
            	}
            	else if($position == "Accounting Staff/Scholarship Coordinator"){
            ?>

				<li>
					<button class="dropdown_btn">
						<img src="icon/gold/record_gold.svg">
						<span class="navname">UniFAST</span>
						<i class="fa fa-caret-down"></i>
					</button>

					<div class="dropdown_container">
						<a href="upload_unifast_grantee.php">Grantee Records</a>
						<a href="claimcheque_pendingapp.php">Claim Cheque</a>
						<a href="submitdocu_pendingapp.php">Submit Documents</a>
					</div>
				</li>

				<li>
					<button class="dropdown_btn">
						<img src="icon/gold/appointment_gold.svg" alt="">
						<span class="navname">My Appointments</span><i class="fa fa-caret-down"></i>
					</button>

					<div class="dropdown_container">
						<a href="staff_accepted_requests.php">Active </a>
						<a href="staff_pending_requests.php">Pending </a>
						<a href="staff_missed_requests.php">Missed </a>
						<a href="staff_declined_requests.php">Declined </a>
						<a href="staff_cancelled_requests.php">Cancelled </a>
						<a href="staff_done_requests.php">Past </a>
					</div>
				</li>
			<?php
            	}
				else if($position == "Teacher"){
            ?>

				<li>
					<span><button class="dropdown_btn"><span class="fa fa-calendar"></span><span class="navname">My Appointments</span><i class="fa fa-caret-down"></i></button>
					<div class="dropdown_container">
						<a href="staff_accepted_requests.php">Active </a>
						<a href="staff_pending_requests.php">Pending </a>
						<a href="staff_missed_requests.php">Missed </a>
						<a href="staff_declined_requests.php">Declined </a>
						<a href="staff_cancelled_requests.php">Cancelled </a>
						<a href="staff_done_requests.php">Past </a>
					</div>
					</span>
				</li>
				<?php
			}
			?>			

			</ul>
		</div>
	</div>

	<div class="main-content">
		<header>
				<div class="menu_admin">
					<label for="nav-toggle">
						<span>
							<img src="icon/menu_btn.png" width="26">
						</span>
					</label>
				</div>

				<div>
					<h4>GOLDENSTATE COLLEGE OF KORONADAL</h4>
				</div>

				<div class="user_wrapper">
					<span class="fa fa-user-circle"></span>
					<small>
						<?php
							echo $staff_username;
						?>
					</small>
					<button class="btn_logout_admin"><a href="#"><i class="fa fa-sign-out"></i> LOGOUT</a></button>

					<!-- NOTIFICATION BUTTON -->
					<div class="dropdown-toggle" data-toggle="dropdown">
						<button onclick="BtnDropdown()" class="btn_no_bg">
							<i class="fa fa-bell-o"><p class="count" id="count_red" style="text-decoration: none; color: #fff;"></p></i>
						</button>
						<div class="dropdown-menu" id="dropdown_id"></div>
					</div>
       <!-- NOTIFICATION BUTTON -->
				</div>
		</header>



<style>

    :root {
	--blue: #324e9e;
	--darkerblue: #2d468e;
	--red: #ec3237;
	--yellow: #fcd228;
	--text-grey: #555;
	--gold: #fec843;
	--orange: #fda237;
}

* {
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	list-style-type: none;
	text-decoration: none;
	font-family: roboto;
}

.sidebar {
	width: 300px;
	position: fixed;
	top: 0;
	left: 0;
	height: 100%;
	background: #333;
	z-index: 888;
	transition: width 300ms;
	border-right: 1px solid lightgrey;
}
.sidebar_brand {
	height: 60px;
	display: flex;
	justify-content: center;
	text-align: center;
	background-color: #333;

}
.sidebar_brand span {
	display: inline-block;
	padding-right: 1rem;
}
.sidebar_menu {
	margin-top: 20px;
}
.sidebar_menu li{
	width: 100%;
	margin-bottom: 20px;
	display: flex;
	align-items: center;
	text-transform: uppercase;
	margin-left: 20px;
}
.sidebar_menu li img {
	margin-right: 12px;
	border-radius: 50%;
	padding: 2px;
	width: 30px;
	height: 30px;
	border: 1px solid #FEA621;
}

.sidebar_menu li a,
.sidebar_menu li .dropdown_btn {
	color: #FEA621;
	font-size: 18px;
	text-decoration: none;
	display: block;
	border: none;
  	background: none;
	cursor: pointer;
	outline: none;
	width: 100%;
	text-transform: uppercase;
}

.sidebar_menu li .dropdown_btn .navname{
	padding-left: 5px;
}
/* Style the sidenav links and the dropdown button */

.sidebar_menu li .dropdown_btn {
	text-align: left;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.sidebar_menu li .dropdown_container {
	background: #fff;
	width: 300px;
	padding: 20px;
	top: 0;
}

/* Optional: Style the caret down icon */
.sidebar_menu .fa-caret-down {
	margin-left: 12px;
}

#nav-toggle:checked + .sidebar {
	width: 70px;
}

#nav-toggle:checked + .sidebar .sidebar_brand h2 span,
#nav-toggle:checked + .sidebar li a,
#nav-toggle:checked + .sidebar li span
{
	padding-left: 1rem;
	padding-right: 1rem;
}
#nav-toggle:checked + .sidebar li i{
	padding-right: 1.6rem;
}

#nav-toggle:checked + .sidebar .sidebar_brand h2 span:last-child,
#nav-toggle:checked + .sidebar li a span:last-child,
#nav-toggle:checked + .sidebar li .dropdown_btn .navname
 {
	display: none;
}
#nav-toggle:checked ~ .main-content {
	margin-left: 70px;
}
#nav-toggle:checked ~ .main-content header{
	width: calc(100% - 70px);
	left: 70px;
	

}

.main-content {
	transition: margin-left 300ms;
	margin-left: 300px;
}

header {
	background: #fff;
	display: flex;
	align-items: center;
	justify-content: space-between;
	position: fixed;
	left: 300px;
	width: calc(100% - 300px);
	top: 0;
	z-index: 999;
	transition: left 300ms;
	height: 60px;
	padding-left: 15px;
	border-bottom: 1px solid lightgrey;
}

#nav-toggle {
	display: none;
}

.user_wrapper {
	display: flex;
	align-items: center;
	margin-right: 20px;
}
.user_wrapper small {
	margin-right: 12px;
	margin-left: 2px;
}

.user_wrapper  .btn_logout_admin{
	background: #333;
	margin-right: 12px;
	border: none;
	padding: 4px 10px;
	font-size: 12px;
}
.user_wrapper a {
	color: gold;
	font-weight: 500;
}




/* notification */

.fa.fa-bell-o {
        font-size: 18px;

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
 
    .dropdown-menu {
        width: 300px;
        height: 100vh;
        position: fixed;
        top: 60px;
        right: 0;
        list-style-type: none;
        box-sizing: border-box;
        padding: 20px 40px;
        padding-top: 30px;
        opacity: 0;
        transform: translateX(55vh);
        transition: all .5s ease-in-out;
        background: pink;
    }
 
    /* width */
    ::-webkit-scrollbar {
    width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    background: #fff; 
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #eee; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: grey; 
    }

    .notif_container {
        padding: 10px;
        border-bottom: 1px solid lightgrey;
        transition: all .3s ease-in-out;
    }
  
    .notif_container:last-child {
        border: none;
    }

    .notif_container a {
        text-decoration: none;
        color: #333;
    }
    .notif_container a:visited {
        color: grey;
    }
    .notif_container .notif_title {
        margin-bottom: 5px;
        font-size: 13px;
    }

    .notif_container small {
        font-size: 12px;
    }
    .count {
        height: 14px;
        width: 14px;
        font-size: 9px;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: -4px;
        right: -5px;
    }
	.btn_no_bg {
		border: none;
		background: none;
	}

/*----form-div----*/

    .form_div {
        width: 100%;
        height: 60vh;
        background: green;
    }

</style>


<!-- notification script -->

<script>

function BtnDropdown() {

var x = document.getElementById("dropdown_id");

	if (x.style.opacity === "1") {
		x.style.opacity = "0";
		x.style.transform = "translateX(55vh)";

	} 
	else {
		x.style.opacity = "1";
		x.style.transform = "translateX(0)";
		menuBtn.classList.remove('open');
		menuOpen = false;
		document.getElementById('open_nav_container').style.transform = "translateX(-380px)";

	}
}




$(document).ready(function(){
 var id = '<?php echo $_SESSION["staff_id"]; ?>'
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch_notification_admin.php",
   method:"POST",
   data:{view:view, id:id},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});

//-------Dropdown toggle

//* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown_btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

//-------Dropdown toggle

</script>

