<?php
include_once("admin_header.php");

//-------------------------------upload csv------------------------------------------------------------------------------//
if(isset($_POST["upload"]))
{
    if($_FILES['student_file']['name'])
    {   
        $filename = explode(".", $_FILES['student_file']['name']);//convert file name into array and store into $ file name variable
        if(end($filename) == "csv")//check if file is csv or not
        {//if csv
            //truncate all data from table
            $truncate = "TRUNCATE `tbl_student_record`";
            mysqli_query($db, $truncate);
            //truncate all data from table
            $handle = fopen($_FILES['student_file']['tmp_name'], "r");//file open function
            while($data = fgetcsv($handle))//file get csv function: fetch comma delimited data from csv and convert into array and store into $ variable
            {
                $student_id = mysqli_real_escape_string($db, $data[0]); //data is cleaned by mysqli real escape function
                $first_name = mysqli_real_escape_string($db, $data[1]);  
                $last_name = mysqli_real_escape_string($db, $data[2]);
               
                $query="INSERT INTO tbl_student_record (student_id, first_name, last_name) 
                    VALUES ('$student_id', '$first_name', '$last_name')";
                        mysqli_query($db, $query);
            }
        fclose($handle);
        ?>
        <script type="text/javascript">
            window.location.href = 'upload_student_records.php?updation=1';
        </script>
        <?php
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

<main>
<br />
<div class="container">
    <h2 align="center">Update Student Records</a></h2>
    <br />
    <!----------------------Form to Upload CSV ------------------------------------------------------------> 
    <form method="post" enctype='multipart/form-data'>
        <label>Please Select File(Only CSV Format)</label>
        <input type="file" name="student_file" />
        <?php
                //show error message
                $message = '';
            ?>
        <br />
        <input type="submit" name="upload" class="btn btn-info" value="Upload" />
    </form>
    <!----------------------Form to Upload CSV ------------------------------------------------------------>
    <br />
    
    <?php echo $message; ?>
        <h3 align="center">Student Record</h3>

    <div >
        <h5>No. of Enrolled Students</h5>
        <p>
            <?php
                $enrolledstudents = "SELECT COUNT(*) AS total FROM tbl_student_record";
                $enrolledstudents_result = mysqli_query($db, $enrolledstudents);
                $count =mysqli_fetch_assoc($enrolledstudents_result);
                echo $count['total'];
            ?>
        </p>
    </div>
   
    <br />
        <!------Form to Add data to tbl_student_record. Sends data to add_studentrecord.php------------------------------------------------>
        <form action="Staff/registrar/add_studentrecord.php" method="post">
            <span class="studentrecord">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname"name="lastname" required>
            </span>
            <span class="studentrecord">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>
            </span>
            <span class="studentrecord">
                <label for="studentid">Student ID</label>
                <input type="text" id="studentid" name="studentid" required>
            </span>
            
            <input type="submit" value="ADD A STUDENT" name="add">
        </form>
        <!------Form to Add data to tbl_student_record. Sends data to add_studentrecord.php------------------------------------------------>
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

    <?php
    //----------------------Form to Show, Update, Delete Data From tbl_student_record ------------------------------------------//
        
        //-----------For pagination-------------//
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 25;
        $offset = ($pageno-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM tbl_unifast_grantee";
        $theresult = mysqli_query($db, $total_pages_sql);
        $total_rows = mysqli_fetch_array($theresult)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
         //-----------For pagination-------------//
    
    
        $studentrecordquery = "SELECT * FROM tbl_student_record ORDER BY last_name ASC, first_name ASC LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for pagination
        $studentrecordresult = mysqli_query($db, $studentrecordquery);

        while($row = mysqli_fetch_array($studentrecordresult))
        {
    ?>
            <!--------Send Form Data to updatedelete_studentrecord.php---------------------------------------------->
            <form action="Staff/registrar/updatedelete_studentrecord.php" method="post">

                <input type="text" name="lastname" value="<?php echo $row["last_name"]?>">  
                <input type="text" name="firstname" value="<?php echo $row["first_name"]?>">
                <input type="text" name="studentid" value="<?php echo $row["student_id"]?>">
                <button  type="submit" name="update">UPDATE</button>
                <button type="submit" name="delete">DELETE</button><br />
                
            </form>
            <!---------Send Form Data to updatedelete_studentrecord.php---------------------------------------------->
      <?php
        }
    //----------------------Form to Show, Update, Delete Data From tbl_student_record ------------------------------------------//
     ?>

  </div>
                           
        <?php
            include("backtotop.php");
        ?>
        
        <!--------Pagination---------------------------------------------->
<ul class="pagination">
    <li><a href="?pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
<!--------Pagination---------------------------------------------->


    </main>
</body>
</html>
<style> 
    main {
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 100px;
    }
    .studentrecord{
        display: inline-block;
    }
    .studentrecord input{
        display: block;
    }
</style>
