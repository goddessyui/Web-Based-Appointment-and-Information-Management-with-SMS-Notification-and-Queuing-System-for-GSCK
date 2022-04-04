<!-- MAIN INDEX OF ANNOUNCEMENT FOR ADMIN -->
<?php
include("admin_header.php"); 

$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" || $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="index.php"</script>';
}
?>

    <main>
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
                    tbl_announcement.date_created,
                    tbl_announcement.video_url
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
                                    <?php echo !empty($row['image'])?'<img src="announcement_image/' . $row['image'] . '" alt="#">':''; ?>
                                    <?php echo !empty($row['video_url'])?'<iframe src="'.$row['video_url'].'"  width="500" height="265" frameborder="0" allowfullscreen></iframe>':''; ?>             
                                    </div> <div>    
                    <a href="Staff/announcement/get_announcement.php?edit=<?php echo $row['announcement_id']; ?>"> <button onclick="<?php unset($_SESSION['announcement_id'])?>">Edit</button></a>
                    <a href="Staff/announcement/announcement_delete.php?del=<?php echo $row['announcement_id']; ?>" class="del_btn" onclick="return confirm('Are you sure?')">
                <button style="background-color: #f44336";>Delete</button>
                        </a>	
                            
                            </div>
                                            
                    <?php

                        }
                    }

                    ?>
                
            </table>
        </div>
    </main>
</body>
</html>

    <?php

    if (isset($_POST['button_edit_menu'])) {

        $image = $_FILES['image']['tmp_name'];
        $img = file_get_contents($image);

        $menu_photo = "announcement_image/" . basename($_FILES['image']['name']);


        if (move_uploaded_file($_FILES['image']['tmp_name'], $menu_photo)) {
            $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, image=? where id=?');
            $stmt->bind_param("sssss", $name, $price, $img, $id);
            $name = $_POST['edit_title'];
            $price = $_POST['edit_announcement'];
            $img = basename($_FILES['image']['name']);
            $id = $_POST['edit_id'];

            $stmt->execute();
            echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="announcement_admin.php"</script>';
        } else {
            echo '<script type="text/javascript">alert("Updated Unsuccessful! Photo file format!");window.location.href="announcement_admin.php"</script>';
        }
    }

    ?>
<style>
    main {
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 100px;
    }
</style>