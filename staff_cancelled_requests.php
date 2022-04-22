<?php
include("admin_header.php");
?>
<main>
    <div class="row">
        <?php
                include("count_app.php");
        ?>
    </div>
    <style>
        #cancelledrequests{
            background-color: #fcd228;
            color: #324e9e;
        }
    </style>

    <div class="row">
        <h2>Cancelled Appointments</h2> 
    </div>

    <div class="row">
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
    
    <div class="row_app">
        <div class="col_app" id="serialnum"></div>
        <div class="col_app" id="apptdate">Cancellation Date</div>
        <div class="col_app" id="appttype">Appt.Type</div>
        <div class="col_app" id="studentfullname">Student</div> 
        <div class="col_app" id="thestudnote">Student's Note</div>
        <div class="col_app" id="staffcomment">Comment</div>
    </div>

    <div>
<!-------------------------Show Declined Requests in Descending Order or From Most Current------------------------------>  
        <?php
    
            $cancelledrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                WHERE tbl_appointment_detail.status = 'Cancelled' AND tbl_appointment.staff_id = '$staff_id' 
                ORDER BY appointment_date DESC";
            $cancelledrequest_result = mysqli_query($db, $cancelledrequest);
            
            //check whether the query is executed or not
            if($cancelledrequest_result==TRUE) 
            { // count rows to check whether we have data in database or not
                $count = mysqli_num_rows($cancelledrequest_result);
                //check the num of rows                 
                if($count>0) //we have data in database
                {
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($cancelledrequest_result)) 
                    //using while loop to get all the date from database
			        //and while loop will run as long as we have data in database
                    {
        ?>
                                            
                        <div class="row_app">
                            <div class="col_app" id="serialnum">
                                <?php   
                                    echo $i++; 
                                ?>
                            </div>

                            <div class="col_app" id="apptdate">
                                <?php echo $rows['appointment_date']; ?>
                            </div>

                            <div class="col_app" id="appttype">
                                <?php echo $rows['appointment_type']; ?>
                                <small>
                                    <p><b>Date Accepted:</b></p><p><?php echo $rows['date_accepted']; ?></p> 
                                    <p><b>Date Requested:</b></p><p><?php echo $rows['date_created']; ?></p>
                                </small>
                            </div>

                            <div class="col_app" id="studentfullname">
                                <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                <small>
                                    <p><b>Course and Year:</b></p><p><?php echo $rows['course']." ".$rows['year']; ?></p>
                                </small>
                            </div>

                            <div class="col_app" id="thestudnote">
                                <?php
                                if($rows['note']==""){
                                    echo "No note.";
                                }
                                else{
                                    ?><pre><?php echo $rows['note'];  ?></pre><?php
                                }
                                ?>
                            </div>

                            <div class="col_app" id="staffcomment">
                            <?php
                                if($rows['note']==""){
                                    echo "No note.";
                                }
                                else{
                                    ?><pre><?php echo $rows['comment'];  ?></pre><?php
                                }
                                ?>
                            </div>
                            
                        </div>
                        
        <?php 
                    }
                } 
                else{
                    echo "No Cancelled Appointments.";
                }
            }  
	    ?>
<!-------------------------Show Declined Requests ------------------------------>          
    </div>
    
</main>

<style>

*{
        box-sizing: border-box;
    }
   main {
        padding: 0;
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 50px;
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
    h2{
        width: 100%;
        align-items: center;
    }
    
    .row_app {
       background-color: #dedede;
       margin-bottom: 10px;
       display: flex;
       justify-content: space-between;
       width: 100%;
    }
    .col_app{
       margin: 3px;
       
        text-align: center;
    }
    #serialnum {
        width: 4%;

    }
    #apptdate {
        width: 16%;
    }
    #appttype{
        width: 16%;
    }
    #appttype small{
        font-size: 10px;
    }
    #studentfullname{
        width: 16%;
    }
  
    #thestudnote{
        width: 16%;
    }

    #staffcomment{
        width: 16%;
    }
  
    
    
  
</style>