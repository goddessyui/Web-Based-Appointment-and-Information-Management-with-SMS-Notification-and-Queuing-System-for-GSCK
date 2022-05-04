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
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {

                                var data = google.visualization.arrayToDataTable([
                                ['Appointments', 'No. of Appointments'],
                                
                                

                                ['Slots Taken', 
                                <?php 
                                    date_default_timezone_set('Asia/Manila');                           		
                                    $currentdate = date("Y-m-d");
                                    
                                    $taken = "SELECT appointment_detail_id FROM tbl_appointment_detail 
                                        WHERE `status` = ('Accepted' OR 'Cancelled') 
                                        AND appointment_date = '$currentdate'";
                                    $takenslot = mysqli_query($db, $taken);
                                    $no_of_slots_taken = mysqli_num_rows($takenslot);
    
                                    echo $no_of_slots_taken; 
                                ?>],
                                ['Slots Available',
                                <?php
                                    
                                    $limit_app = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
                                    $app_limitation = mysqli_query($db, $limit_app);
                                    $row= mysqli_fetch_assoc($app_limitation);
        
                                   $no_of_slots_available = $row['appointment_limit'] - $no_of_slots_taken;
                                    echo $no_of_slots_available ;
                                    ?>
                                ]
                                ]);

                                var options = {
                                title: 'Daily Appointment Slot (Active/Cancelled)',
								backgroundColor: { fill:'transparent' },
								is3d:true
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                                chart.draw(data, options);
                            }
                        </script>





							<script type="text/javascript">
								google.charts.load('current', {'packages':['bar']});
								google.charts.setOnLoadCallback(drawStuff);

								function drawStuff() {
									var data = new google.visualization.arrayToDataTable([
									['Staff', 'Appointments'],
								
									<?php  
										date_default_timezone_set('Asia/Manila');                           		
										$currentdate = date("Y-m-d");
			
										$appt = "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name, COUNT(*) as C
										FROM tbl_appointment_detail INNER JOIN tbl_appointment 
										ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
										INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
										WHERE appointment_date = '$currentdate' AND tbl_appointment_detail.status = 'Accepted'
										GROUP BY first_name HAVING COUNT(*)>0";
										$appt_today = mysqli_query($db, $appt);

										if($appt_today==TRUE){
											$count= mysqli_num_rows($appt_today);

											if($count>0) {

												while($r=mysqli_fetch_assoc($appt_today)){
													echo "['".$r["first_name"]."', ".$r["C"]."], ";
												}
											}
											else {
												echo"No result";
											}
										}
										else{
											echo"Cannot access" . mysqli_error($db);
										}

									?> 
									
									]);
									<?php
									
									?>

									var options = {
									title: 'Daily Active Appointments Per Staff',
									legend: { position: 'none' },
									
									bars: 'vertical', // Required for Material Bar Charts.
									axes: {
										x: {
										0: { side: 'top', label: 'Daily Active Appointments Per Staff'} // Top x-axis.
										}
									},
									bar: { groupWidth: "100%" }
									};

									var chart = new google.charts.Bar(document.getElementById('top_x_div'));
									chart.draw(data, options);
								};
								</script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/admin_style.css">
    <title>blackenstate College of Koronadal - Admin Dashboard</title>
</head>
<body>

	<input type="checkbox" id="nav-toggle">

	<div class="sidebar">
		<div class="sidebar_brand">
	</div>

		<div class="sidebar_menu">
			<ul>
				<li>
					<img src="icon/black/dashboard_black.svg" alt="">
					<a href="admin.php">
						<span>Dashboard</span>
					</a>
				</li>

				<li>
					<img src="icon/black/user_black.svg" alt="">
					<a href="staff_profile.php">
						<span>Account</span>
					</a>
				</li>

				<li>
					<img src="icon/black/schedule_black.svg" alt="">
					<a href="schedule_admin.php">
						<span>Set my schedule</span>
					</a>
				</li>

				<li>
					<img src="icon/black/announcement_black.svg" alt="">
					<a href="announcement_admin.php">
						<span>Announcement</span>
					</a>
				</li>
			<?php 
				if ($position == "Registrar"){
			?>
				<li>
					<img src="icon/black/record_black.svg" alt="">
					<a href="upload_student_records.php">
						<span>Student Records</span>
					</a>
				</li>
				<li>
					<img src="icon/black/record_black.svg" alt="">
					<a href="upload_staff_records.php">
						<span>Staff Records</span>
					</a>
				</li>
				

				<li>
					<img src="icon/black/schedule_black.svg" alt="">
					<a href="staff_accepted_requests.php">
						<span>My Appointments</span>
					</a>
				</li>
				
			<?php
            	}
            	else if($position == "Accounting Staff/Scholarship Coordinator"){
            ?>
				
				<li>
					<img src="icon/black/record_black.svg" alt="">
					<a href="upload_unifast_grantee.php">
						<span>Grantee Records</span>
					</a>
				</li>
				<li>
					<img src="icon/black/schedule_black.svg" alt="">
					<a href="claimcheque_pendingapp.php">
						<span>Claim Cheque</span>
					</a>
				</li>
				<li>
					<img src="icon/black/schedule_black.svg" alt="">
					<a href="submitdocu_pendingapp.php">
						<span>Submit Documents</span>
					</a>
				</li>

				<li>
					<img src="icon/black/schedule_black.svg" alt="">
					<a href="staff_accepted_requests.php">
						<span>My Appointments</span>
					</a>
				</li>
			<?php
            	}
				else if($position == "Teacher"){
            ?>
				<li>
					<img src="icon/black/schedule_black.svg" alt="">
					<a href="staff_accepted_requests.php">
						<span>My Appointments</span>
					</a>
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

				<div class="title_name">
					<h3>GOLDENSTATE COLLEGE OF KORONADAL</h3>
				</div>

				<div class="user_wrapper">

					<!-- NOTIFICATION BUTTON -->
					<div class="dropdown-toggle" data-toggle="dropdown">
						<button onclick="BtnDropdown()" class="btn_no_bg">
							<i class="fa fa-bell-o"><p class="count" id="count_red" style="text-decoration: none; color: #fff;"></p></i>
						</button>
						<div class="dropdown-menu" id="dropdown_id"></div>
					</div>
					<button class="btn_logout_admin"><a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></button>
       <!-- NOTIFICATION BUTTON -->
				</div>
		</header>



<style>
	@import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');

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
}

.sidebar {
	width: 300px;
	position: fixed;
	top: 0;
	left: 0;
	height: 100%;
	background: #fff;
	z-index: 888;
	transition: width 300ms;
	border-right: 1px solid lightgrey;
}
.sidebar_brand {
	height: 60px;
	display: flex;
	justify-content: center;
	text-align: center;
	background-color: #fff;
}

.sidebar_menu {
	margin: 20px;
	height: 88vh;
}

.sidebar_menu li{
	width: 100%;
	margin-bottom: 20px;
	display: flex;
	align-items: center;
	text-transform: uppercase;
}

.sidebar_menu li a {
	color: #333;
	font-size: 14px;
	text-decoration: none;
	display: block;
	border: none;
  	background: none;
	cursor: pointer;
	outline: none;
	width: 100%;
	text-transform: uppercase;
	font-family: Lato;
}
.sidebar_menu li img {
	margin-right: 12px;
	padding: 2px;
	width: 26px;
	height: 26px;
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
header .title_name h3 {
	font-family: roboto;
	color: #333;
}

#nav-toggle {
	display: none;
}

.user_wrapper {
	display: flex;
	align-items: center;
	margin-right: 15px;
}
.user_wrapper small {
	margin-right: 12px;
	margin-left: 2px;
}

.user_wrapper  .btn_logout_admin{
	background: #444;
	margin-left: 12px;
	border: none;
	padding: 4px 10px;
	font-size: 12px;
}
.user_wrapper a {
	color: #eee;
	font-family: Lato;
}




/* notification */

.fa.fa-bell-o {
        font-size: 18px;
		transform: translateY(1.5px);

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

