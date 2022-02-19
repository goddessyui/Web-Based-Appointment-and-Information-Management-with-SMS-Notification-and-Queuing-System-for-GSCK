<?php
include_once("../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["accounting_staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["accounting_username"];

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
<div class="container">
        <h2>Announcement</h2>
        <br>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Add Menu</button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Caption</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
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
                ";

                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...

                ?>
                        <tr>
                            <td> <?php echo $row['announcement_id'] ?> </td>
                            <td> <?php echo $row['announcement_title'] ?></td>
                            <td> <?php echo $row['caption'] ?></td>
                            <td> <?php echo $row['date_created'] ?> </td>
                            <td>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal">
                                    <button onclick="updatemenu(<?= $row['announcement_id'] ?>,'<?= $row['announcement_title'] ?>','<?= $row['caption'] ?>','<?= $row['image'] ?>')" class="btn btn-warning">Edit</button>
                                </a>
				<a href="delete.php?del=<?php echo $row['announcement_id']; ?>" class="del_btn" onclick="return confirm('Are you sure?')">
			<button style="background-color: #f44336"; class="btn btn-warning">Delete</button>
					</a>	
                            </td>
                        </tr>
                <?php

                    }
                }

                ?>
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Announcement</h4>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Title:</label>
                                    <input name="name" id="name" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Caption:</label>
                                    <input name="price" id="price" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Photo:</label>
                                    <input type="file" name="image" id="menu_photo" required="required" class="form-control" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="button_add_menu" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Announcement</h4>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <input name="edit_id" id="edit_id" type="hidden" class="form-control" value="">

                                    <label>Title:</label>
                                    <input name="edit_title" id="edit_name" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Caption:</label>
                                    <input name="edit_caption" id="edit_caption" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Photo:</label>
                                    <input type="file" name="image" id="menu_photo" required="required" class="form-control" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="button_edit_menu" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function updatemenu(announcement_id, announcement_title, caption, image) {
            document.getElementById("edit_id").value = announcement_id;
            document.getElementById("edit_title").value = announcement_title;
            document.getElementById("edit_caption").value = caption;
            document.getElementById("image").value = image;
        }
    </script>

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
        $menu_photo = "../announcement_image/" . basename($_FILES['image']['name']);


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