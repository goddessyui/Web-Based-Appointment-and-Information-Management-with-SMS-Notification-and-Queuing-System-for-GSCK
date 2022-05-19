<?php
include("new_header_admin.php");
?>
<main>
    
    <?php include("count_app.php");?>


    <div class="appointment_result">
        
        <div class="row">
            <!--success or error-->
            <?php 
            if(isset($_GET['success'])){
            ?>
            <p>
                <?php echo $_GET['success']; ?>
            </p> <?php
            }
            else{
            }
            if(isset($_GET['error'])){ ?>
                <p>
                    <?php echo $_GET['error']; ?>
                </p> <?php
            }
            else {
               
            }
            ?>
            <!--success or error-->
        </div>

        <div class="row_label">
                    
            <div class="col_app">Appt. date</div>
            <div class="col_app">Date Accepted</div>
            <div class="col_app">/ Requested</div> 
            <div class="col_app">Student Appointment Details</div>
            <div class="col_app">Reschedule</div> 
            <div class="col_app">Comment</div>
            <div class="col_app"></div>
            
        </div>

                <!-------------------------Show Missed Requests ------------------------------>   
            <?php
                    $missedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE DATE(tbl_appointment_detail.appointment_date) < CURDATE() 
                    AND tbl_appointment_detail.status = 'Accepted' 
                    AND tbl_staff_registry.staff_id = '$staff_id' ORDER BY tbl_appointment_detail.appointment_date ASC";
                $missedrequest_result = mysqli_query($db, $missedrequest);

      
            
                    $missedrequest_result = mysqli_query($db, $missedrequest);
                    
                    //check whether the query is executed or not
                    if($missedrequest_result==TRUE) {
                        $count = mysqli_num_rows($missedrequest_result);
                              
                        if($count>0) {

                            while($rows=mysqli_fetch_assoc($missedrequest_result)) { ?>

                                <div class="row_app">
                                    
                                    <div class="col_app">
                                        <p>
                                            <?php echo $rows['appointment_date']; ?>
                                        </p>
                                    </div>

                                    <div class="col_app">
                                        <p>
                                            <?php echo $rows['date_accepted']; ?>
                                        </p>
                                    </div>

                                    <div class="col_app">
                                        <p>
                                            <?php echo $rows['date_created']; ?>
                                        </p>
                                    </div>
                                    
                                    <div class="col_app">
                                        <?php 
                                            ?><p><?php echo $rows['appointment_type']; ?></p><?php
                                            ?><p><?php echo $rows['first_name']." ".$rows['last_name']; ?></p><?php   
                                            ?><p><?php echo $rows['course']."-".$rows['year']; ?></p><?php
                                         
                                            if($rows['note']==""){
                                                ?><p><?php echo "No note."; ?></p><?php
                                            }
                                            else{
                                                ?><p><?php echo $rows['note']; ?></p><?php
                                            }
                                        ?>
                                    </div>
                                    

                                    <div class="col_app">
                                        <!-------------------------To reschedule appointment. Send Form Data to reschedule.php --------------------------->       
                                        <form action="appointment/reschedule.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
                                            <input type="date" name="appointment_date" id="appointment_date"
                                                value="<?php echo $rows["appointment_date"]; ?>" 
                                                min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                                strtotime($rows["appointment_date"]. ' + 90 days'));?>">
                                            <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                            <input type="hidden" name="comment" value="<?php echo $rows['comment'];?>">
                                            <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                            <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>"> 
                                            <input id="reschedule" type="submit" name="reschedule" value="RESCHEDULE">
                                        </form>
                                        <!-------------------------Send Form Data to reschedule.php ------------------------------>   
                                    </div>  

                                    <div class="col_app">
                                        <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php ---------------------->  
                                        <form action ="appointment/cancel_missed.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">

                                            <textarea type="textarea" name="comment" placeholder="Comment here..."><?php echo $rows['comment'];?></textarea><br><br>
                                            <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                            <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                            <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                            <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                            
                                        <!-------------------------Send Form Data to cancel.php ------------------------------>
                                    </div>  

                                    <div class="col_app">
                                            <div>
                                                <input id="cancel" type="submit" name="cancel" value="CANCEL">
                                            </div>
                                        </form>
                                        
                                        <!-------------------------Send data to done.php ------------------------------>  
                                        <div>
                                            <button type="submit" id="done"><a href="appointment/done_missed.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
                                            DONE</a>
                                            </button>
                                        </div>
                                        <!-------------------------Send data to done.php ------------------------------> 
                                    </div>   
                                    
                                </div> <?php 
                            }
                        }
                        else {
                            echo "<p class='no_appt_result'>No Missed Appointments.</p>";
                        }
                    }?>
            
        <!-------------------------Show Missed Requests ------------------------------>  
    </div>
        <?php
        include("backtotop.php");
        ?>  
</main>

</div>
</div>

<div class="mobile_header"></div>

</body>
</html>

<style>
    #missedrequests {
        background: #324e9e;
    }
    #missedrequests .card_title,
    #missedrequests .card_body {
        color: #fff;
    }
</style>