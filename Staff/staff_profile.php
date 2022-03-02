<?php
include_once("../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
$query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE staff_id='{$staff_id}'");
$row = $query->fetch_assoc();
$rows = !empty($row['other_positions'])?$row['other_positions']:'';
$array_other = explode( ',', $rows );
if ($staff_id == "" && $username == ""){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
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
    <div><h1>PROFILE</h1></div>
    <div><h2> <?php echo $row["first_name"]," ", $row["last_name"]?></h2></div>
    <div><p> <?php echo $row["username"]?></p></div>
    <div><p> <?php echo $row["other_positions"]?></p></div>
    <div><p> <?php echo $row["mobile_number"]?></p></div>
    <hr>

    <div><h2>Update Profile</h2></div>
    <div>
    Student ID: <input type="text" name="student_id" value="<?php echo $row["staff_id"]?>" disabled />
    </div>

    <div class="">
	Username: <input type="text" name="username" value="<?php echo $row["username"]?>" disabled />
	</div>

    <div>
    First Name: <input type="text" name="first_name" value=<?php echo $row["first_name"]?> disabled />
    </div>
    
    <div>
    Last Name: <input type="text" name="last_name" value=<?php echo $row["last_name"]?> disabled />
    </div>
    <form  method="POST">
    <div class="">
	Mobile Number: <input type="tel" name="number" value="<?php echo $row["mobile_number"]?>" minlength="11" maxlength="11" autocomplete="off" required />
	</div>


    <div> Other Position: </div>
    <div>
    <input type="checkbox" name="other_list[]" value="OJT Coordinator" <?php echo in_array("OJT Coordinator", $array_other)?'checked':''?>>
    <label> OJT Coordinator</label><br>
    <input type="checkbox" name="other_list[]" value="Department Head" <?php echo in_array("Department Head", $array_other)?'checked':''?>>
    <label> Department Head</label><br>
    </div>

    <div> Appointment Type: </div>
    <div>
    <input type="checkbox" name="check_list[]" value="Request Documents From Registrar" <?php echo $row1["appointment_type"]=='Request Documents From Registrar'?'checked':'';?>>
    <label> Request Documents From Registrar</label><br>
    <input type="checkbox" name="check_list[]" value="Evaluation of Grades" <?php echo $row1["appointment_type"]=='Evaluation of Grades - Department Head'?'checked':'';?>>
    <label> Evaluation of Grades - Department Head</label><br>
    <input type="checkbox" name="check_list[]" value="Enrollment" <?php echo $row1["appointment_type"]=='Enrollment'?'checked':'';?>>
    <label> Enrollment</label><br>
    <input type="checkbox" name="check_list[]" value="Pre-Enrollment" <?php echo $row1["appointment_type"]=='Pre-Enrollment'?'checked':'';?>>
    <label> Pre-Enrollment</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Claim Chequet" <?php echo $row1["appointment_type"]=='UniFAST - Claim Chequet'?'checked':'';?>>
    <label> UniFAST - Claim Chequet</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents" <?php echo $row1["appointment_type"]=='UniFAST - Submit Documents'?'checked':'';?>>
    <label> UniFAST - Submit Documents</label><br>
    <input type="checkbox" name="check_list[]" value="Meeting" <?php echo $row1["appointment_type"]=='Meeting'?'checked':'';?>>
    <label> Meeting</label><br>
    <input type="checkbox" name="check_list[]" value="Module Claiming/Submission" <?php echo $row1["appointment_type"]=='Module Claiming/Submission'?'checked':'';?>>
    <label> Module Claiming/Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Request for Grades" <?php echo $row1["appointment_type"]=='Request for Grades'?'checked':'';?>>
    <label> Request for Grades</label><br>
    <input type="checkbox" name="check_list[]" value="Project Submission" <?php echo $row1["appointment_type"]=='Project Submission'?'checked':'';?>>
    <label> Project Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Presentation" <?php echo $row1["appointment_type"]=='Presentation'?'checked':'';?>>
    <label> Presentation</label><br>
    </div>




    <div>
    <button type="submit" name="button_edit_profile">Save Changes</button>
    </div>
<HR>
    <div><h2>Change Password</h2></div>
<label>Current password</label>
    <div>
		<input type="password" name="currentpass" value="" placeholder="Current password" minlength="5" autocomplete="off" />
	</div>
    <label>New Password</label>
    <div >
		<input type="password" name="newpass" value="" placeholder="New password" minlength="5" autocomplete="off" />
	</div>
    <label>Re-enter New Password</label>
    <div>
		<input type="password" name="newpass_verify" value="" placeholder="Re-enter new password" minlength="5" autocomplete="off" />

    <div>
		<button class="" type="submit" name="button_change_pass">Change Password</button>
	</div>
</form>

<?php
$student_id = $row['student_id'];
 if (isset($_POST['button_edit_profile'])) {
    $new_mobilenumber = $_POST['number'];
    $new_course = $_POST["course"];
    $new_year = $_POST['year'];
    $sql = "UPDATE tbl_student_registry SET mobile_number=$new_mobilenumber, course='".$new_course."' , year=$new_year WHERE student_id = '{$student_id}'";
        if (mysqli_query($db, $sql)) {
        echo "Profile Settings Changes";
        } else {
        echo "Error changing password:  $sql." . mysqli_error($db);
        }
        
     
    
}
    if (isset($_POST['button_change_pass'])) {
        $currentpassword = $_POST['currentpass'];
        $newpassword = $_POST['newpass'];
        $verify_newpassword = $_POST['newpass_verify'];
        if($currentpassword == $row['password']){
        if ($newpassword == $verify_newpassword){
            $sql = "UPDATE tbl_student_registry SET password = $newpassword WHERE student_id = '{$student_id}'";
            if (mysqli_query($db, $sql)) {
                echo "Password updated successfully";
              } else {
                echo "Error changing password:  $sql." . mysqli_error($db);
              }
            
         }else{
             echo "Password not Match";
         }
        }else{
            echo "Password Incorrect";
    }
}



?>





</body>
</html>