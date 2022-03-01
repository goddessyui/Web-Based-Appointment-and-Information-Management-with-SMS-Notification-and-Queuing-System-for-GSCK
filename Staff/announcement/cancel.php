<?php include("../../dbconfig.php"); ?>
<?php 
    session_start();
    unset($_SESSION['announcement_id']);
    echo '<script>window.location.href="announcement_test.php"</script>';
    ?>