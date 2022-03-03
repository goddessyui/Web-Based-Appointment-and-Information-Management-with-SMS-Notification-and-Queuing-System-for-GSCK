<?php
include_once("../dbconfig.php"); 
session_start();
$student_id = $_SESSION["student_id"];
$username1 = $_SESSION["student_username"];
$query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
$row = $query->fetch_assoc();
if ($student_id == "" && $username1 == ""){
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

<div class="">
           
                <a class="" href="#">GSCK Appointment System</a>
            
            <ul class="">
                <li class="active"><a href="#">Request an Appointment</a></li>
		<li><a href="#">Appointment Details</a></li>
                <li><a href="Student/student_profile.php">Profile</a></li>
            </ul>
            <ul class="">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
            </ul>
            </div>
            <hr>

    <div><h1>PROFILE</h1></div>
    <div><h2> <?php echo $row["first_name"]," ", $row["last_name"]?></h2></div>
    <div><p> <?php echo $row["username"]?></p></div>
    <div><p> <?php echo $row["course"]," ", $row["year"]?></p></div>
    <hr>

    <div><h2>Update Profile</h2></div>
    <div>
    Student ID: <input type="text" name="student_id" value="<?php echo $row["student_id"]?>" disabled />
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

    <div>Course: <select name="course">  
    <option value="BSHM" <?php echo $row["course"]=='BSHM'?'selected':"";?>>BSHM</option>
    <option value="BSTM" <?php echo $row["course"]=='BSTM'?'selected':"";?>>BSTM</option>
    <option value="BSIT" <?php echo $row["course"]=='BSIT'?"selected":"";?>>BSIT</option>
    <option value="BSSW" <?php echo $row["course"]=='BSSW'?'selected':"";?>>BSSW</option>
    <option value="ABE" <?php echo $row["course"]=='ABE'?'selected':"";?>>ABE</option>
    <option value="BECE" <?php echo $row["course"]=='BECE'?'selected':"";?>>BECE</option>
    <option value="BTVED" <?php echo $row["course"]=='BTVED'?'selected':"";?>>BTVED</option>
    <option value="BSBA" <?php echo $row["course"]=='BSBA'?'selected':"";?>>BSBA</option>
    <option value="ACT" <?php echo $row["course"]=='ACT'?'selected':"";?>>ACT</option>
    <option value="HM" <?php echo $row["course"]=='HM'?'selected':"";?>>HM</option>
    <option value="TESDA PROGRAM" <?php echo $row["course"]=='TESDA PROGRAM'?'selected':"";?>>TESDA PROGRAM</option>
    </select>  </div>


    <div>Year: <select name="year">  
    <option value="1" <?php echo $row["year"]=='1'?'selected':'';?>>1st Year</option>
    <option value="2" <?php echo $row["year"]=='2'?'selected':'';?>>2nd Year</option>
    <option value="3" <?php echo $row["year"]=='3'?'selected':'';?>>3rd Year</option>
    <option value="4" <?php echo $row["year"]=='4'?'selected':'';?>>4th Year</option>
    </select>
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
        if ( strlen($passwd) >= 5 && strpbrk($passwd, "1234567890") != false ){
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