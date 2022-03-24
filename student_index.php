<?php
include_once("dbconfig.php"); 
session_start();
$student_id = $_SESSION["student_id"];
$username1 = $_SESSION["student_username"];
if ($student_id == "" && $username1 == ""){
    echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
}
?>

<head>
    <title>STUDENT PAGE</title>
</head>
<body>
        <div class="">
            <div class="">
                <a class="" href="#">GSCK Appointment System</a>
            </div>
            <ul class="">
            <li><a href="?p=announcements">Announcements</a></li>
                <li><a href="?p=schedules">Schedules</a></li>
                <li ><a href="appointment/student_appointment.php">Request an Appointment</a></li>
                <li><a href="appointment/student_appointment_details.php">Appointment Details</a></li>
                <li><a href="?p=Student/student_profile">Profile</a></li>
            </ul>
            <ul class="">
                <li><a href="logout.php"><span class=""></span>Logout</a></li>
            </ul>
            </div>


            <?php $page = isset($_GET['p']) ? $_GET['p'] : 'announcements';  ?>
<?php 
    if(!file_exists($page.".php") && !is_dir($page)){
        include '404.html';
    }else{
        include $page.'.php';
    }

    // switch ($page) {
    //     case "announcements":
    //         include $page.'.php';
    //       break;
    //     case "schedules":
    //         include $page.'.php';
    //       break;
    //     case "green":
    //         include $page.'.php';
    //       break;
    //   } 

    
?>
</body>
