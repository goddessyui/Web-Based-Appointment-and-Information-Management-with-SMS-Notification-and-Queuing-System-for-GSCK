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
    $msg = "";
}
//-------------------------------upload csv------------------------------------------------------------------------------//

?>

    <main>
        
        <div class="unifast_grantee_record">

            
            <h3>UniFAST Grantee Records</h3>
            
            <!----------------------Cards ------------------------------------------------------------>        
            <div class="row">

                <div class="col_3">
                    <div class="card">

                        <div class="card_title">
                            Total No. of UniFAST Grantees
                        </div>

                        <div class="card_body">
                        
                            <div class="card_text">
                               
                                    <?php
                                        $enrolledstaff = "SELECT * FROM tbl_unifast_grantee";
                                        $enrolledstaff_result = mysqli_query($db, $enrolledstaff);
                                        $count = mysqli_num_rows($enrolledstaff_result);
                                        echo $count;
                                    ?>
                              
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col_3">
                    <div class="card">
                        <div class="card_title">
                            No. of Old UniFAST Grantees
                        </div>

                        <div class="card_body">
                        
                            <div class="card_text">
                           
                                    <?php
                                        $enrolledstaff = "SELECT * FROM tbl_unifast_grantee WHERE batch_status = 'old'";
                                        $enrolledstaff_result = mysqli_query($db, $enrolledstaff);
                                        $count = mysqli_num_rows($enrolledstaff_result);
                                        echo $count;
                                    ?>
                        
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col_3">
                    <div class="card">
                        <div class="card_title">
                            No. of New UniFAST Grantees
                        </div>

                        <div class="card_body">
                        
                            <div class="card_text">
                                <?php
                                    $enrolledstaff = "SELECT * FROM tbl_unifast_grantee WHERE batch_status = 'new'";
                                    $enrolledstaff_result = mysqli_query($db, $enrolledstaff);
                                    $count = mysqli_num_rows($enrolledstaff_result);
                                    echo $count;
                                ?>
                            </div>

                        </div>

                    </div>
                </div>
                
            </div>
                <!---------------------Cards ------------------------------------------------------------> 
        
        
            <!----------------------Form to Upload CSV ------------------------------------------------------------> 
            <div class="row">

                <div  class="form_group">
                    <div class="message"><?php echo $msg; ?></div>
                    <form method="post" enctype='multipart/form-data'>
                        <label>Update UniFAST Grantee Records: <small>Please Select File(Only CSV Format)</small></label>
                        <input type="file" class="uploadfile" name="ug_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                        <p>
                            <?php
                                $message = '';
                            ?>
                        </p>
                        <input type="submit" class="btn_upload" name="upload" value="Upload" />
                    </form>
                </div>
                
            </div>
            <!----------------------Form to Upload CSV ------------------------------------------------------------>
            <!----------------------Show Error or Success Message ------------------------------------------------------------>
        

        
            <div class="row">

                <div class="form_group">

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
                            echo "This is a sample success or error message. Please delete.";
                        }?>
                        <!--success or error-->
                    </div>

                    
                    <!----------------------Show Error or Success Message ------------------------------------------------------------>
                    <div class="form_inline">
                        <!------Form to Add data to tbl_unifast_grantee. Sends data to add_unifastgrantee.php------------------------------------------------>
                        <form action="Staff/accounting_staff/add_unifastgrantee.php" method="post">
                            <label><div class="left_counter">Add UniFAST Grantee:</div></label>
                            <input type="text"  id="lastname" name="lastname" placeholder="Last Name" required>
                            <input type="text"  id="firstname" name="firstname" placeholder="First Name" required>
                            <input type="text"  id="studentid" name="studentid" placeholder="Student ID" required>
                            <select required  id="batchstatus" name="batchstatus">
                                <option value="">Batch-Status</option>
                                <option value="old">old</option>
                                <option value="new">new</option>
                            </select>   
                            
                            <button type="submit" class="btn_add" name="add">Add</button>
                        </form>
                        <!------Form to Add data to tbl_unifast_grantee. Sends data to add_unifastgrantee.php------------------------------------------------>
                    </div>

                </div>

            </div>

            <div class="row">
                <!--------------------------------------Search box--------------------------------------------------------->
                <div class="form_group">
                    <form name="form1" method="get" action="">
                        <div class="search-box"><label>Search UniFAST Grantee:</label></div>
                        <div class="search-box">
                            <input type="text" autocomplete="off" placeholder="Search student name..." name="search" id="search" value="" required>
                            <div class="result"></div>
                        </div>
                        <div class="search-box">
                            <button type="submit" value="Find" name="formsubmit" id="formsubmit">Search</button>
                        </div>
                    </form>
                
                    <!------Shows the result when pressing find---->
                    <div id="response"></div>
                    <!------Shows the result when pressing find---->
                </div>

                <!--------------------------------------Search box--------------------------------------------------------->

            </div>

                            
            <div class="row">
                <div class="form_group">
                    <div class="form_inline">
                        <div class="form_label">No.</div>
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
                </div>
                <?php
                //----------------------Form to Show, Update, Delete Data From tbl_unifast_grantee ------------------------------------------//
                if(isset($_POST['batchstate'])) {
                    $bs = $_POST['batchstate'];
                

                    //-----------For thepagination-------------//
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
                
                    
                    $ugquery = "SELECT * FROM tbl_unifast_grantee WHERE batch_status = $bs ORDER BY last_name ASC, first_name ASC 
                        LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for thepagination
                    $ugresult = mysqli_query($db, $ugquery);
                    
                    $i=1;
                    
                    while($row = mysqli_fetch_assoc($ugresult)) {?>
                        <!--------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                
                        <div class="form_group">    
                            
                            <form action="Staff/accounting_staff/updatedelete_unifastgrantee.php" method="post">
                                
                                <div class="form_inline" >
                                    <div class="form_list">
                                        <label><div class="left_counter"><?php echo $offset + $i++;?></div></label>
                                        <input type="text"  id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $row["last_name"]?>">               
                                        <input type="text"  id="firstname" name="firstname" placeholder="First Name" value="<?php echo $row["first_name"]?>">
                                        <input type="text"  id="studentid" name="studentid" placeholder="Student Id" value="<?php echo $row["student_id"]?>">
                                        <select name="batchstatus"  id="batchstatus" >
                                            <?php $batch_status = $row["batch_status"];
                                            if($batch_status=='old'){?>
                                                <option value="old">old</option>
                                                <option value="new">new</option>
                                                <?php
                                            }
                                            else {?>
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

                                </div>
                                
                            </form>
                        </div>
                
                        <!---------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                        <?php
                    }
                
                }//end of isset batch state

                else if(isset($_POST['alphabetical'])) {
                    $alphabetical = $_POST['alphabetical'];


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
                
                    
                    $ugquery = "SELECT * FROM tbl_unifast_grantee WHERE last_name LIKE $alphabetical ORDER BY last_name ASC, first_name ASC 
                        LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for thepagination
                    $ugresult = mysqli_query($db, $ugquery);
                    
                    $count =mysqli_num_rows($ugresult);
                    if ($count > 0) {
                    $i=1;
                    
                    while($row = mysqli_fetch_array($ugresult)) {?>
                        <!--------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                
                        <div class="form_group">    
                            
                            <form action="Staff/accounting_staff/updatedelete_unifastgrantee.php" method="post">
                                
                                <div class="form_inline" >
                                    <div class="form_list">
                                        <label><div class="left_counter"><?php echo $offset + $i++;?></div></label>
                                        <input type="text"  id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $row["last_name"]?>">               
                                        <input type="text"  id="firstname" name="firstname" placeholder="First Name" value="<?php echo $row["first_name"]?>">
                                        <input type="text"  id="studentid" name="studentid" placeholder="Student Id" value="<?php echo $row["student_id"]?>">
                                        <select name="batchstatus"  id="batchstatus" >
                                            <?php $batch_status = $row["batch_status"];
                                            if($batch_status=='old'){?>
                                                <option value="old">old</option>
                                                <option value="new">new</option>
                                                <?php
                                            }
                                            else {?>
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

                                </div>
                                
                            </form>
                        </div>
                
                        <!---------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                        <?php
                    }
                }
                else {
                    if ($alphabetical == "'%'"){
                        echo "The list of UniFAST grantees is empty.";
                    }
                    else{
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
                    
                    while($row = mysqli_fetch_array($ugresult)) {?>
                        <!--------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                
                        <div class="form_group">    
                            
                            <form action="Staff/accounting_staff/updatedelete_unifastgrantee.php" method="post">
                                
                                <div class="form_inline" >
                                    <div class="form_list">
                                        <label><div class="left_counter"><?php echo $offset + $i++;?></div></label>
                                        <input type="text"  id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $row["last_name"]?>">               
                                        <input type="text"  id="firstname" name="firstname" placeholder="First Name" value="<?php echo $row["first_name"]?>">
                                        <input type="text"  id="studentid" name="studentid" placeholder="Student Id" value="<?php echo $row["student_id"]?>">
                                        <select name="batchstatus"  id="batchstatus" >
                                            <?php $batch_status = $row["batch_status"];
                                            if($batch_status=='old'){?>
                                                <option value="old">old</option>
                                                <option value="new">new</option>
                                                <?php
                                            }
                                            else {?>
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

                                </div>
                                
                            </form>
                        </div>
                
                        <!---------Send Form Data to updatedelete_unifastgrantee.php---------------------------------------------->
                        <?php
                    }

                }//end of if empty
                    //----------------------Form to Show, Update, Delete Data From tbl_unifast_grantee ------------------------------------------//
                ?>
            </div>
            
            <div class="row">
                <!--------thepagination---------------------------------------------->
                <ul class="thepagination">
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
        padding: 0;
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 80px;
    }
   
    .row {
        width: 100%;
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        background-color: #fafafa;
        padding: 10px;
        text-align: center;
    }
    .row h3 {
        text-align: center;
    }
    .col_3{
        width: 320px;
        margin-bottom: 10px;
        margin-left:auto;
        margin-right:auto;
    }
    .card {
        text-align: center;
    }
    .card_title{
        background-color: #324e9e;
        padding-top: 20px;
        padding-bottom: 20px;
        color: #fff;
    }
    .card_body {
        background-color: white;
        font-size: 20px;
        color: #324e9e;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    #formsubmit {
        background-color: #324e9e;
        color: #fff;
        padding: 5px;
        padding-left: 25px;
        padding-right: 25px;
        border-radius: 25px;
    }
    .form_group {
      width: 100%;
      margin: auto;
      min-width: 300px;
    }

    h3 {
       text-align: center;
    }
    .form_inline {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 5px;
        margin-top: 5px;
        background-color: #dedede;
        padding: 10px;
        min-width: 250px;
       
    }
    .form_inline:hover .btn_group {
        display: block;
    }

    .form_inline .left_counter{
        width: 150px;
        float: left;
    }
    .form_inline input{
        width: 150px;
    }
    .form_inline select {
        width: 150px;
        text-align: center;
    }
    .form_inline .form_label {
        width: 150px;
       
    }
    .uploadfile {
        border: 0.5px solid gray;
    }
    .message {
        color: #324e9e;
    }
    .btn_group{
        display: none;
        width: 150px;
    }
    .btn_update {
        margin-top: 1px;
        margin-left: 10px;
        border-radius: 0.5em 0 0 0.5em;
        padding-top: 1px;
        padding-bottom: 1px;
        padding-left: 5px;
        padding-right: 5px;
        background-color: #324e9e;
        border: 1px solid #324e9e;
        color: #fff;
    }
   
    .btn_delete {
        margin-top: 1px;
        border-radius: 0 0.5em 0.5em 0;
        border: 1px solid #ec3237;
        padding-top: 1px;
        padding-bottom: 1px;
        padding-left: 5px;
        padding-right: 5px;
        background-color: #ec3237;
        color: #fff;
    }
    .btn_add, .btn_upload {
        background-color: var(--blue);
        color: #fff;
        padding: 5px;
        padding-left: 25px;
        padding-right: 25px;
        border-radius: 25px;
    }
    .thepagination {
        display: flex;
        flex-wrap: wrap;
        
    }
    .thepagination li {
        border: 1px solid lightgray;
        padding: 5px; 
    }
    .thepagination li a {
        text-decoration: none;
    }


  /* Formatting search box */
  .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
        z-index: 2;
       
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        top: 100%;
        left: 0;
        background-color: white;
        
    }
    .search-box input[type="text"], .result{
        width: 100%;
       
    }
    /* End of Formatting search box */
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
    /* End of Formatting result items */
    
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

