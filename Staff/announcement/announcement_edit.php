<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["accounting_staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["accounting_username"];
$ann_id = $_SESSION['announcement_id'];
//if ($position != "Teacher"){
 //   echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
//}
//if ($position != "Registrar"){
  //  echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
//}
//if ($position != "Account Staff"){
//    echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
//}
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

<script type="text/javascript">
        function updatemenu(announcement_id, announcement_title, caption, image) {
            document.getElementById("edit_id").value = announcement_id;
            document.getElementById("edit_title").value = announcement_title;
            document.getElementById("edit_caption").value = caption;
            document.getElementById("image").value = image;
        }
    </script>

    <h1>Edit Announcement</h1>
   
           
                    <form class="user" method="POST" enctype="multipart/form-data">
                        
                                <div>
                                    <input name="edit_id" id="edit_id" type="hidden" class="form-control" value="">

                                    <label>Title:</label>
                                    <input name="edit_title" id="edit_name" type="text" class="form-control" value="" required>
                                </div>
                          
                        
                                <div>
                                    <label>Caption:</label>
                                    <input name="edit_caption" id="edit_caption" type="text" class="form-control" value="" required>
                                </div>
                         
                       
                                <div>
                                    <label>Photo:</label>
                                    <input type="file" name="image" id="menu_photo" required="required" class="form-control" required>
                                </div>
                          
             
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="button_edit_menu" class="btn btn-success">Submit</button>
                    </form>
                </div>
           

<?php
if (isset($_POST['button_edit_menu'])) {
    $image = $_FILES['image']['tmp_name'];
    $img = file_get_contents($image);
    $menu_photo = "../announcement_image/" . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $menu_photo)) {
        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, image=? where id=?');
        $stmt->bind_param("sssss", $name, $price, $img, $id);
        $name = $_POST['edit_title'];
        $price = $_POST['edit_announcement'];
        $img = basename($_FILES['image']['name']);
        $id = $_POST['edit_id'];
        $stmt->execute();
        echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="menu.php"</script>';
    } else {
        echo '<script type="text/javascript">alert("Updated Unsuccessful! Photo file format!");window.location.href="menu.php"</script>';
    }
}

?>

</body>
</html>