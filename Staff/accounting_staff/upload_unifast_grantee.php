<?php

include_once("../../dbconfig.php");
//session
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
//redirect if not registrar
if ($staff_id == "" && $username == "" && $position !="Accounting Staff/Scholarship Coordinator"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}
//show error message
$message = '';
//upload csv
if(isset($_POST["upload"]))
{
    if($_FILES['student_file']['name'])
    {   
        $filename = explode(".", $_FILES['student_file']['name']);//convert file name into array and store into $ file name variable
        if(end($filename) == "csv")//check if file is csv or not
        {//if csv
            //truncate all data from table
            $truncate = "TRUNCATE `tbl_unifast_grantee`";
            mysqli_query($db, $truncate);
            //truncate all data from table
            $handle = fopen($_FILES['student_file']['tmp_name'], "r");//file open function
            while($data = fgetcsv($handle))//file get csv function: fetch comma delimited data from csv and convert into array and store into $ variable
            {
                $student_id = mysqli_real_escape_string($db, $data[0]); //data is cleaned by mysqli real escape function
                $first_name = mysqli_real_escape_string($db, $data[1]);  
                $last_name = mysqli_real_escape_string($db, $data[2]);
               
                $query="INSERT INTO tbl_unifast_grantee (student_id, first_name, last_name) VALUES ('$student_id', '$first_name', '$last_name')";
                        mysqli_query($db, $query);
            }
        fclose($handle);
        header("location: upload_unifast_grantee.php?updation=1");
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
    $message = '<label class="text-success">UniFAST Grantee Record Update Done</label>';
}
//upload csv


$query = "SELECT * FROM tbl_unifast_grantee";
$result = mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update UniFAST Grantee Records</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Update UniFAST Grantee Records</a></h2>
   <br />
    <form method="post" enctype='multipart/form-data'>
        <p><label>Please Select File(Only CSV Format)</label>
        <input type="file" name="student_file" /></p>
        <br />
        <input type="submit" name="upload" class="btn btn-info" value="Upload" />
   </form>
   <br />
   <?php echo $message; ?>
   <h3 align="center">UNIFAST GRANTEES</h3>
   <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
     <tr>
      <th>Student ID</th>
      <th>First Name</th>
      <th>Last Name</th>
     </tr>
     <?php
     while($row = mysqli_fetch_array($result))
     {
      echo '
      <tr>
       <td>'.$row["student_id"].'</td>
       <td>'.$row["first_name"].'</td>
       <td>'.$row["last_name"].'</td>
      </tr>
      ';
     }
     ?>
    </table>
   </div>
  </div>
 </body>
</html>