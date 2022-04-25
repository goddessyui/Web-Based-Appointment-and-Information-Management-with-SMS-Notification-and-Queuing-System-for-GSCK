<?php
if ($staff_id == "" || $staff_username == ""){
    echo '<script type="text/javascript">window.location.href="index.php"</script>';
 }

// insert data into tbl_notification if staff added an announcement
if (isset($add)){
$querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
$rows = $querys->fetch_assoc();
$fullnames = $rows['first_name'].' '.$rows['last_name'];

$sql = "SELECT
    tbl_staff_registry.staff_id
    FROM
    tbl_staff_registry
    WHERE staff_id != '".$staff_id."'";
$res = mysqli_query($db, $sql);
if (mysqli_num_rows($res) > 0) {

    while ($row = mysqli_fetch_assoc($res)) {
        # code...
        mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`, `link`) VALUES 
        ('ANNOUNCEMENT UPDATE', 
        '$fullnames ADDED an Announcement', '0', 
        '".$row['staff_id']."', 'announcement_admin.php?ann=$add_id')");

    // delete older notif if exced 10 rows
    $result = mysqli_query($db, "SELECT notification_id FROM tbl_notification WHERE id='".$row['staff_id']."' ORDER BY notification_id DESC LIMIT 10,1");
    $fetch = mysqli_fetch_assoc($result);
    mysqli_query($db, "DELETE FROM `tbl_notification` WHERE `notification_id` < '".$fetch['notification_id']."' AND `id`='".$row['staff_id']."'");
    }

    }


}

// insert data into tbl_notification if staff edited an announcement
else if (isset($edit)){
    $querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
    $rows = $querys->fetch_assoc();
    $fullnames = $rows['first_name'].' '.$rows['last_name'];
    
    $sql = "SELECT
    tbl_staff_registry.staff_id
    FROM
    tbl_staff_registry
    WHERE staff_id != '".$staff_id."'"; 
$res = mysqli_query($db, $sql);
if (mysqli_num_rows($res) > 0) {

    while ($row = mysqli_fetch_assoc($res)) {
        # code...
        mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`, `link`) VALUES 
    ('ANNOUNCEMENT UPDATE', 
    '$fullnames EDITED his Announcement', '0', 
    '".$row['staff_id']."', 'announcement_admin.php?ann=$ann_id')");

// delete older notif if exced 10 rows
$result = mysqli_query($db, "SELECT notification_id FROM tbl_notification WHERE id='".$row['staff_id']."' ORDER BY notification_id DESC LIMIT 10,1");
$fetch = mysqli_fetch_assoc($result);
mysqli_query($db, "DELETE FROM `tbl_notification` WHERE `notification_id` < '".$fetch['notification_id']."' AND `id`='".$row['staff_id']."'");
    }

    }
}



?>