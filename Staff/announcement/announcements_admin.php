<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" && $staff_username == ""){
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
<div>
              
           
              <ul class="">
              <li><a href="#">Appointments</a></li>
              <li class="active"><a href="#">Make Announcements</a></li>
              <li><a href="#">Schedules</a></li>
              <li><a href="../staff_profile.php">Account</a></li>
          </ul>
          <ul class="">
              <li><a href="../../logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
          </ul>
          </div>
    <hr>
<div class="container">
        <h2>Announcement</h2>
        <br>
        <a href="announcement_add.php"><button type="button">Add announcement</button></a>
        <table class="table">
           
                <?php
                $sql = "SELECT
                tbl_announcement.announcement_id,
                tbl_announcement.staff_id,
                tbl_announcement.announcement_title,
                tbl_announcement.caption,
                tbl_announcement.image,
                tbl_announcement.date_created
                FROM
                tbl_announcement
                ORDER BY date_created DESC                          
                ";

                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...

                ?>
                <hr>
                <div class="blog_img_box">
                <div><h3><?php echo $row['announcement_title'] ?></h3><?php echo $row['date_created'] ?></div>
                <div><pre><?php echo $row['caption'] ?></pre></div>
                                <div>
                                <?php echo !empty($row['image'])?'<img src="../../announcement_image/' . $row['image'] . '" alt="#">':''; ?>
                                               
                                </div> <div>    
                <a href="get_announcement.php?del=<?php echo $row['announcement_id']; ?>"> <button onclick="<?php unset($_SESSION['announcement_id'])?>">Edit</button></a>
				<a href="announcement_delete.php?del=<?php echo $row['announcement_id']; ?>" class="del_btn" onclick="return confirm('Are you sure?')">
			<button style="background-color: #f44336";>Delete</button>
					</a>	
                          
                        </div>
                                        
                <?php

                    }
                }

                ?>
            
        </table>
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