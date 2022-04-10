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


            <!---------------Set Appointment Limit only seen by Registrar------------------------------------------------->
                <?php 
            if ($position == "Registrar"){
            ?>
                <div>
                    <div><br><br>
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
                    </div>
                    <div>
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
            <?php
            }
            ?>
            
            <!---------------Set Appointment Limit------------------------------------------------->
            <div>
                <div>
                    
                    <?php
                        if($position=="Accounting Staff/Scholarship Coordinator" OR $position=="Teacher"){
                            ?>
                                <h4>Allowed No. of Appointment Slots Today:</h4>
                            <?php
                            $applimit = "SELECT * FROM tbl_appointment_limit WHERE limit_id = '1'";
                            $al = mysqli_query($db, $applimit);
                            while($limit= mysqli_fetch_assoc($al)){
                                echo $limit['appointment_limit'];
                            }
                    
                    ?>
                </div>
                <div>
                    
                                <h4>No. of Appointment Slots Taken Today:</h4>
                            <?php
                            date_default_timezone_set('Asia/Manila');                           		
                            $currentdate = date("Y-m-d");
                            $applimit = "SELECT appointment_detail_id FROM tbl_appointment_detail 
                                WHERE `status` = ('Accepted' OR 'Cancelled') 
                                AND appointment_date = '$currentdate'";
                            $al = mysqli_query($db, $applimit);
                            $count = mysqli_num_rows($al);
                            echo $count;
                        }
                    ?>
                </div>
                
                
            </div>

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

 


