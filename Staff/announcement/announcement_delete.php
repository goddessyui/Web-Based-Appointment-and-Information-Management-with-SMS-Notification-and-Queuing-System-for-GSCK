<?php include("../../dbconfig.php"); ?>
<?php 
if (isset($_GET['del'])) {
	$id = $_GET['del'];

	$stmt = $db->prepare("DELETE FROM tbl_announcement WHERE announcement_id = '{$id}'");
	 if ($stmt->execute()) {
	
	 echo '<script type="text/javascript">alert("Deleted Successfully!");window.location.href="announcement_test.php"</script>';
}
   else {
            echo '<script type="text/javascript">alert("Delete Unsuccessful!");window.location.href="announcement_test.php"</script>';
        }
}
  ?>