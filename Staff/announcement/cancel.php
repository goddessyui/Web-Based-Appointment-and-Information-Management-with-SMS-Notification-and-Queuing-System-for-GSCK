<?php include_once("../../dbconfig.php"); 

session_start();
$staff_id = $_SESSION["staff_id"];
$username = $_SESSION["staff_username"];

if ($staff_id == "" || $username == ""){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}

    unset($_SESSION['announcement_id']);
    echo '<script>window.location.href="announcement_admin.php"</script>';
    ?>