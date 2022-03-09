<?php

include_once("../../dbconfig.php");
//session
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
//redirect if not registrar
if ($staff_id == "" && $username == "" && $position !="Registrar"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}
//show error message
$message = '';
//-------------------------------upload csv------------------------------------------------------------------------------//
if(isset($_POST["upload"]))
{
    if($_FILES['staff_file']['name'])
    {   
        $filename = explode(".", $_FILES['staff_file']['name']);//convert file name into array and store into $ file name variable
        if(end($filename) == "csv")//check if file is csv or not
        {//if csv
            //truncate all data from table
            $truncate = "TRUNCATE `tbl_staff_record`";
            mysqli_query($db, $truncate);
            //truncate all data from table
            $handle = fopen($_FILES['staff_file']['tmp_name'], "r");//file open function
            while($data = fgetcsv($handle))//file get csv function: fetch comma delimited data from csv and convert into array and store into $ variable
            {
                $staff_id = mysqli_real_escape_string($db, $data[0]); //data is cleaned by mysqli real escape function
                $first_name = mysqli_real_escape_string($db, $data[1]);  
                $last_name = mysqli_real_escape_string($db, $data[2]);
               
                $query="INSERT INTO tbl_staff_record (staff_id, first_name, last_name) VALUES ('$staff_id', '$first_name', '$last_name')";
                        mysqli_query($db, $query);
            }
        fclose($handle);
        header("location: upload_staff_records.php?updation=1");
        }
        else//if not csv
        {
        $message = '<label class="text-danger">Please Select CSV File only</label>';
        }
    }
    else
    {
        $message = '<label class="text-danger">Please Select File</label>';
    }
}

if(isset($_GET["updation"]))
{
    $message = '<label class="text-success">staff Records Update Done</label>';
}
//-------------------------------upload csv------------------------------------------------------------------------------//

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Staff Records</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
<body>
<br />
<div class="container">
    <h2 align="center">Update Staff Records</a></h2>
    <h5 align="center"><a href="registrar_index.php">Back</a></h5>
    <br />
    <!----------------------Form to Upload CSV ------------------------------------------------------------> 
    <form method="post" enctype='multipart/form-data'>
        <p><label>Please Select File(Only CSV Format)</label>
        <input type="file" name="staff_file" /></p>
        <br />
        <input type="submit" name="upload" class="btn btn-info" value="Upload" />
    </form>
    <!----------------------Form to Upload CSV ------------------------------------------------------------>
    <br />
    <?php echo $message; ?>
        <h3 align="center">Staff Record</h3>
   
    <br />
                <tr>
                    <th>Staff ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
    <?php
    //----------------------Form to Show, Update, Delete Data From tbl_staff_record ------------------------------------------//
        $staffrecordquery = "SELECT * FROM tbl_staff_record";
        $staffrecordresult = mysqli_query($db, $staffrecordquery);

        while($row = mysqli_fetch_array($staffrecordresult))
        {
    ?>
            <!--------Send Form Data to updatedelete_staffrecord.php---------------------------------------------->
            <form action="updatedelete_staffrecord.php" method="post">
                <input type="text" name="staffid" value="<?php echo $row["staff_id"]?>">
                <input type="text" name="firstname" value="<?php echo $row["first_name"]?>">
                <input type="text" name="lastname" value="<?php echo $row["last_name"]?>">
                <button  type="submit" name="update">UPDATE</button>
                <button type="submit" name="delete">DELETE</button><br />
            </form>
            <!---------Send Form Data to updatedelete_staffrecord.php---------------------------------------------->
      <?php
        }
    //----------------------Form to Show, Update, Delete Data From tbl_staff_record ------------------------------------------//
     ?>
    <!------Form to Add data to tbl_staff_record. Sends data to add_staffrecord.php------------------------------------------------>
        <form action="add_staffrecord.php" method="post">
            <input type="text" name="staffid" required>
            <input type="text" name="firstname" required>
            <input type="text" name="lastname" required>
            <input type="submit" value="ADD A staff" name="add"><br/><br>
        </form>
        <!------Form to Add data to tbl_staff_record. Sends data to add_staffrecord.php------------------------------------------------>
  </div>
 </body>
</html>

