<?php
session_start();
$student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
if ($staff_id != "" && $staff_username != ""){
    if ($position == "Registrar"){
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

<?php 
include('header.php');
?>
<br><br><br><br><br><br><br><br><br><h3>Student Portal</h3>

<?php 

echo "Staff ID:". $staff_username;
?>
</body>

</html>