<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
if ($staff_id == "" && $username == "" && $position != "Accounting Staff/Scholarship Coordinator"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}
?>
<!-- For upload_unifast_grantees.php update and delete student record function -->
<?php
    //--------------------------If Update is Pressed---------------------------//
    if (isset($_POST['update'])) {
    $student_id = $_POST['studentid'];
    $first_name= $_POST['firstname'];
    $last_name= $_POST['lastname'];
    $batch_status= $_POST['batchstatus'];
    
        $updateunifastgrantee = "UPDATE tbl_unifast_grantee 
        SET student_id ='$student_id', first_name = '$first_name', last_name = '$last_name', batch_status = '$batch_status' 
        WHERE student_id ='$student_id'";

        if(mysqli_query($db, $updateunifastgrantee)){
                header('location: ../../upload_unifast_grantee.php?success="Successfully Updated Unifast Grantee\'s Details!"');
               
        } 
        else {
            header('location: ../../upload_unifast_grantee.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
        }
    }
    //--------------------------If Accept is Pressed---------------------------//

    //--------------------------If Delete is Pressed--------------------------// 
    else if (isset($_POST['delete'])) {
        $student_id = $_POST['delete'];
    
        $deleteunifastgrantee = "DELETE FROM tbl_unifast_grantee WHERE student_id ='$student_id'";
    
        if(mysqli_query($db, $deleteunifastgrantee))
        {   header('location: ../../upload_unifast_grantee.php?success="Successfully Deleted Student From the List!"');
        } 
        else
        {
            header('location: ../../upload_unifast_grantee.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
        }
    }
    //--------------------------If Delete is Pressed--------------------------// 

    // Close connection
    mysqli_close($db);

?>
