<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script language="javascript" type="text/javascript">
function doReload(appointment_name){
	document.location = 'request_appointment.php?appointment_name=' + appointment_name;
}
</script>


</head>
<body>
</body>
</html>


$query1 = mysqli_query($db, "SELECT appointment_type FROM tbl_staff_appointment WHERE staff_id='{$staff_id}'");
$row1[] = mysqli_fetch_all($db->query($query1), MYSQLI_ASSOC);
while( $strPackageResult=mysqli_fetch_array($query1,MYSQLI_ASSOC) )
        {  $row1[]=$strPackageResult;  }