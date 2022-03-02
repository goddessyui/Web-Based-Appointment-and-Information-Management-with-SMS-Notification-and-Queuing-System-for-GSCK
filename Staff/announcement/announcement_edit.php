<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" && $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
}

$ann_id = $_SESSION['announcement_id'];
$query = mysqli_query($db, "SELECT * FROM tbl_announcement WHERE announcement_id='{$ann_id}'");
$row = $query->fetch_assoc();

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



    <h1>Edit Announcement</h1>
   
           
                    <form class="user" method="POST" enctype="multipart/form-data">
                        
                                <div>
                                    <input name="edit_id" id="edit_id" type="hidden" class="form-control" value="">

                                    <label>Title:</label>
                                    <input name="edit_title" type="text" class="form-control" value="<?php echo $row["announcement_title"]?>"  required>
                                </div>
                          
                        
                                <div>
                                    <label>Caption:</label>
                                    <textarea name="edit_caption" type="text" class="form-control" required><?php echo $row["caption"]?></textarea>
                                </div>

                                <div>
                                    <label>Photo:</label>
                                    <input type="file" name="image" accept="image/*" id="menu_photo" id="imgInp" onchange="loadFile(event)" >
                                </div>

                                <div>
                                    <img id="output" src="<?php echo '../../announcement_image/'.$row['image']?>"/>
                                </div>
                              
                          
             
                <div>
                    <button type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="button_edit_announcement">Submit</button>
                    </form>
                </div>
           
                <script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>


<?php
if (isset($_POST['button_edit_announcement'])) {
    $image = $_FILES['image']['tmp_name'];
    $img = !empty($image)?file_get_contents($image):'';
    $announcement_photo = "../../announcement_image/" . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $announcement_photo)) {
        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, image=? where announcement_id=?');
        $stmt->bind_param("ssss", $title, $caption, $img, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $img = basename($_FILES['image']['name']);
        $ann_id1 = $ann_id;
        $stmt->execute();
        echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="announcement_test.php"</script>';
    } 
    else if (!move_uploaded_file($_FILES['image']['tmp_name'], $announcement_photo)) {
        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=? where announcement_id=?');
        $stmt->bind_param("sss", $title, $caption, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $ann_id1 = $ann_id;
        $stmt->execute();
        echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="announcement_test.php"</script>';
    }else {
        echo '<script type="text/javascript">alert("Updated Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
    }
}

?>

</body>
</html>