<?php
include_once("../dbconfig.php"); 
session_start();
$std_id = $_SESSION["s_id"];
$session_id = $_SESSION["staff_id"];

$query = mysqli_query($db, "SELECT * FROM tbl_staff_record WHERE staff_id='{$session_id}'");
$row = $query->fetch_assoc();

if ($std_id != "2") {
    echo '<script type="text/javascript">window.location.href="verification.php"</script>';
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

<form action="staff_registration.php" method="post">
<h1>Sign Up</h1>
    <div>
    Staff ID: <input type="text" name="staff_id" value="<?php echo $row["staff_id"]?>" disabled>
    </div>
    
    <div>
    First Name: <input type="text" name="first_name" value=<?php echo $row["first_name"]?> disabled>
    </div>
    
    <div>
    Last Name: <input type="text" name="last_name" value=<?php echo $row["last_name"]?> disabled>
    </div>

    <div class="">
	Username:	<input type="text" name="username" value="" placeholder="enter a username" autocomplete="off" required />
	</div>

    <div class="">
	Phone Number: <input type="tel" name="number" value="" placeholder="09683510254" minlength="11" maxlength="11" autocomplete="off" required />
	</div>

    <div>Position: <select name="position">  
    <option value="Teacher">Teacher</option>  
    <option value="Accounting Staff/Scholarship Coordinator">Accounting Staff/Scholarship Coordinator</option>  
    </select>  </div>

    <div> Other Position: </div>
    <div>
    <input type="checkbox" name="other_list[]" value="OJT Coordinator">
    <label> OJT Coordinator</label><br>
    <input type="checkbox" name="other_list[]" value="Department Head">
    <label> Department Head</label><br>
    </div>

    <div> Appointment Type: </div>
    <div>
    <input type="checkbox" name="check_list[]" value="Request Documents From Registrar">
    <label> Request Documents From Registrar</label><br>
    <input type="checkbox" name="check_list[]" value="Evaluation of Grades">
    <label> Evaluation of Grades - Department Head</label><br>
    <input type="checkbox" name="check_list[]" value="Enrollment">
    <label> Enrollment</label><br>
    <input type="checkbox" name="check_list[]" value="Pre-Enrollment">
    <label> Pre-Enrollment</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Claim Chequet">
    <label> UniFAST - Claim Chequet</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents">
    <label> UniFAST - Submit Documents</label><br>
    <input type="checkbox" name="check_list[]" value="Meeting">
    <label> Meeting</label><br>
    <input type="checkbox" name="check_list[]" value="Module Claiming/Submission">
    <label> Module Claiming/Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Request for Grades">
    <label> Request for Grades</label><br>
    <input type="checkbox" name="check_list[]" value="Project Submission">
    <label> Project Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Presentation">
    <label> Presentation</label><br>
    </div>

	<div class="">
    Password: <input type="password" name="passwd" value="" placeholder="enter a password" minlength="5" autocomplete="off" required />
	</div>

    <div class="">
		<p>password must be at least 5 characters and<br /> have a number character, e.g. 1234567890</p>
	</div>	

	<div class="">
    Re Enter Password: <input type="password" name="confirm_password" value="" placeholder="confirm your password" minlength="5"  autocomplete="off" required />
	</div>

    <div class="">
		<button class="" type="submit" name="button_register">Create Account</button>
	</div>
</form>

<?php
if (isset($_POST['button_register'])) {
    $staff_id = $row["staff_id"];
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $username = $_POST['username']; 
    $number = $_POST['number']; 
    $position = $_POST['position']; 
    $passwd = $_POST['passwd']; 
    $passwd_again = $_POST['confirm_password']; 
    $type = $_POST['check_list'];
    $other_type = !empty($_POST['other_list'])?$_POST['other_list']:'';
    if ($username != "" && $passwd != "" && $passwd_again != ""){
    if(!empty($type)){
        if ($passwd == $passwd_again){
            
            if ( strlen($passwd) >= 5 && strpbrk($passwd, "1234567890") != false ){
            $query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username='{$username}'");
            $query1 = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username='{$username}'");

                if (mysqli_num_rows($query) == 0 && mysqli_num_rows($query1) == 0){
                    $othr = !empty($_POST['other_list'])?implode(',', $_POST['other_list']):'';
                    mysqli_query($db, "INSERT INTO tbl_staff_registry VALUES ('{$staff_id}', '{$first_name}', '{$last_name}', '{$username}', '{$passwd}', '{$position}', '{$othr}', '{$number}')");
                    $query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username='{$username}'");

                        if (mysqli_num_rows($query) == 1){
                        foreach($type as $types){
                        $query = "INSERT INTO tbl_staff_appointment (appointment_type, staff_id)VALUES ('{$types}', '{$staff_id}')";
                        $query_run = mysqli_query($db, $query);
                        }
                        $success = true;     
                        }

                        else 
                        $error_msg = 'An error occurred and your account was not created.';
                        }

                else
                    $error_msg = 'The username <i>'.$username.'</i> is already taken. Please use another.';
                    }

            else
            $error_msg = 'Your password is not strong enough. Please use another.';
            }
            
        else
        $error_msg = 'Your passwords did not match.';  
        }

    else 
    $error_msg = 'You did not select any Appointment Type.';  
    }

if (isset($success) && $success == true){
 
	session_unset();
    session_destroy();
    echo '<script type="text/javascript">alert("Account Created!");window.location.href="login.php"</script>';
}

else if (isset($error_msg))
    echo '<p color="red">'.$error_msg.'</p>';

}


?>



</body>
</html>