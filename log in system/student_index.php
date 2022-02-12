<?php
include_once("dbconfig.php"); 
session_start();
$std_id = $_SESSION["s_id"];
$session_id = $_SESSION["student_id"];

$query = mysqli_query($db, "SELECT * FROM student_record WHERE student_id='{$session_id}'");
$row = $query->fetch_assoc();
$s = $row["student_id"];

if ($std_id != "1") {
    echo '<script type="text/javascript">window.location.href="register.php"</script>';
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

<form action="student_index.php" method="post">
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
		<input type="tel" name="number" value="" placeholder="9683510254" minlength="10" maxlength="10" autocomplete="off" required />
	</div>
	<div class="">
	<div class="">
		<input type="text" name="email" value="" placeholder="provide an email" autocomplete="off" required />
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
$idid = "";
if (isset($_POST['button_register'])) {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username']; 
    $number = $_POST['number']; 
    $email = $_POST['email']; 
    $passwd = $_POST['passwd']; 
    $passwd_again = $_POST['confirm_password']; 


    if ($username != "" && $passwd != "" && $passwd_again != ""){
        // make sure the two passwords match
        if ($passwd == $passwd_again){
            // make sure the password meets the min strength requirements
            if ( strlen($passwd) >= 5 && strpbrk($passwd, "!#$.,:;()") != false ){
               
                $query = mysqli_query($db, "SELECT * FROM student_registry WHERE username='{$username}'");
            if (mysqli_num_rows($query) == 0){
                $sql = "INSERT INTO student_registry "."(ID, first_name, last_name, student_id, username, number, email, password) "."VALUES"."('$idid','$first_name','$last_name','$student_id','$username','$number','$email','$passwd')";
                $query = mysqli_query($db, "SELECT * FROM student_registry WHERE username='{$username}'");
            if (mysqli_num_rows($query) == 1){
    
         $success = true;

         if (isset($success) && $success == true){
			echo '<p color="green">Yay!! Your account has been created. <a href="./login.php">Click here</a> to login!<p>';
		}
	
		else if (isset($error_msg))
			echo '<p color="red">'.$error_msg.'</p>';

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
        $error_msg = 'Please fill out all required fields.';


}
?>



</body>
</html>