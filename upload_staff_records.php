<?php
include_once("admin_header.php");

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
        ?>
        <script type="text/javascript">
            window.location.href = 'upload_staff_records.php?updation=1';
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
    $message = '<label class="text-success">staff Records Update Done</label>';
}
//-------------------------------upload csv------------------------------------------------------------------------------//

?>

<main>
<br />
    <div class="container-fluid">
        <h2 align="center">Update Staff Records</a></h2>
        <br />
        <!----------------------Form to Upload CSV ------------------------------------------------------------> 
        <div class="row">
            <div  class="form-group">
                <form method="post" enctype='multipart/form-data'>
                    <label>Please Select File(Only CSV Format)</label>
                    <input type="file" class="form-control" name="staff_file" />
                    <?php
                            //show error message
                            $message = '';
                        ?>
                    <br />
                    <input type="submit" name="upload" class="btn btn-info" value="Upload" />
                </form>
            </div>
        </div>
        
        <!----------------------Form to Upload CSV ------------------------------------------------------------>
        <br />

        <div class="row">
            <h3 align="center">Staff Record</h3>
            <?php echo $message; ?>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">No. of Employed Staff</h5>
                        <p class="card-text">
                            <?php
                                $enrolledstaff = "SELECT * FROM tbl_staff_record";
                                $enrolledstaff_result = mysqli_query($db, $enrolledstaff);
                                $count = mysqli_num_rows($enrolledstaff_result);
                                echo $count;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    
        <br />

        <div class="row">
            <div class="col-sm-6">
                <div  class="form-group">
                    <!------Form to Add data to tbl_staff_record. Sends data to add_staffrecord.php------------------------------------------------>
                    <form action="Staff/registrar/add_staffrecord.php" method="post">
                        
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname"name="lastname" required>
                    
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    
                        <label for="staffid">Staff ID</label>
                        <input type="text" class="form-control" id="staffid" name="staffid" required>
                     
                        <input type="submit" class="btn btn-info" value="ADD A STAFF" name="add">

                    </form>
                    <!------Form to Add data to tbl_staff_record. Sends data to add_staffrecord.php------------------------------------------------>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
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

                </div>
            </div>
        </div>

        <div class="row">
            <?php
            //----------------------Form to Show, Update, Delete Data From tbl_staff_record ------------------------------------------//
                
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
            
            $staffrecordquery = "SELECT * FROM tbl_staff_record ORDER BY last_name ASC, first_name ASC LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for pagination
                
                $staffrecordresult = mysqli_query($db, $staffrecordquery);
                    
                while($row = mysqli_fetch_array($staffrecordresult))
                {
            ?>
                <!--------Send Form Data to updatedelete_staffrecord.php---------------------------------------------->
                <div class="col-sm-10">
                    <div  class="form-group"> 
                    
                        <form action="Staff/registrar/updatedelete_staffrecord.php" method="post">
                            <div class="form-inline" >
                                <input type="text" class="form-control" name="lastname" value="<?php echo $row["last_name"]?>">
                                <input type="text" class="form-control" name="firstname" value="<?php echo $row["first_name"]?>">
                                <input type="text" class="form-control" name="staffid" value="<?php echo $row["staff_id"]?>">
                            
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <button  type="submit" class="btn btn-primary" name="update">UPDATE</button>
                                    <button type="submit" class="btn btn-danger" name="delete">DELETE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!---------Send Form Data to updatedelete_staffrecord.php---------------------------------------------->
            <?php
                }
            //----------------------Form to Show, Update, Delete Data From tbl_staff_record ------------------------------------------//
            ?>
        </div>
        <div class="row">
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

        </div>

    </div>
        <?php
         include("backtotop.php");
        ?>


    </main>
</body>
</html>

<style> 
    main {
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 100px;
    }
    .staffrecord{
        display: inline-block;
    }
    .staffrecord input{
        display: block;
    }

</style>
