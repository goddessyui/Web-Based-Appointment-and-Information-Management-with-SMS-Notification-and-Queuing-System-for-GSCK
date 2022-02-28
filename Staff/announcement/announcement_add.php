<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = !empty($_SESSION["teacher_staff_id"])?$_SESSION["teacher_staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$username = !empty($_SESSION["accounting_username"])?$_SESSION["accounting_username"]:'';

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
    
  <h1>Add Announcement</h1>
            <!-- Modal content-->
           
                    <form class="user" method="POST" enctype="multipart/form-data" runat="server">
                        
                                <div>    <label>Title:</label>
                                    <input name="name" id="name" type="text" class="form-control" value="" required>
                                </div><div>
                        
                                    <label>Caption:</label>
                                    <textarea name="price" id="price" type="text" class="form-control" value="" required></textarea>
                                </div><div>
                                
                                <div><img id="output" src="#"/></div>
                                    <label>Photo:</label>
                                    <input type="file" name="image" accept="image/*" id="menu_photo" id="imgInp" required="required" class="form-control" onchange="loadFile(event)" >
                                </div>
                                
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="button_add_menu">Submit</button>
                    </form>
                </div>
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


if (isset($_POST['button_add_menu'])) {
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");
    $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,image,date_created,staff_id) VALUES (?,?,?,?,?)');
    $stmt->bind_param("sssss", $title, $caption, $img, $datetime, $staff_id1);
    $image = $_FILES['image']['tmp_name'];
    $img = basename($_FILES['image']['name']);
    $title = $_POST['name'];
    $caption = $_POST['price'];
    $datetime = $date;
    $staff_id1 = $staff_id;
    $menu_photo = "../../announcement_image/" . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $menu_photo)) {
        $stmt->execute();
        echo '<script type="text/javascript">alert("Added Successfully!");window.location.href="announcement_test.php"</script>';
    } else {
        echo '<script type="text/javascript">alert("Added Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
    }
}

?>




</body>
</html>