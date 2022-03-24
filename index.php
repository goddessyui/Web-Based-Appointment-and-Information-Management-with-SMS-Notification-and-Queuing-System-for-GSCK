<?php
session_start();
    $student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
    $student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
    $staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
    $position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
    $staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

    if ($staff_id != "" && $staff_username != ""){
        if ($position == "Registrar"){
            echo '<script type="text/javascript">window.location.href="Staff/registrar/registrar_index.php"</script>';
        }
        else if ($position == "Accounting Staff/Scholarship Coordinator"){
            echo '<script type="text/javascript">window.location.href="Staff/accounting_staff/accounting_staff_index.php"</script>';
        }
        else if ($position == "Teacher"){
            echo '<script type="text/javascript">window.location.href="Staff/teacher/teacher_index.php"</script>';
        }
    }

    else if ($student_id != "" && $student_username != ""){
        echo '<script type="text/javascript">window.location.href="student_index.php"</script>';
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="">
<div> 
    <li><a href="login_system/login.php">Sign in</a></li>
</div>
<div> 
    <li><a href="login_system/verification.php">Register</a></li>
    <ul class="">
                <li><a href="?p=announcements">Announcements</a></li>
                <li><a href="?p=schedules">Schedules</a></li>
            </ul>
</div>


<?php $page = isset($_GET['p']) ? $_GET['p'] : 'announcements';  ?>
<?php 
    if(!file_exists($page.".php") && !is_dir($page)){
        include '404.html';
    }else{
    if($page == "announcements"){
        include $page.'.php';
    }else if($page == "schedules"){
        include $page.'.php';
    }
    }
?>

</div>

</body>
>>>>>>> ac00c4547037533314e7496c6aa566fbc5ab385e
</html>