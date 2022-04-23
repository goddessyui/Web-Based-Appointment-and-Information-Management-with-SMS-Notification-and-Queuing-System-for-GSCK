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
        #missedrequests{
            background-color: #fcd228;
            color: #324e9e;
        }
    </style>

    <div class="row">
        <h2>Missed Appointments</h2> 
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
        <div class="col_app" id="serialno"></div>
        <div class="col_app" id="appdate">Appt. Date</div>
        <div class="col_app" id="apptype">Appt.Type</div>
        <div class="col_app" id="studentname">Student</div> 
        <div class="col_app" id="studnote">Student's Note</div>
        <div class="col_app" id="resched">Reschedule</div> 
        <div class="col_app" id="comment">Comment</div>
        <div class="col_app" id="canceldone"></div>
    </div>

<!-------------------------Show Missed Requests ------------------------------>   
        <?php
                $missedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE DATE(tbl_appointment_detail.appointment_date) < CURDATE() 
                    AND tbl_appointment_detail.status = 'Accepted' 
                    AND tbl_staff_registry.staff_id = '$staff_id' 
                    ORDER BY tbl_appointment_detail.appointment_date ASC";
        
                $missedrequest_result = mysqli_query($db, $missedrequest);
                
                //check whether the query is executed or not
                if($missedrequest_result==TRUE) 
                { // count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($missedrequest_result);  //function to get all the rows in database
                    //check the num of rows                 
                    if($count>0) //we have data in database
                    {
                        $i = 1;
                        while($rows=mysqli_fetch_assoc($missedrequest_result)) 
                        //using while loop to get all the date from database
                        //and while loop will run as long as we have data in database
                        {
            ?>              
                        <div class="row_app">
                            <div class="col_app" id="serialno">
                                <?php echo $i++; ?>
                            </div>
                            
                            <div class="col_app" id="appdate">
                                <?php echo $rows['appointment_date']; ?>
                                <small>
                                    <p><b>Date Accepted:</b></p><p><?php echo $rows['date_accepted']; ?></p> 
                                    <p><b>Date Requested:</b></p><p><?php echo $rows['date_created']; ?></p>
                                </small> 
                            </div>

                            <div class="col_app" id="apptype">
                                <?php echo $rows['appointment_type']; ?>
                            </div>

                            <div class="col_app" id="studentname">
                                <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                <small>
                                    <p><b>Course and Year:</b></p><p><?php echo $rows['course']." ".$rows['year']; ?></p>
                                </small>
                            </div> 
                            <div class="col_app" id="studnote">
                                <?php
                                if($rows['note']==""){
                                    echo "No note.";
                                }
                                else{
                                    ?><?php echo $rows['note'];  ?><?php
                                }
                                ?>
                            </div>
                            <div class="col_app" id="resched">
                                <?php
                                    date_default_timezone_set('Asia/Manila');                           		
                                    $currentdate = date("Y-m-d");
                                ?>
                                 <!-------------------------To reschedule appointment. Send Form Data to reschedule.php --------------------------> 
                                <form action="appointment/reschedule_missed.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                    <input type="date" name="appointment_date" id="appointment_date" value="<?php echo $rows["appointment_date"]; ?>" 
                                        min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                        strtotime($rows["appointment_date"]. ' + 90 days'));?>">
                                    <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                    <input type="hidden" name="comment" value="<?php echo $rows['comment'];?>">
                                    
                                    <input id="reschedule" type="submit" name="reschedule" value="RESCHEDULE">
                                </form>
                                <!-------------------------Send Form Data to reschedule.php ------------------------------>    
                            </div> 
                            <div class="col_app" id="comment">
                                <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php --------------------->  
                                <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">
                                    <label>Comment:</label><br>
                                    <textarea type="textarea" name="comment"><?php echo $rows['comment'];?></textarea>
                            </div>
                            <div class="col_app" id="canceldone">
                                <input id="cancel" type="submit" name="cancel" value="CANCEL"><br>
                                </form>
                                <!-------------------------Send Form Data to cancel.php ------------------------------>
                                <!-------------------------Send data to done.php ------------------------------>  
                                <button type="submit" id="done"><a href="appointment/done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
                                DONE</a> </button>
                                <!-------------------------Send data to done.php ------------------------------> 
                            </div>

                        </div>
            <?php 
                        }
                    }
                    else {
                        echo "No Missed Appointments.";
                    }
                }
	    ?>
         
<!-------------------------Show Missed Requests ------------------------------>  

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
    #serialno {
        width: 2%;

    }
    #appdate {
        width: 14%;
    }
    #apptype{
        width: 14%;
    }
    #appdate small{
        font-size: 10px;
    }
    #studentname{
        width: 14%;
    }
  
    #studnote{
        width: 14%;
    }
    #resched{
        width: 14%;
    }
    #comment{
        width: 14%;
    }
    #canceldone{
        width: 14%;
    }
    #done, #cancel, #appointment_date, #reschedule {
        width: 100%;
    }
    
  
</style>