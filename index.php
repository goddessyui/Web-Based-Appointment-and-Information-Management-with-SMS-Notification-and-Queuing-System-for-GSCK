<?php include_once("dbconfig.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="">
<div> 
    <li><a href="login_system/login.php">Sign in</a></li>
</div>
<div> 
    <li><a href="login_system/verification.php">Register</a></li>
</div><div><h1>Announcement TEST</h1></div>
       
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
                <div>
                <div><h3><?php echo $row['announcement_title'] ?></h3><?php echo $row['date_created'] ?></div>
                <div><p> <?php echo $row['caption'] ?></p></div>
                                <div>
                                <?php echo !empty($row['image'])?'<img src="announcement_image/' . $row['image'] . '" alt="#">':''; ?>
                                               
                                </div>
                        </div>
                                        
                                        

                <?php

                    }
                }

                ?>
        




</div>
</body>
</html>