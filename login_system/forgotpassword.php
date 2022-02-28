<?php
include_once("../dbconfig.php"); 
session_start();
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
$v_id = $_SESSION["verification_id"];
$v_number = $_SESSION["verification_no"];
$verification = $_SESSION["verification"];
if ($verification != $v_number){
    echo '<script type="text/javascript">window.location.href="forgotpassword_verify.php"</script>';
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
<h1>CHANGE PASSWORD</h1>
	<form  method="POST">
    <label>New password</label>
    <div class="">
		<input type="password" name="newpass" value="" placeholder="New password" minlength="5" autocomplete="off" required />
	</div>
    <label>Re-enter new password</label>
    <div class="">
		<input type="password" name="newpass_verify" value="" placeholder="Re-enter new password" minlength="5" autocomplete="off" required />

    <div class="">
		<button class="" type="submit" name="button_pass">Change Password</button>
	</div>
</form>



    <?php
    if (isset($_POST['button_pass'])) {
        $newpassword = $_POST['newpass'];
        $verify_newpassword = $_POST['newpass_verify'];
        if($v_id == "student"){
        if ($newpassword == $verify_newpassword){
            $sql = "UPDATE tbl_student_registry SET password = $newpassword WHERE username = '{$student_username}'";
            if (mysqli_query($db, $sql)) {
                echo "Password updated successfully";
              } else {
                echo "Error changing password:  $sql." . mysqli_error($db);
              }
            
         }else{
             echo "not match";
         }
        }

        else if($v_id == "staff"){
            if ($newpassword == $verify_newpassword){
                $sql = "UPDATE tbl_staff_registry SET password = $newpassword WHERE username = '{$staff_username}'";
                if ($db->query($sql) === TRUE) {
                    echo "Password updated successfully";
                  } else {
                    echo "Error changing password:  $sql." . mysqli_error($db);;
                  }
                
             }else{
                 echo "not match";
             }
            }




    }
       
        
   
        

    ?>

</body>
</html>