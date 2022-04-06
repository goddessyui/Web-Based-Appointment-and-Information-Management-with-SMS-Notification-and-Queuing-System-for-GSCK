<!-- DELETE ANNOUNCEMENT -->
<?php 
session_start();
$staff_id = $_SESSION["staff_id"];
$username = $_SESSION["staff_username"];

if ($staff_id == "" || $username == ""){
    echo '<script type="text/javascript">window.location.href="../../index.php"</script>';
}

include_once("../../dbconfig.php"); ?>
<?php 
if (isset($_GET['del'])) {
	$id = $_GET['del'];
    $query = mysqli_query($db, "SELECT tbl_announcement.image FROM tbl_announcement WHERE announcement_id='{$id}'");
    if (mysqli_num_rows($query) == 1){
    $row = $query->fetch_assoc();
    $filename = "../../announcement_image/" . $row['image'];
    if (file_exists($filename)) {
        unlink($filename);
	    $stmt = $db->prepare("DELETE FROM tbl_announcement WHERE announcement_id = '{$id}'");
	 if ($stmt->execute()) {
	
	 echo '<script type="text/javascript">alert("Deleted Successfully!");window.location.href="../../announcement_admin.php"</script>';
}
   else {
            echo '<script type="text/javascript">alert("Delete Unsuccessful!");window.location.href="../../announcement_admin.php"</script>';
        }

    }
    else {
            echo '<script type="text/javascript">alert("Delete Unsuccessful!");window.location.href="../../announcement_admin.php"</script>';
          }
    }
    
}
  ?>