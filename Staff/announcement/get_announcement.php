<!-- GET ANNOUNCEMENT ID TO SESSION IF EDIT BUTTON CLICKED -->
<?php include_once("../../dbconfig.php"); 
 
 session_start();
 $staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
 $staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
 
 if ($staff_id == "" || $staff_username == ""){
    echo '<script type="text/javascript">window.location.href="../../index.php"</script>';
 }



if (isset($_GET['del'])) {
	$id = $_GET['del'];
    session_start();
    $_SESSION['announcement_id'] = $id;
    echo '<script>window.location.href="announcement_edit.php"</script>';
}

    ?>