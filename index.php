<?php include_once("dbconfig.php");
session_start();
$student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
if ($staff_id != "" && $staff_username != ""){
    if ($position == "Registrar"){
        echo '<script type="text/javascript">window.location.href="../../registrar_index.php"</script>';
    }
    else if ($position == "Accounting Staff/Scholarship Coordinator"){
        echo '<script type="text/javascript">window.location.href="../../accounting_staff_index.php"</script>';
    }
    else if ($position == "Teacher"){
        echo '<script type="text/javascript">window.location.href="../../teacher_index.php"</script>';
    }
}

else if ($student_id != "" && $student_username != ""){
    echo '<script type="text/javascript">window.location.href="student_index.php"</script>';
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

<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Food Ordering System</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="transaction.php">Transactions</a></li>
	<li><a href="stransaction.php">Success Transaction</a></li>
                <li class="active"><a href="menu.php">Menu</a></li>
		<li><a href="account.php">Accounts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="loginsession.php?ses=1"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </nav>



<div class="">
<div> 
    <li><a href="login_system/login.php">Sign in</a></li>
</div>
<div> 
    <li><a href="login_system/verification.php">Register</a></li>
</div><div><h1>Announcement</h1></div>

<?php include 'announcement_display.php'; ?>
        

</div>
</body>
</html>