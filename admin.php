<?php 
    include("admin_header.php");
?>

    <main>
        <div class="container-fluid">
            
            <!---------------Reports for Registrar------------------------------------------------->
            <?php
            if ($position == "Registrar") {//Start of show if Registrar?>
            
                <div class="row">
                    <h3>GSCK Data</h3>
                </div>

                <div class="row">
                
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No. of Enrolled Students</h5>
                                <p>
                                <?php
                                    $enrolledstudents = "SELECT COUNT(*) AS total FROM tbl_student_record";
                                    $enrolledstudents_result = mysqli_query($db, $enrolledstudents);
                                    $count =mysqli_fetch_assoc($enrolledstudents_result);
                                    echo $count['total'];
                                ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No. of Employed Staff</h5>
                                <p>
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

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No. of Registered Students</h5>
                                <p>
                                <?php
                                    $registeredstudents = "SELECT * FROM tbl_student_registry";
                                    $registeredstudents_result = mysqli_query($db, $registeredstudents);
                                    $count = mysqli_num_rows($registeredstudents_result);
                                    echo $count;
                                ?>
                            </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No. of Registered Staff</h5>
                                <p>
                                <?php
                                    $registeredstaff = "SELECT * FROM tbl_staff_registry";
                                    $registeredstaff_result = mysqli_query($db, $registeredstaff);
                                    $count = mysqli_num_rows($registeredstaff_result);
                                    echo $count;
                                ?>
                            </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total No. of Appointments</h5>
                                <p>
                                <?php
                                    $app = "SELECT * FROM tbl_appointment_detail WHERE `status`='Accepted'";
                                    $app_result = mysqli_query($db, $app);
                                    $count = mysqli_num_rows($app_result);
                                    echo $count;
                                ?>
                            </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total No. of Appointments Today</h5>
                                <?php   
                                    date_default_timezone_set('Asia/Manila');                           		
                                    $currentdate = date("Y-m-d");

                                    $app = "SELECT * FROM tbl_appointment_detail WHERE appointment_date = '$currentdate' 
                                        AND `status`=('Accepted' OR 'Cancelled')";

                                    $app_today = mysqli_query($db, $app);
                                    $count = mysqli_num_rows($app_today);
                                    echo $count;
                                    
                                ?>
                            </div>
                        </div>
                    </div>
                
                </div> 
                
                <div class="row">
                    <h3>My Appointments</h3>
                </div>
            
            <?php
            }//End of show if Registrar
            ?>
            <!---------------Reports for Registrar------------------------------------------------->

            

            <?php
                include("count_app.php");
            ?>

            


            <!---------------Limit Appointments and Show List of Students and Staff, only seen by Registrar------------------------------------------------->
                <?php 
            if ($position == "Registrar") {
            ?>
                <div class="row">
                    <div class="col-6">

                        <form action="appointment_limit.php" method="post">
                            <h5>Limit the No. of Appointments Per Day:</h5>
                            <?php
                                $limit = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
                                $limitvalue= mysqli_query($db, $limit);
                                if($limitvalue==TRUE){
                                    while($al=mysqli_fetch_assoc($limitvalue)){
                            ?>
                                        <input type="text" name="limit_value" value="<?php echo $al['appointment_limit'];?>" 
                                        min="1" max="5000">
                                        <input type="submit" name="limit" value="Limit">
                            <?php
                                    }
                                }
                            ?>
                        </form>
                    
                    <div>

                    
                    <div class="col-6">
                        <!--success or error-->                        
                        <?php 
                            if(isset($_GET['success'])){
                        ?>
                                <p>
                                    <?php 
                                        echo $_GET['success'];
                                    ?>
                                </p>
                        <?php
                            }
                            if(isset($_GET['error'])){
                        ?>
                                        <p>
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

                <div class="row">

                    <div class="col-sm-6">
                        <div class="row">

                        <h4>Registered Staff</h4>
                        <?php

                        //-----------For pagination-------------//
                        if (isset($_GET['pageno'])) {
                            $pageno = $_GET['pageno'];
                        } else {
                            $pageno = 1;
                        }
                        $no_of_records_per_page = 10;
                        $offset = ($pageno-1) * $no_of_records_per_page;


                        $total_pages_sql = "SELECT COUNT(*) FROM tbl_staff_registry";
                        $theresult = mysqli_query($db, $total_pages_sql);
                        $total_rows = mysqli_fetch_array($theresult)[0];
                        $total_pages = ceil($total_rows / $no_of_records_per_page);
                        //-----------For pagination-------------//
                        $staff="SELECT * FROM tbl_staff_registry ORDER BY last_name ASC, first_name ASC LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for pagination
                        $staff_result = mysqli_query($db, $staff);
                        
                        //check whether the query is executed or not
                        if($staff_result==TRUE) { // count rows to check whether we have data in database or not
                            $count = mysqli_num_rows($staff_result);
                            //check the num of rows                 
                            if($count>0) { //we have data in database
                                $i = 1;
                                while($rows=mysqli_fetch_assoc($staff_result)) {
                        ?>
                                    <div>
                                        <td>
                                            <?php   
                                                    echo $offset + $i++; 
                                            ?>
                                        </td>
                                        <?php echo $rows['last_name'].", ".$rows['first_name'] . " - " . $rows['staff_id']; ?>
                                    </div>
                        <?php 
                                }
                            } 
                            else{
                                echo "No Staff Registered in the System.";
                            }
                        }  
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

                    <div class="col-sm-6">
                        <div class="row">

                        <h4>Registered Students</h4>
                        <?php

                        //-----------For pagination-------------//
                        if (isset($_GET['pageno'])) {
                            $pageno = $_GET['pageno'];
                        } else {
                            $pageno = 1;
                        }
                        $no_of_records_per_page = 10;
                        $offset = ($pageno-1) * $no_of_records_per_page;


                        $total_pages_sql = "SELECT COUNT(*) FROM tbl_student_registry";
                        $theresult = mysqli_query($db, $total_pages_sql);
                        $total_rows = mysqli_fetch_array($theresult)[0];
                        $total_pages = ceil($total_rows / $no_of_records_per_page);
                        //-----------For pagination-------------//
                        $staff="SELECT * FROM tbl_student_registry ORDER BY last_name ASC, first_name ASC LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for pagination
                        $staff_result = mysqli_query($db, $staff);
                        
                        //check whether the query is executed or not
                        if($staff_result==TRUE) { // count rows to check whether we have data in database or not
                            $count = mysqli_num_rows($staff_result);
                            //check the num of rows                 
                            if($count>0) { //we have data in database
                                $i = 1;
                                while($rows=mysqli_fetch_assoc($staff_result)) {
                        ?>
                                    <div>
                                        <td>
                                            <?php   
                                                    echo $offset + $i++; 
                                            ?>
                                        </td>
                                        <?php echo $rows['last_name'].", ".$rows['first_name'] . " - " . $rows['student_id']; ?>
                                    </div>
                        <?php 
                                }
                            } 
                            else{
                                echo "No Student Registered in the System.";
                            }
                        }  
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
                                  
                </div>
            <?php
            }
            ?><!---------------Limit Appointments and Show List of Students and Staff, only seen by Registrar------------------------------------------------->
            
            <!--------------------- Appointment Limit and Show List of Students and Staff, only seen by Accounting Staff------------------------------------------>
            <?php
            if($position=="Accounting Staff/Scholarship Coordinator" OR $position=="Teacher") { 
            ?>
                <div class="row">

                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Allowed No. of Appointment Slots Today:</h5>
                                <?php
                                    $applimit = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
                                    $al = mysqli_query($db, $applimit);
                                    
                                    $limit= mysqli_fetch_assoc($al);
                                        echo $limit['appointment_limit'];

                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No. of Appointment Slots Taken Today:</h5>
                                <?php
                                    date_default_timezone_set('Asia/Manila');                           		
                                    $currentdate = date("Y-m-d");
                                    
                                    $applimit = "SELECT appointment_detail_id FROM tbl_appointment_detail 
                                        WHERE `status` = ('Accepted' OR 'Cancelled') 
                                        AND appointment_date = '$currentdate'";
                                    $al = mysqli_query($db, $applimit);
                                    $count = mysqli_num_rows($al);

                                    echo $count; 
                        ?>
                            </div>
                        </div>                
                    </div>  

                </div>
                
                <div class="row">
               
                    <div class="col-sm-6">
                        <div class="row">

                        <h4>Unifast Grantees</h4>
                        <?php

                        //-----------For pagination-------------//
                        if (isset($_GET['pageno'])) {
                            $pageno = $_GET['pageno'];
                        } else {
                            $pageno = 1;
                        }
                        $no_of_records_per_ug_page = 10;
                        $offset = ($pageno-1) * $no_of_records_per_ug_page;


                        $total_pages_sql = "SELECT COUNT(*) FROM tbl_unifast_grantee";
                        $theresult = mysqli_query($db, $total_pages_sql);
                        $total_rows = mysqli_fetch_array($theresult)[0];
                        $total_pages = ceil($total_rows / $no_of_records_per_ug_page);
                        //-----------For pagination-------------//
                        $ug="SELECT * FROM tbl_unifast_grantee ORDER BY last_name ASC, first_name ASC LIMIT $offset, $no_of_records_per_ug_page"; //LIMIT $offset, $no_of_records_per_page is for pagination
                        $ug_result = mysqli_query($db, $ug);
                        
                        //check whether the query is executed or not
                        if($ug_result==TRUE) { // count rows to check whether we have data in database or not
                            $count = mysqli_num_rows($ug_result);
                            //check the num of rows                 
                            if($count>0) { //we have data in database
                                $i = 1;
                                while($rows=mysqli_fetch_assoc($ug_result)) {
                        ?>
                                    <div>
                                        <td>
                                            <?php   
                                                    echo $offset + $i++; 
                                            ?>
                                        </td>
                                        <?php echo $rows['last_name'].", ".$rows['first_name'] . " - " . $rows['student_id']; ?>
                                    </div>
                        <?php 
                                }
                            } 
                            else{
                                echo "No Student Registered in the System.";
                            }
                        }  
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

                </div>
            
            <?php
            }
            ?> <!--------------------- Appointment Limit and Show List of Students and Staff, only seen by Accounting Staff------------------------------------------>

            


            

        </div>
    </main>
</body>
</html>

<style>
    main {
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 100px;
    }

</style>

 


