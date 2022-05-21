<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
if ($staff_id == "" && $username == "" && $position != "Registrar"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}
?>
<!-- For upload_staff_records.php update and delete staff record function -->
<?php
    //--------------------------If Update is Pressed---------------------------//
    if (isset($_POST['update'])) {
    $staff_id = $_POST['staffid'];
    $first_name= $_POST['firstname'];
    $last_name= $_POST['lastname'];
    $email= $_POST['email'];
    
        $updatestaffrecord = "UPDATE tbl_staff_record 
        SET staff_id ='$staff_id', first_name = '$first_name', last_name = '$last_name', email = '$email'  
        WHERE staff_id ='$staff_id'";

        if(mysqli_query($db, $updatestaffrecord)){
                header('location: ../../upload_staff_records.php?success="Successfully Updated Entry!"');
        } 
        else {
                header('location: ../../upload_staff_records.php?error="error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
        }
    }
    //--------------------------If Accept is Pressed---------------------------//

    //--------------------------If Delete is Pressed--------------------------// 
    else if (isset($_POST['delete'])) {
        $staff_id = $_POST['staffid'];
    
        $deletestaffrecord = "DELETE FROM tbl_staff_record WHERE staff_id ='$staff_id'";
    
        if(mysqli_query($db, $deletestaffrecord))
        {   header('location: ../../upload_staff_records.php?success="Successfully Deleted Entry!"');
        } 
        else
        {
            header('location: ../../upload_staff_records.php?error="error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
        }
    }
    //--------------------------If Delete is Pressed--------------------------// 

    // Close connection
    mysqli_close($db);

?>
