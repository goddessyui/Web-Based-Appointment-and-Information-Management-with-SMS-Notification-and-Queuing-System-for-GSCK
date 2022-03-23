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
$appointment_type = "";
                $sql = "SELECT
                tbl_staff_appointment.staff_id,
                tbl_staff_appointment.appointment_type
                FROM
                tbl_staff_appointment
                WHERE staff_id = '{$staff_id}'";
                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row1 = mysqli_fetch_assoc($res)) {
                        # code...
                        $appointment_type .= $row1["appointment_type"].","; 

                    }
                }
$array_type = explode( ',', $appointment_type );

               
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
    <div>
    <div class="">
                <a class="" href="../index.php">GSCK Appointment System</a>
            </div>
<ul class="">
                <li><a href="#">Appointments</a></li>
		        <li><a href="announcement/announcement_test.php">Make Announcements</a></li>
                <li><a href="#">Schedules</a></li>
                <li class="active"><a href="#">Account</a></li>
            </ul>
            <ul class="">
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
            </ul>
            </div>

<hr>
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
    <?php if ($position == 'Registrar'){?>
    <div>Position: <select name="position">  
    <option value="Registrar" selected>Registrar</option>  
    </select>  </div>
    <?php } else {?>
    <div>Position: <select name="position">  
    <option value="Teacher" <?php echo $row["position"]=='Teacher'?'selected':''?>>Teacher</option>  
    <option value="Accounting Staff/Scholarship Coordinator" <?php echo $row["position"]=='Accounting Staff/Scholarship Coordinator'?'selected':''?>>Accounting Staff/Scholarship Coordinator</option>  
    </select>  </div>
        <?php } ?>
    <div> Other Position: </div>
    <div>
    <input type="checkbox" name="other_list[]" value="OJT Coordinator" <?php echo in_array("OJT Coordinator", $array_other)?'checked':''?>>
    <label> OJT Coordinator</label><br>
    <input type="checkbox" name="other_list[]" value="Department Head" <?php echo in_array("Department Head", $array_other)?'checked':''?>>
    <label> Department Head</label><br>
    </div>

    <div> Appointment Type: </div>
    <div>
    <input type="checkbox" name="check_list[]" value="Request Documents From Registrar" <?php echo in_array("Request Documents From Registrar", $array_type)?'checked':'';?>>
    <label> Request Documents From Registrar</label><br>
    <input type="checkbox" name="check_list[]" value="Evaluation of Grades" <?php echo in_array("Evaluation of Grades", $array_type)?'checked':'';?>>
    <label> Evaluation of Grades - Department Head</label><br>
    <input type="checkbox" name="check_list[]" value="Enrollment" <?php echo in_array("Enrollment", $array_type)?'checked':'';?>>
    <label> Enrollment</label><br>
    <input type="checkbox" name="check_list[]" value="Pre-Enrollment" <?php echo in_array("Pre-Enrollment", $array_type)?'checked':'';?>>
    <label> Pre-Enrollment</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Claim Chequet" <?php echo in_array("UniFAST - Claim Chequet", $array_type)?'checked':'';?>>
    <label> UniFAST - Claim Cheque</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents" <?php echo in_array("UniFAST - Submit Documents", $array_type)?'checked':'';?>>
    <label> UniFAST - Submit Documents</label><br>
    <input type="checkbox" name="check_list[]" value="Meeting" <?php echo in_array("Meeting", $array_type)?'checked':'';?>>
    <label> Meeting</label><br>
    <input type="checkbox" name="check_list[]" value="Module Claiming/Submission" <?php echo in_array("Module Claiming/Submission", $array_type)?'checked':'';?>>
    <label> Module Claiming/Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Request for Grades" <?php echo in_array("Request for Grades", $array_type)?'checked':'';?>>
    <label> Request for Grades</label><br>
    <input type="checkbox" name="check_list[]" value="Project Submission" <?php echo in_array("Project Submission", $array_type)?'checked':'';?>>
    <label> Project Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Presentation" <?php echo in_array("Presentation", $array_type)?'checked':'';?>>
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
    <div class="">
		<p>password must be at least 5 characters and<br /> have a number character, e.g. 1234567890</p>
	</div>
    <label>Re-enter New Password</label>
    <div>
		<input type="password" name="newpass_verify" value="" placeholder="Re-enter new password" minlength="5" autocomplete="off" />

    <div>
		<button class="" type="submit" name="button_change_pass">Change Password</button>
	</div>
</form>

<?php
$staff_id = $row['staff_id'];
 if (isset($_POST['button_edit_profile'])) {
    $new_mobilenumber = $_POST['number'];
    $new_position = $_POST["position"];
    $type = $_POST['check_list'];
    $new_other_position = implode(',', $_POST['other_list']);
    $sql = "UPDATE tbl_staff_registry SET mobile_number='".$new_mobilenumber."', position='".$new_position."' , other_positions='".$new_other_position."' WHERE staff_id = '{$staff_id}'";
        if (mysqli_query($db, $sql)) {
            $stmt = $db->prepare("DELETE FROM tbl_staff_appointment WHERE staff_id = '{$staff_id}'");
	        if ($stmt->execute()){
                foreach($type as $types){
                    $query = "INSERT INTO tbl_staff_appointment (appointment_type, staff_id)VALUES ('{$types}', '{$staff_id}')";
                    $query_run = mysqli_query($db, $query);
                    
                    $_SESSION["position"] = $new_position;
                    }  
        echo "Profile Settings Changes";}
        } else {
        echo "Error changing password:  $sql." . mysqli_error($db);
        }
        
     
    
}
    if (isset($_POST['button_change_pass'])) {
        $currentpassword = $_POST['currentpass'];
        $newpassword = $_POST['newpass'];
        $verify_newpassword = $_POST['newpass_verify'];
        if($currentpassword == $row['password']){
        if (strlen($newpassword) >= 5 && strpbrk($newpassword, "1234567890") != false ){
        if ($newpassword == $verify_newpassword){
            $sql = "UPDATE tbl_staff_registry SET password = '".$newpassword."' WHERE staff_id = '{$staff_id}'";
            if (mysqli_query($db, $sql)) {
                echo "Password updated successfully";
              } else {
                echo "Error changing password:  $sql." . mysqli_error($db);
              }
            
         }else{
             echo "Password not Match";
         }}
         else{
            echo 'Your password is not strong enough. Please use another.';
            }
        }else{
            echo "Password Incorrect";
    }
}



?>





</body>
</html>