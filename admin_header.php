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
	
	
	 <!-- This css is only an example for the notifcation style -->
	
    <title>Goldenstate College of Koronadal - Admin Dashboard</title>
</head>
<body>

	<input type="checkbox" id="nav-toggle">
	<div class="sidebar">
		<div class="sidebar_brand">
			<h1><img class="school_logo" src="image/logo.png" alt="logo" width="50"></h1>
		</div>

		<div class="sidebar_menu">
			<ul>
				<li>
					<a href="admin.php">
						<span class="fa fa-home"></span>
						<span>Dashboard</span>
					</a>
				</li>

				<li>
					<a href="staff_profile.php">
						<span class="fa fa-user-circle"></span>
						<span>Account</span>
					</a>
				</li>

				<li>
					<a href="schedule_admin.php">
						<span class="fa fa-calendar-plus-o"></span>
						<span>Set my schedule</span>
					</a>
				</li>

				<li>
					<a href="announcement_admin.php">
						<span class="fa fa-bullhorn"></span>
						<span>Announcement</span>
					</a>
				</li>
			<?php 
				if ($position == "Registrar"){
			?>
				<li>
					
					<button class="dropdown_btn"><span class="fa fa-book"></span><span class="navname">Records</span><i class="fa fa-caret-down"></i></button>
					<div class="dropdown_container">
						<a href="upload_student_records.php">Student</a>
						<a href="upload_staff_records.php">Staff</a>
					</div>
				</li>

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
            	else if($position == "Accounting Staff/Scholarship Coordinator"){
            ?>

				<li>
					
					<button class="dropdown_btn"><span class="fa fa-book"></span><span class="navname">UniFAST</span><i class="fa fa-caret-down"></i></button>
					<div class="dropdown_container">
						<a href="upload_unifast_grantee.php">Grantee Records</a>
						<a href="claimcheque_pendingapp.php">Claim Cheque</a>
						<a href="submitdocu_pendingapp.php">Submit Documents</a>
					</div>
					
				</li>
				<li>
					
					<button class="dropdown_btn"><span class="fa fa-calendar"></span><span class="navname">My Appointments</span><i class="fa fa-caret-down"></i></button>
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

				<li>
					<a href="logout.php">
						<span class="fa fa-sign-out"></span>
						<span>Logout</span>
					</a>
				</li>
			

			</ul>
		</div>
	</div>

	<div class="main-content">
		<header>
				<h2>
					<label for="nav-toggle">
						<span class="fa fa-bars"></span>
					</label>
				</h2>
				<div class="user_wrapper">
					<span class="fa fa-user"></span>
					<small><?php echo $staff_username;?></small>
					<!-- NOTIFICATION BUTTON -->
					<div class="dropdown-toggle" data-toggle="dropdown">
						<button onclick="BtnDropdown()">
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
	font-family: 'Poppins', sans-serif;
}

.sidebar {
	width: 300px;
	position: fixed;
	top: 0;
	left: 0;
	height: 100%;
	background: var(--blue);
	z-index: 100;
	transition: width 300ms;
}
.sidebar_brand {
	height: 90px;
	text-align: center;
	line-height: 90px;
	background-color: white;
}
.sidebar_brand span {
	display: inline-block;
	padding-right: 1rem;
}
.sidebar_menu {
	margin-top: 80px;
}
.sidebar_menu li{
	width: 100%;
	margin-bottom: 20px;
}

.sidebar_menu li a,
.sidebar_menu li .dropdown_btn {
	padding-left: 1rem;
	color: #fff;
	font-size: 1rem;
	text-decoration: none;
	display: block;
	border: none;
  	background: none;
	cursor: pointer;
	outline: none;
	width: 100%;
	
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
  	display: none;
  	text-align: right;
  	padding-right: 8px;
	background: var(--darkerblue);
}

/* Optional: Style the caret down icon */
.sidebar_menu .fa-caret-down {
  	float: right;
  	padding-right: 8px;
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
	justify-content: space-between;
	box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
	position: fixed;
	left: 300px;
	width: calc(100% - 300px);
	top: 0;
	z-index: 100;
	transition: left 300ms;
	padding: 8px 20px;
}
.la-user {
	margin: 5px;
	font-size: 20px;
}

#nav-toggle {
	display: none;
}

header h2 {
	color: #222;
}
header label span {
	font-size: 1.7rem;
	padding-right: 1rem;
}

.user_wrapper {
	display: flex;
	align-items: center;
	margin-right: 3rem;
}

.user_wrapper small {
	display: inline-block;
	color: var(--text-grey);
}




/* notification */

.fa.fa-bell-o {
        font-size: 18px;
        transform: translateY(2px);

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
        width: 400px;
        height: 90vh;
        position: fixed;
        top: 80px;
        right: 0;
        list-style-type: none;
        box-sizing: border-box;
        padding: 20px 40px;
        padding-top: 30px;
        overflow: scroll;
        opacity: 0;
        transform: translateX(55vh);
        transition: all .5s ease-in-out;
        background: #fff;
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
        font-family: roboto;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .notif_container small {
        font-family: Lato;
        font-size: 12px;
    }
    .count {
        height: 14px;
        width: 14px;
        font-size: 9px;
        font-family: roboto;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: -4px;
        right: -5px;
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

