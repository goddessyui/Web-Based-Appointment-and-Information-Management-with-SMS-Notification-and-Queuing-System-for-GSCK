<?php
include_once("../../dbconfig.php");
//session
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
//redirect if not accounting staff/scholarship coordinator
if ($staff_id == "" && $username == "" && $position !="Accounting Staff/Scholarship Coordinator"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}
//show error message
$message = '';
//-------------------------------upload csv------------------------------------------------------------------------------//
if(isset($_POST["upload"]))
{
    if($_FILES['ug_file']['name'])
    {   
        $filename = explode(".", $_FILES['ug_file']['name']);//convert file name into array and store into $ file name variable
        if(end($filename) == "csv")//check if file is csv or not
        {//if csv
            //truncate all data from table
            $truncate = "TRUNCATE `tbl_unifast_grantee`";
            mysqli_query($db, $truncate);
            //truncate all data from table
            $handle = fopen($_FILES['ug_file']['tmp_name'], "r");//file open function
            while($data = fgetcsv($handle))//file get csv function: fetch comma delimited data from csv and convert into array and store into $ variable
            {
                $student_id = mysqli_real_escape_string($db, $data[0]); //data is cleaned by mysqli real escape function
                $first_name = mysqli_real_escape_string($db, $data[1]);  
                $last_name = mysqli_real_escape_string($db, $data[2]);
               
                $query="INSERT INTO tbl_unifast_grantee (student_id, first_name, last_name) 
                VALUES ('$student_id', '$first_name', '$last_name')";
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
    $message = '<label class="text-success">Student Records Update Done</label>';
}
//-------------------------------upload csv------------------------------------------------------------------------------//

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
    <h5 align="center"><a href="accounting_staff_index.php">Back</a></h5>
    <br />
    <!----------------------Form to Upload CSV ------------------------------------------------------------> 
    <form method="post" enctype='multipart/form-data'>
        <p><label>Please Select File(Only CSV Format)</label>
        <input type="file" name="ug_file" /></p>
        <br />
        <input type="submit" name="upload" class="btn btn-info" value="Upload" />
    </form>
    <!----------------------Form to Upload CSV ------------------------------------------------------------>
    <br />
    <?php echo $message; ?>
        <h3 align="center">UniFAST Grantee Record</h3>
   
    <br />
    <?php
    //----------------------Form to Show, Update, Delete Data From tbl_unifast_grantee ------------------------------------------//
        $ugquery = "SELECT * FROM tbl_unifast_grantee";
        $ugresult = mysqli_query($db, $ugquery);

        while($row = mysqli_fetch_array($ugresult))
        {
    ?>
            <!--------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
            <form action="updatedelete_unifastgrantee.php" method="post">
                <input type="text" name="studentid" value="<?php echo $row["student_id"]?>">
                <input type="text" name="firstname" value="<?php echo $row["first_name"]?>">
                <input type="text" name="lastname" value="<?php echo $row["last_name"]?>">
                <button  type="submit" name="update">UPDATE</button>
                <button type="submit" name="delete">DELETE</button><br />
            </form>
            <!---------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
      <?php
        }
    //----------------------Form to Show, Update, Delete Data From tbl_unifast_grantee ------------------------------------------//
     ?>
    <!------Form to Add data to tbl_unifast_grantee. Sends data to add_unifastgrantee.php------------------------------------------------>
        <form action="add_unifastgrantee.php" method="post">
            <input type="text" name="staffid" required>
            <input type="text" name="firstname" required>
            <input type="text" name="lastname" required>
            <input type="submit" value="ADD A STUDENT" name="add"><br/><br>
        </form>
        <!------Form to Add data to tbl_unifast_grantee. Sends data to add_unifastgrantee.php------------------------------------------------>
  </div>
                          <!--success or error-->
                          <?php 
                            if(isset($_GET['success'])){
                        ?>
                                <p align="center">
                                    <?php 
                                        echo $_GET['success'];
                                    ?>
                                </p>
                        <?php
                            }
                            if(isset($_GET['error'])){
                        ?>
                                        <p align="center">
                                            <?php 
                                                echo $_GET['error'];
                                            ?>
                                        </p>
                                <?php
                                    }
                            else{
                            }
                        ?>
                        <!--success or error-->
 </body>
</html>

