<?php
include("admin_header.php");
?>


<main>

    <?php include("count_app.php"); ?>

    <div class="appointment_result">

       <!-------------------------Sort Requests By Date------------------------------> 
       <div class="row">
            <?php 
                date_default_timezone_set('Asia/Manila');                           		
                $currentdate = date("Y-m-d");
            ?>
            <form action="#" method="post" onSubmit="return savesortdate()">

                <input type="date" name="sortbydate" id="sort_date" value="<?php echo $currentdate;?>" 
                min="<?php echo date('Y-m-d', strtotime($currentdate. ' - 90 days'));?>" 
                max="<?php echo date('Y-m-d', strtotime($currentdate. ' + 90 days'));?>">
                <input type="submit" name="searchbydate" id="searchbydate" value="SORT BY DATE">
                <input type="submit" onclick="deletestorage()" name="show_all" id="show_all" value="SHOW ALL">
                
            </form>
        </div>
            
        <!-------------------------Sort Requests By Date ------------------------------> 

        <div class="row" id="error_appt">
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

     
                                



        <!-------------------------Show Accepted Requests ------------------------------>   
    
            
            <?php
                //-------------------------Show Accepted Requests After Pressing Sort By Date------------------------------> 
            if(isset($_POST['searchbydate'])) {
                $sortdate = $_POST['sortbydate'];?>

                    <div class="row_app">

                                <?php echo "Appointments for ". $sortdate; ?>
                    </div>

                    <div class="row_label">
                        
                        <div class="col_app">Appt. Date</div>
                        <div class="col_app">Date Accepted</div>
                        <div class="col_app">/ Requested</div> 
                        <div class="col_app">Student Appointment Details</div>
                        <div class="col_app">Reschedule</div> 
                        <div class="col_app">Comment</div>
                        <div class="col_app"></div>
                        
                    </div>
                    
                    <?php

                    date_default_timezone_set('Asia/Manila');                           		
                    $currentdate = date("Y-m-d");

                    $acceptedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id' 
                        AND tbl_appointment_detail.appointment_date = '$sortdate' 
                        AND tbl_appointment_detail.appointment_date >= '$currentdate'
                        ORDER BY tbl_appointment_detail.appointment_id ASC";
                    
                    $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
                    
                    if($acceptedrequest_result==TRUE) {
                        $count = mysqli_num_rows($acceptedrequest_result);
                        
                        if($count>0) {

                            while($rows=mysqli_fetch_assoc($acceptedrequest_result)) {?> 

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
                                        <p><?php echo $rows['appointment_type']; ?></p>
                                        <p><?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                        <p><?php echo $rows['course']."-".$rows['year']; ?></p>
                                        <p>
                                            <?php
                                            if($rows['note']==""){
                                                ?><p><?php echo "No note."; ?></p><?php
                                            }
                                            else{
                                                ?><p><?php echo $rows['note']; ?></p><?php
                                            }?>
                                        </p>
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
                                        <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">

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
                                            <button type="submit" id="done"><a href="appointment/done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
                                            DONE</a>
                                            </button>
                                        </div>
                                        <!-------------------------Send data to done.php ------------------------------> 
                                    </div>   
                                    
                                </div> <?php 
                            }
                        }
                        else {
                            ?><p><?php
                            echo "No Appointments Scheduled for ". $sortdate;
                            ?></p><?php
                        }
                    }?>
                    
                <?php
            }
            //-------------------------Show Accepted Requests After Pressing Sort By Date------------------------------>  
            else if(isset($_POST['show_all'])) { ?>

                <div class="row_app">
                        Show All Active Appointments.
                </div>

                <div class="row_label">
                    
                    <div class="col_app">Appt. Date</div>
                    <div class="col_app">Date Accepted</div>
                    <div class="col_app">/ Requested</div> 
                    <div class="col_app">Student Appointment Details</div>
                    <div class="col_app">Reschedule</div> 
                    <div class="col_app">Comment</div>
                    <div class="col_app"></div>
                    
                </div>

                <?php
                date_default_timezone_set('Asia/Manila');                           		
                $currentdate = date("Y-m-d");
                $acceptedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id' 
                    AND tbl_appointment_detail.appointment_date > '$currentdate'
                    ORDER BY tbl_appointment_detail.appointment_date ASC";
        
                $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
                
                if($acceptedrequest_result==TRUE) { 
                    $count = mysqli_num_rows($acceptedrequest_result);

                    if($count>0) {

                        while($rows=mysqli_fetch_assoc($acceptedrequest_result)) {?>
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
                                    <p><?php echo $rows['appointment_type']; ?></p>
                                    <p><?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                    <p><?php echo $rows['course']."-".$rows['year']; ?></p>
                                    <p>
                                        <?php
                                        if($rows['note']==""){
                                            ?><p><?php echo "No note."; ?></p><?php
                                        }
                                        else{
                                            ?><p><?php echo $rows['note']; ?></p><?php
                                        }?>
                                    </p>
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
                                    <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">

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
                                        <button type="submit" id="done"><a href="appointment/done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
                                        DONE</a>
                                        </button>
                                    </div>
                                    <!-------------------------Send data to done.php ------------------------------> 
                                </div>   
                                
                            </div> <?php 
                        }
                    }
                    else {
                        echo "No Appointments Scheduled.";
                    }

                }//end of if($acceptedrequest_result==TRUE)

            }//end of else if
            //-------------------------Show All Accepted Requests WITHOUT Sorting By Date------------------------------>  
            
            else {?>

                <div class="row_label">
                    
                    <div class="col_app">Appt. Date</div>
                    <div class="col_app">Date Accepted</div>
                    <div class="col_app">/ Requested</div> 
                    <div class="col_app">Student Appointment Details</div>
                    <div class="col_app">Reschedule</div> 
                    <div class="col_app">Comment</div>
                    <div class="col_app"></div>
                    
                </div>
            
                <?php
                date_default_timezone_set('Asia/Manila');                           		
                $currentdate = date("Y-m-d");

                $acceptedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id' 
                    AND tbl_appointment_detail.appointment_date >= '$currentdate'
                    ORDER BY tbl_appointment_detail.appointment_date ASC";

                $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
                
                if($acceptedrequest_result==TRUE) { 
                    $count = mysqli_num_rows($acceptedrequest_result);

                    if($count>0) {

                        while($rows=mysqli_fetch_assoc($acceptedrequest_result)) {?>
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
                                    <p><?php echo $rows['appointment_type']; ?></p>
                                    <p><?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                    <p><?php echo $rows['course']."-".$rows['year']; ?></p>
                                    <p>
                                        <?php
                                        if($rows['note']==""){
                                            ?><p><?php echo "No note."; ?></p><?php
                                        }
                                        else{
                                            ?><p><?php echo $rows['note']; ?></p><?php
                                        }?>
                                    </p>
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
                                    <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">

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
                                        <button type="submit" id="done"><a href="appointment/done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
                                        DONE</a>
                                        </button>
                                    </div>
                                    <!-------------------------Send data to done.php ------------------------------> 
                                </div>   
                                
                            </div> <?php 
                        }
                    }
                    else {
                        echo "<p class='no_appt_result'>No Appointments Scheduled.</p>";
                    }
                }
            } 
                //-------------------------Show All Accepted Requests WITHOUT Sorting By Date------------------------------> 
                ?>

   </div>
<!-------------------------Show Accepted Requests ------------------------------>
        <?php
        include("backtotop.php");
        ?>  
</main>

  <style>
      body {
          background: #EFF0F4;
      }
      #activerequests {
          background: #324e9e;
      }
      #activerequests .card_title,
      #activerequests .card_body {
          color: #fff;
      }
  </style>

<script>
        document.getElementById("sort_date").value = localStorage.getItem("sortingdate");

        function savesortdate() {
            
            var sortingdate = document.getElementById("sort_date").value;
            if (sortingdate == "") {
                alert("Please enter a date in first!");
                return false;
            }
            localStorage.setItem("sortingdate", sortingdate);
            return true;   
        }
        function deletestorage(){
            window.localStorage.clear();
            var sortingdate = document.getElementById("sort_date").value = 
                new Date().toJSON().slice(0,10);//change to sortdata to current date
        }

    </script>