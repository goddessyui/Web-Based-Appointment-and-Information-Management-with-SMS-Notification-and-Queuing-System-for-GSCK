<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" || $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
}
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
                                    <input name="name" id="name" type="text" value="" required>
                                </div><div>
                        
                                    <label>Caption:</label>
                                    <textarea name="price" id="price" type="text" value="" required></textarea>
                                </div><div>
                                <label>Photo:</label>
                                    <input type="file" name="image" accept="image/*" id="imgInp" onchange="loadFile(event)" >
                                </div>
                                <div><img id="output" src="#"/></div>
                                    
                                
                <div class="">
                    <button type="submit" name="button_add_announcement">Submit</button>
                    </form>
                    <a href="cancel.php">Cancel</a>
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
if (isset($_POST['button_add_announcement'])) {
    $image = $_FILES['image']['tmp_name'];
    if(!empty($image)){
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");
    $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,image,date_created,staff_id) VALUES (?,?,?,?,?)');
    $stmt->bind_param("sssss", $title, $caption, $img, $datetime, $staff_id1);
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
    else if(empty($image)){
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");
    $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,date_created,staff_id) VALUES (?,?,?,?)');
    $stmt->bind_param("ssss", $title, $caption, $datetime, $staff_id1);
    $title = $_POST['name'];
    $caption = $_POST['price'];
    $datetime = $date;
    $staff_id1 = $staff_id;
    if ($stmt->execute()) {
        echo '<script type="text/javascript">alert("Added Successfully!");window.location.href="announcement_test.php"</script>';
    } else {
        echo '<script type="text/javascript">alert("Added Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
    }
}
}

?>




</body>
</html>