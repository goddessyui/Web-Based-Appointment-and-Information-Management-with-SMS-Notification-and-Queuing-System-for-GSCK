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
<!-- For upload_student_records.php update and delete student record function -->
<?php
    //--------------------------If Update is Pressed---------------------------//
    if (isset($_POST['update'])) {
    $student_id = $_POST['studentid'];
    $first_name= $_POST['firstname'];
    $last_name= $_POST['lastname'];
    $email= $_POST['email'];
    
        $updatestudentrecord = "UPDATE tbl_student_record 
        SET student_id ='$student_id', first_name = '$first_name', last_name = '$last_name', email = '$email' 
        WHERE student_id ='$student_id'";

        if(mysqli_query($db, $updatestudentrecord)){
                header('location: ../../upload_student_records.php?success="Successfully Updated Entry!"');
        } 
        else {
            header('location: ../../upload_student_records.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
        }
    }
    //--------------------------If Accept is Pressed---------------------------//

    //--------------------------If Delete is Pressed--------------------------// 
    else if (isset($_POST['delete'])) {
        $student_id = $_POST['studentid'];
    
        $deletestudentrecord = "DELETE FROM tbl_student_record WHERE student_id ='$student_id'";
    
        if(mysqli_query($db, $deletestudentrecord)){   
            header('location: ../../upload_student_records.php?success="Successfully Deleted Entry!"');
        } 
        else{
            header('location: ../../upload_student_records.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
        }
    }
    //--------------------------If Delete is Pressed--------------------------// 

    // Close connection
    mysqli_close($db);

?>
