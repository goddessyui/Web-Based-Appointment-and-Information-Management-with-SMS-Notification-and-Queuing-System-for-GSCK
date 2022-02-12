<?php
include_once("dbconfig.php");
session_start();
$std_id = $_SESSION["student_id"];
//  echo '<script type="text/javascript">alert("' . $transaction_id . ' order.php!");window.location.href="order.php"</script>';

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
    <h1>hello</h1>
</body>
</html>