<?php
include_once("../dbconfig.php"); 
session_start();
$std_id = $_SESSION["s_id"];
$session_id = $_SESSION["student_id"];

$query = mysqli_query($db, "SELECT * FROM tbl_student_record WHERE student_id='{$session_id}'");
$row = $query->fetch_assoc();
$s = $row["student_id"];

if ($std_id != "1") {
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

<form action="student_registration.php" method="post">
<h1>Sign Up</h1>
<div>
    Student ID: <input type="text" name="student_id" value="<?php echo $row["student_id"]?>" readonly>
    </div><div>
    First Name: <input type="text" name="first_name" value=<?php echo $row["first_name"]?> readonly>
    </div><div>
    Last Name: <input type="text" name="last_name" value=<?php echo $row["last_name"]?> readonly>
    </div>
    <div class="">
		<input type="text" name="username" value="" placeholder="enter a username" autocomplete="off" required />
	</div>
    <div class="">
		<input type="tel" name="number" value="" placeholder="9683510254" minlength="11" maxlength="11" autocomplete="off" required />
	</div>
	<div class="">
    <input type="text" name="course" value="" placeholder="provide an course" autocomplete="off" required />
	</div>
    <input type="text" name="year" value="" placeholder="provide an year" autocomplete="off" required />
	</div>
	<div class="">
		<input type="password" name="passwd" value="" placeholder="enter a password" autocomplete="off" required />
	</div>
	<div class="">
		<p>password must be at least 5 characters and<br /> have a special character, e.g. !#$.,:;()</font></p>
	</div>					
	<div class="">
		<input type="password" name="confirm_password" value="" placeholder="confirm your password" autocomplete="off" required />
	</div>
	
	<div class="">
    <div class="">
		<button class="" type="submit" name="button_register">Create Account</button>
	</div>
</form>



<?php
if (isset($_POST['button_register'])) {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username']; 
    $number = $_POST['number']; 
    $course = $_POST['course']; 
    $year = $_POST['year']; 
    $passwd = $_POST['passwd']; 
    $passwd_again = $_POST['confirm_password']; 


    if ($username != "" && $passwd != "" && $passwd_again != ""){
        
        if ($passwd == $passwd_again){
            
            if ( strlen($passwd) >= 5 && strpbrk($passwd, "!#$.,:;()") != false ){
               
                $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username='{$username}'");
                $query1 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username='{$username}'");
            if (mysqli_num_rows($query) == 0 && mysqli_num_rows($query1) == 0){
                mysqli_query($db, "INSERT INTO tbl_student_registry VALUES ('{$student_id}', '{$first_name}', '{$last_name}', '{$username}', '{$passwd}', '{$number}', '{$course}', '{$year}')");
                $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username='{$username}'");
            if (mysqli_num_rows($query) == 1){
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