<?php
include_once("../dbconfig.php"); 
session_start();
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
$v_id = $_SESSION["verification_id"];
$v_number = $_SESSION["verification_no"];
$m_number = $_SESSION["m_number"];
if ($student_username == "" && $staff_username ==""){
    echo '<script type="text/javascript">window.location.href="login.php"</script>';
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
<h1>FORGOT PASSWORD we send to your number ****<?php echo substr($m_number, -2);  ?></h1>
	<form  method="POST">
    <label>Enter Verification Code <?php echo $v_number ?></label>
    <input type="text" name="verification_code" value="" required/>
    
    <input type="submit" name="submit_verification" value="VERIFY"/>
</form>

    <?php
    if (isset($_POST['submit_verification'])) {
        $verification = $_POST['verification_code'];
        if ($verification == $v_number){
            session_start();
            $_SESSION["verification"] = $verification;
            echo '<script type="text/javascript">alert("SMS Verification Success!");window.location.href="forgotpassword.php"</script>';
         
         }else{
             echo "not match";
         }
        }
      

    ?>

</body>
</html>