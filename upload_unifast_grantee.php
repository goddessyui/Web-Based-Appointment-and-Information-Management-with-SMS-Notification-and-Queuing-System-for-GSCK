<?php
include("admin_header.php");

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
                $batch_status = mysqli_real_escape_string($db, $data[3]);
               
                $query="INSERT INTO tbl_unifast_grantee (student_id, first_name, last_name, batch_status) 
                VALUES ('$student_id', '$first_name', '$last_name', '$batch_status')";
                        mysqli_query($db, $query);
            }
        fclose($handle);
        ?>
            <script type="text/javascript">
                window.location.href = 'upload_unifast_grantee.php?updation=1';
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
    $msg = '<label class="text-success">Student Records Update Done</label>';
}
else{
    $msg = " ";
}
//-------------------------------upload csv------------------------------------------------------------------------------//

?>

    <main>
        
        <div class="unifast_grantee_record">
            
            <!----------------------Cards ------------------------------------------------------------>        
            <div class="show_count_stud">

                <div class="card">
                    <p class="card_title">
                        Total No. of UniFAST Grantees
                    </p>
                    <h3 class="card_text">
                        <?php
                            $enrolledstaff = "SELECT * FROM tbl_unifast_grantee";
                            $enrolledstaff_result = mysqli_query($db, $enrolledstaff);
                            $count = mysqli_num_rows($enrolledstaff_result);
                            echo $count;
                        ?>
                    </h3>  
                </div>
            
                <div class="card">
                    <p class="card_title">
                        No. of Old Batch / New Batch
                    </p>
                    <h3 class="card_text">
                        <?php
                            $oldug= "SELECT * FROM tbl_unifast_grantee WHERE batch_status = 'old'";
                            $oldug_result = mysqli_query($db, $oldug);
                            $oldug_count = mysqli_num_rows($oldug_result);
                            
                            $newug = "SELECT * FROM tbl_unifast_grantee WHERE batch_status = 'new'";
                            $newug_result = mysqli_query($db, $newug);
                            $newug_count = mysqli_num_rows($newug_result);
                            echo $oldug_count." / ".$newug_count;
                        ?>
                    </h3>
                    
                </div>
                <!----------------------Form to Upload CSV ------------------------------------------------------------> 
                <div  class="card">
                    
                    <form method="post" enctype='multipart/form-data'>
                        <p>Update UniFAST Grantee Records: Please Select File(Only CSV Format)</p>

                        <div class="input_div_file">
                            <input type="file" class="uploadfile" name="ug_file" 
                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            <input type="submit" class="btn_upload" name="upload" value="Upload" />
                        </div>
                        <p>
                            <?php
                                $message = '';
                            ?>
                        </p>
                    </form>
                </div>
                 <!----------------------Form to Upload CSV ------------------------------------------------------------>
               
            </div>
                <!---------------------Cards ------------------------------------------------------------> 
        

            <!----------------------Show Error or Success Message ------------------------------------------------------------>
            <div class="message">
                <?php echo $msg; ?>
            </div>

            <div class="message">
                <!--success or error-->
                <?php 
                if(isset($_GET['success'])){?>
                    <p>
                        <?php 
                            echo $_GET['success'];
                        ?>
                    </p><?php
                }
                if(isset($_GET['error'])){?>
                    <p>
                        <?php 
                            echo $_GET['error'];
                        ?>
                    </p><?php
                }
                else {
                    
                }?>
                <!--success or error-->
            </div>



                <div class="add_stud_div">
                    <!------Form to Add data to tbl_unifast_grantee. Sends data to add_unifastgrantee.php------------------------------------------------>
                    <form action="Staff/accounting_staff/add_unifastgrantee.php" method="post">
                        <p>Add UniFAST Grantee:</p>
                        <input type="text"  id="lastname" name="lastname" placeholder="Last Name" required>
                        <input type="text"  id="firstname" name="firstname" placeholder="First Name" required>
                        <input type="text"  id="studentid" name="studentid" placeholder="Student ID" required>
                        <select required  id="batchstatus" name="batchstatus">
                            <option value="">Batch-Status</option>
                            <option value="old">old</option>
                            <option value="new">new</option>
                        </select>   
                        <div class="btn_add_container">
                            <button type="submit" class="btn_add" name="add">Add</button>
                        </div>
                    </form>
                    <!------Form to Add data to tbl_unifast_grantee. Sends data to add_unifastgrantee.php------------------------------------------------>
                </div>

            <div class="search_select">
                <div class="row">

                    <div class="form_label">
                        S.N.
                    </div>

                    <div class="form_label">
                        <form action="#" method="POST" onclick="e.preventDefault()" >
                            <select name="alphabetical" id="alphabetical"  onchange="this.form.submit();">
                                <option value="">Last Name</option>
                                <option value="('%')">ALL</option>
                                <option value="'A%'">A</option>
                                <option value="'B%'">B</option>
                                <option value="'C%'">C</option>
                                <option value="'D%'">D</option>
                                <option value="'E%'">E</option>
                                <option value="'F%'">F</option>
                                <option value="'G%'">G</option>
                                <option value="'H%'">H</option>
                                <option value="'I%'">I</option>
                                <option value="'J%'">J</option>
                                <option value="'K%'">K</option>
                                <option value="'L%'">L</option>
                                <option value="'M%'">M</option>
                                <option value="'N%'">N</option>
                                <option value="'O%'">O</option>
                                <option value="'P%'">P</option>
                                <option value="'Q%'">Q</option>
                                <option value="'R%'">R</option>
                                <option value="'S%'">S</option>
                                <option value="'T%'">T</option>
                                <option value="'U%'">U</option>
                                <option value="'V%'">V</option>
                                <option value="'W%'">W</option>
                                <option value="'X%'">X</option>
                                <option value="'Y%'">Y</option>
                                <option value="'Z%'">Z</option>
                            </select>
                        </form>
                    </div>
                    <div class="form_label">First Name</div>
                    <div class="form_label">Student ID No.</div>
                    <div class="form_label">
                        <form action="#" method="POST" onclick="e.preventDefault()" >
                            <select name="batchstate" id="batchstate"  onchange="this.form.submit();">
                                <option value="">Batch Status</option>
                                <option value="('new' OR 'old')">ALL</option>
                                <option value="'old'">OLD</option>
                                <option value="'new'">NEW</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <!--------------------------------------Search box--------------------------------------------------------->
                    
                        <form name="form1" method="get" action="">
                            <div class="search-box">
                                <p>Search UniFAST Grantee:</p>
                            </div>

                            <div class="search-box">
                                <input type="text" autocomplete="off" placeholder="Search student name..." name="search" id="search" value="" required>
                                <div class="result"></div>
                            </div>

                            <div class="search-box">
                                <button type="submit" value="Find" name="formsubmit" id="formsubmit">Search</button>
                            </div>
                        </form>
                <!--------------------------------------Search box--------------------------------------------------------->
                </div>

            </div> 
            
            <div class="student_list_container">
                <!------Shows the result when pressing find---->
                <div id="response"></div>
                <!------Shows the result when pressing find---->
            </div>

     
                
                <?php
                //----------------------Form to Show, Update, Delete Data From tbl_unifast_grantee ------------------------------------------//
                if(isset($_POST['batchstate'])) 
                {
                    $bs = $_POST['batchstate'];
                    

                    //-----------For thepagination-------------//
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } 
                    else {
                        $pageno = 1;
                    }
                    $no_of_records_per_page = 25;
                    $offset = ($pageno-1) * $no_of_records_per_page;

                    $total_pages_sql = "SELECT COUNT(*) FROM tbl_unifast_grantee";
                    $theresult = mysqli_query($db, $total_pages_sql);
                    $total_rows = mysqli_fetch_array($theresult)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    //-----------For thepagination-------------//
                    
                        $ugquery = "SELECT * FROM tbl_unifast_grantee WHERE batch_status = $bs ORDER BY last_name ASC, first_name ASC 
                            LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for thepagination
                        $ugresult = mysqli_query($db, $ugquery);
                        
                        $i=1;
                        ?>

                        <div class="student_list_container">
                            
                        <?php
                        
                        while($row = mysqli_fetch_assoc($ugresult)) 
                        { ?>
                            <!--------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                    
                            <div class="list_group_container">    
                                
                                <form action="Staff/accounting_staff/updatedelete_unifastgrantee.php" method="post">
                                    
                                    <div class="form_list">
                                        <p>
                                            <?php 
                                                echo $offset + $i++;
                                            ?>
                                        </p>
                                        <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $row["last_name"]?>">               
                                        <input type="text" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $row["first_name"]?>">
                                        <input type="text" id="studentid" name="studentid" placeholder="Student Id" value="<?php echo $row["student_id"]?>">
                                        <select name="batchstatus" id="batchstatus" >
                                            <?php $batch_status = $row["batch_status"];
                                            if($batch_status=='old') 
                                            {   ?>
                                                    <option value="old">old</option>
                                                    <option value="new">new</option>
                                                <?php
                                            }
                                            else 
                                            {   ?>
                                                    <option value="new">new</option>
                                                    <option value="old">old</option>
                                                <?php         
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="btn_group" role="group" aria-label="Basic example">
                                        <button class="btn_update" type="submit" name="update">UPDATE</button>
                                        <button class="btn_delete" type="submit" name="delete">DELETE</button>
                                    </div>

                            </form>
                            </div>
                    
                            <!---------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                    <?php
                        }
                    ?>
                    </div>
                    <?php
                
                }//end of isset batch state
                else if(isset($_POST['alphabetical'])) {
                    $alphabetical = $_POST['alphabetical'];


                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } 
                    else {
                        $pageno = 1;
                    }
                    $no_of_records_per_page = 25;
                    $offset = ($pageno-1) * $no_of_records_per_page;


                    $total_pages_sql = "SELECT COUNT(*) FROM tbl_unifast_grantee";
                    $theresult = mysqli_query($db, $total_pages_sql);
                    $total_rows = mysqli_fetch_array($theresult)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    //-----------For thepagination-------------//
                
                    
                    $ugquery = "SELECT * FROM tbl_unifast_grantee WHERE last_name LIKE $alphabetical ORDER BY last_name ASC, first_name ASC 
                        LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for thepagination
                    $ugresult = mysqli_query($db, $ugquery);
                    
                    $count =mysqli_num_rows($ugresult);
                    if ($count > 0) {
                    $i=1;
                    ?>

                    <div class="student_list_container">
                        
                    <?php
                    while($row = mysqli_fetch_array($ugresult)) {?>
                        <!--------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                
                        <div class="list_group_container">    
                            
                            <form action="Staff/accounting_staff/updatedelete_unifastgrantee.php" method="post">
                               
                                <div class="form_list">
                                    <p>
                                        <?php 
                                            echo $offset + $i++;
                                        ?>
                                    </p>
                                    <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $row["last_name"]?>">               
                                    <input type="text" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $row["first_name"]?>">
                                    <input type="text" id="studentid" name="studentid" placeholder="Student Id" value="<?php echo $row["student_id"]?>">
                                    <select name="batchstatus" id="batchstatus" >
                                        <?php $batch_status = $row["batch_status"];
                                        if($batch_status=='old')
                                        {   ?>
                                                <option value="old">old</option>
                                                <option value="new">new</option>
                                            <?php
                                        }
                                        else 
                                        {   ?>
                                                <option value="new">new</option>
                                                <option value="old">old</option>
                                            <?php         
                                        }
                                        ?>
                                    </select>
                                </div>
                                    
                                <div class="btn_group" role="group" aria-label="Basic example">
                                    <button class="btn_update" type="submit" name="update">UPDATE</button>
                                    <button class="btn_delete" type="submit" name="delete">DELETE</button>
                                </div>

                            </form>
                        </div>
                
                        <!---------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                }
                else {
                    if ($alphabetical == "'%'"){
                        echo "The list of UniFAST grantees is empty.";
                    }
                    else {
                        echo "No result for ". substr($alphabetical, 1,-2);
                    }
                }

                }//end of isset alphabetical
                else if (empty($_POST['alphabetical']) && empty($_POST['batchstate'])) {


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
                    //-----------For thepagination-------------//
                
                    
                    $ugquery = "SELECT * FROM tbl_unifast_grantee ORDER BY last_name ASC, first_name ASC 
                        LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for thepagination
                    $ugresult = mysqli_query($db, $ugquery);
                    $i=1;
                    ?>
                    <div class="student_list_container">
                    <?php
                    while($row = mysqli_fetch_array($ugresult)) {?>
                        <!--------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                
                        <div class="list_group_container">    
                            
                            <form action="Staff/accounting_staff/updatedelete_unifastgrantee.php" method="post">
                                
                                <div class="form_list">
                                    <p>
                                        <?php 
                                            echo $offset + $i++;
                                        ?>
                                    </p>
                                    <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $row["last_name"]?>">               
                                    <input type="text" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $row["first_name"]?>">
                                    <input type="text" id="studentid" name="studentid" placeholder="Student Id" value="<?php echo $row["student_id"]?>">
                                    <select name="batchstatus" id="batchstatus" >
                                        <?php $batch_status = $row["batch_status"];
                                        if($batch_status=='old')
                                        {   ?>
                                                <option value="old">old</option>
                                                <option value="new">new</option>
                                            <?php
                                        }
                                        else 
                                        {   ?>
                                                <option value="new">new</option>
                                                <option value="old">old</option>
                                            <?php         
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="btn_group" role="group" aria-label="Basic example">
                                    <button class="btn_update" type="submit" name="update">UPDATE</button>
                                    <button class="btn_delete" type="submit" name="delete">DELETE</button>
                                </div>
     
                            </form>
                        </div>
                
                        <!---------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                        <?php
                    }
                    ?>
                    </div>
                    <?php

                }//end of if empty
                    //----------------------Form to Show, Update, Delete Data From tbl_unifast_grantee ------------------------------------------//
                ?>
           
            <div class="pagination_div">
                <!--------thepagination---------------------------------------------->
                <ul>
                    <li><a href="?pageno=1">First</a></li>
                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                    </li>
                    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                    </li>
                    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                </ul>
                <!--------thepagination---------------------------------------------->

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
       width: 100%;
       padding: 15px;
    }
    main .unifast_grantee_record {
        padding: 0 15px;
    }
        .unifast_grantee_record .show_count_stud {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
    
        .unifast_grantee_record .show_count_stud .card:not(:last-child) {
            background: #fff;
            padding: 22px;
            text-align: center;
            width: 23%;
        }
      
        .unifast_grantee_record .show_count_stud .card p {
            margin-bottom: 20px;
            font-family: 'Roboto';
            font-size: 13px;
            text-transform: uppercase;
        }
        .unifast_grantee_record .show_count_stud .card h3 {
            font-family: 'Roboto Serif';
            font-size: 30px;
            color: #000;
        }
        .unifast_grantee_record .show_count_stud .card:nth-child(3) {
            width: 50%;
            background: #fff;
            padding: 20px;
        }
  
        .unifast_grantee_record .show_count_stud .card:nth-child(3) form {
            width: 100%;
        }
        .unifast_grantee_record .show_count_stud .card:nth-child(3) form p{
            margin-bottom: 20px;
        }
        .input_div_file {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .unifast_grantee_record .show_count_stud .card:nth-child(3) form .input_div_file input[type=file] {
            background: none;
            height: 30px;
            width: 320px;
            border: 1px solid lightgrey;
            cursor: pointer;
        }
        .unifast_grantee_record .show_count_stud .card:nth-child(3) form .input_div_file input[type=submit] {
            height: 30px;
            width: 120px;
            border: none;
            background: #324E9E;
            color: #eee;
            font-family: 'Roboto';
            margin-left: 20px;
            cursor: pointer;
        }
        .unifast_grantee_record .show_count_stud .card:nth-child(3) form .input_div_file input[type=file]::file-selector-button {
            background: #333;
            color: #eee;
            height: 30px;
            border: none;
            font-family: 'Roboto';
            width: 120px;
            line-height: 28px;
            margin-right: 20px;
            cursor: pointer;
        }







        .add_stud_div {
            background: #fff;
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 15px;
        }
        .add_stud_div form {
            display: flex;
            align-items: center;
        }
        .add_stud_div form p {
            font-family: 'Roboto';
            font-size: 13px;
            text-transform: uppercase;
            margin-right: 20px;
        }
        .add_stud_div form input {
            height: 30px;
            width: 200px;
            margin-right: 20px;
            background: #fff;
            border: 1px solid lightgrey;
            padding-left: 15px;
        }
        .add_stud_div form .btn_add_container {
            flex: 1;
        }
        .add_stud_div form .btn_add_container button {
            width: 120px;
            height: 30px;
            background: #324E9E;
            border: none;
            color: #fff;
            float: right;
            cursor: pointer;
        }
   



        .search_select {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
        }
        .search_select .row:nth-child(1) {
            display: flex;
            align-items: center;
            width: 50%;
        }
        .search_select .row:nth-child(1) .form_label {
            width: 25%;
            font-family: 'Roboto';
            font-size: 13px;
            text-transform: uppercase;
            color: #333;
        }
        .search_select .row:nth-child(1) .form_label:not(:first-child) {
            margin-left: 20px;
        }
     
        .search_select .row:nth-child(1) .form_label form select {
            width: 80%;
            border: 1px solid lightgrey;
            color: #333;
            height: 30px;
        }
        .search_select .row:nth-child(2) form {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .search_select .row:nth-child(2) form .search-box p {
            margin-right: 20px;
            font-size: 13px;
            font-family: 'Roboto';
        }
        .search_select .row:nth-child(2) form .search-box input {
            border: 1px solid lightgrey;
            background: none;
            margin-right: 20px;
            height: 30px;
        }
        .search_select .row:nth-child(2) form .search-box button {
            width: 120px;
            height: 30px;
            font-family: 'Roboto';
            background: #324E9E;
            border: none;
            color: #fff;
            cursor: pointer;
        }
        .student_list_container {
            background: #fff;
            margin-top: 15px;
        }

        .list_group_container {
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid lightgrey;
        }
      
        .list_group_container form {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .list_group_container form .form_list {
            display: flex;
            width: 50%;
        }
        .list_group_container form .form_list p {
            width: 25%;
        }
        .list_group_container form .form_list input {
            width: 25%;
            height: 30px;
            padding: 5px;
            border: 1px solid lightgrey;
            margin-left: 15px;
            color: #333;
        }
        .list_group_container form .btn_group {
            background: none;
            display: none;
        }
        .list_group_container form .btn_group button {
            border: none;
            height: 30px;
            width: 120px;
            background: #324E9E;
            color: #eee;
            font-family: 'Roboto';
            cursor: pointer;
        }
        .list_group_container form .btn_group button:nth-child(2) {
            background: #ec3237;
        }
        .list_group_container:hover .btn_group {
            display: block;
        }
        .result {
            background: #fff;
            position: absolute;
            width: 185px;
        }
        .result p {
            margin: 0;
            padding: 8px 5px;
            border: 1px solid lightgrey;
            width: 100%;
            cursor: pointer;
            transition: all .1s ease-in-out;
            font-family: 'Roboto';
        }
        .result p:hover {
            background: #324E9E;
            color: #eee;
        }

.pagination_div {
    margin-top: 15px;
    margin-bottom: 40px;
}
.pagination_div ul {
    list-style-type: none;
    display: flex;
}
.pagination_div ul li {
    padding: 5px;
    border: 1px solid lightgrey;
    margin-left: 5px;
    background: #444;
    cursor: pointer;
}
.pagination_div ul a {
    color: #eee;
    font-family: 'Roboto';
    font-size: 12px;
    text-transform: uppercase;
}


</style>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
/*--------------------------------------Search box script---------------------------------------------------------*/
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("Staff/accounting_staff/unifastgrantee_backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());

        $(this).parent(".result").empty();

    });
});

$(document).ready(function() {
    $('#formsubmit').click(function(){
      
        $.post("Staff/accounting_staff/unifastgrantee_search_name.php", 
        {search: $('#search').val()}, 
        function(data){
            $('#response').html(data);
            $('#thisappointment').hide();
        });
        
        return false;
        
    });

});
/*--------------------------------------Search box script---------------------------------------------------------*/


</script>

