<?php include("../../dbconfig.php"); ?>
<?php 
if (isset($_GET['del'])) {
	$id = $_GET['del'];
    session_start();
    $_SESSION['announcement_id'] = $id;
    echo '<script>window.location.href="announcement_edit.php"</script>';
}

    ?>