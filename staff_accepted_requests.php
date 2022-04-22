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
        #activerequests{
            background-color: #fcd228;
            color: #324e9e;
        }
    </style>

    <div class="row">
        <?php
            if (isset($_GET['status'])){
        ?> 
                <hr>
                <a href="staff_accepted_requests.php"><button type="button">View all appointment</button></a><hr> <?php 
                include("staff_accepted_requests.php");   
            }   
    ?>
    </div>

    <div class="row">
        <h2>Active Appointments</h2> 
    </div>

    <div class="row">
            <!--success or error-->
            <?php 
                    if(isset($_GET['success'])){
                ?>
                        <p align="center">
                            <?php echo $_GET['success']; ?>
                        </p>
                <?php
                    }
                    else{
                    }
                    if(isset($_GET['error'])){
                ?>
                                <p align="center">
                                    <?php echo $_GET['error']; ?>
                                </p>
                        <?php
                            }
                    else{
                    }
                ?>
                <!--success or error-->
    </div>

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
                            

                                     



    <!-------------------------Show Accepted Requests ------------------------------>   
   
        
        <?php
            //-------------------------Show Accepted Requests After Pressing Sort By Date------------------------------> 
        if(isset($_POST['searchbydate'])) {
            $sortdate = $_POST['sortbydate'];?>

                                <div class="row_app">
                                <b>
                                    <font color="#324e9e">
                                        <?php echo "Appointments for ". $sortdate; ?>
                                    </font>
                                </b> 
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
                
                    <?php
                    $acceptedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id' 
                        AND tbl_appointment_detail.appointment_date= '$sortdate' 
                        ORDER BY tbl_appointment_detail.appointment_id ASC";
                    
                    $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
                    
                    if($acceptedrequest_result==TRUE){
                        $count = mysqli_num_rows($acceptedrequest_result);
                        
                        if($count>0){  //we have data in database
                            $i = 1;

                            while($rows=mysqli_fetch_assoc($acceptedrequest_result)) {
                                date_default_timezone_set('Asia/Manila');                           		
                                $currentdate = date("Y-m-d");
                    ?>  
                                <div class="row_app">
                                    <div class="col_app" id="serialno">
                                        <?php echo $i++; ?>
                                    </div>
                                    
                                    <div class="col_app" id="appdate">
                                        <?php 
                                            $appointment_date = $rows['appointment_date'];
                                            
                                            if($appointment_date<=$currentdate){
                                                echo "<font color='red';>" . $appointment_date . "</font>";
                                            }
                                            else {
                                                echo $rows['appointment_date'];
                                            }
                                        ?>
                                    </div>
                                    
                                    <div class="col_app" id="apptype">
                                        <?php echo $rows['appointment_type']; ?>
                                        <small>
                                            <p><b>Date Accepted:</b></p><p><?php echo $rows['date_accepted']; ?></p> 
                                            <p><b>Date Requested:</b></p><p><?php echo $rows['date_created']; ?></p>
                                        </small>
                                        
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
                                            ?><pre><?php echo $rows['note'];  ?></pre><?php
                                        }
                                        ?>
                                    </div> 

                                    <div class="col_app" id="resched">
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

                                    <div class="col_app" id="comment">
                                        <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php ---------------------->  
                                        <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">
                                            <textarea type="textarea" name="comment"></textarea><br><br>
                                            <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                            <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                            <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                            <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                            
                                        <!-------------------------Send Form Data to cancel.php ------------------------------>
                                    </div>  

                                    <div class="col_app" id="canceldone">
                                            <input id="cancel" type="submit" name="cancel" value="CANCEL">
                                        </form>
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
                            echo "No Appointments Scheduled for ". $sortdate;
                        }
                    }?>
                
            <?php
        }
        //-------------------------Show Accepted Requests After Pressing Sort By Date------------------------------>  
        else if(isset($_POST['show_all'])) { ?>
                    <div class="row_app">
                        <b>
                            <font color="#324e9e">
                               Show All Active Appointments.
                            </font>
                        </b> 
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
            <?php
            
            $acceptedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id' 
                ORDER BY tbl_appointment_detail.appointment_date ASC";
    
            $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
            
            if($acceptedrequest_result==TRUE) { 
                $count = mysqli_num_rows($acceptedrequest_result);                
                if($count>0) {
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($acceptedrequest_result)) {
            ?>
                        <div class="row_app">
                            <div class="col_app" id="serialno">
                                <?php echo $i++; ?>
                            </div>
                            
                            <div class="col_app" id="appdate">
                                <?php 
                                    $appointment_date = $rows['appointment_date'];
                                    
                                    if($appointment_date<=$currentdate){
                                        echo "<font color='red';>" . $appointment_date . "</font>";
                                    }
                                    else {
                                        echo $rows['appointment_date'];
                                    }
                                ?>
                            </div>
                            
                            <div class="col_app" id="apptype">
                                <?php echo $rows['appointment_type']; ?>
                                <small>
                                    <p><b>Date Accepted:</b></p><p><?php echo $rows['date_accepted']; ?></p> 
                                    <p><b>Date Requested:</b></p><p><?php echo $rows['date_created']; ?></p>
                                </small>
                                
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
                                    ?><pre><?php echo $rows['note'];  ?></pre><?php
                                }
                                ?>
                            </div> 

                            <div class="col_app" id="resched">
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

                            <div class="col_app" id="comment">
                                <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php ---------------------->  
                                <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">
                                    <textarea type="textarea" name="comment"></textarea><br><br>
                                    <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                    <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                    <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                    <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                    
                                <!-------------------------Send Form Data to cancel.php ------------------------------>
                            </div>  

                            <div class="col_app" id="canceldone">
                                    <input id="cancel" type="submit" name="cancel" value="CANCEL">
                                </form>
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
                    echo "No Appointments Scheduled.";
                }
            }
        }
        //-------------------------Show All Accepted Requests WITHOUT Sorting By Date------------------------------>  
        
        else {
        ?>
                    <div class="row_app">
                        <b>
                            <font color="#324e9e">
                                All Active Appointments.
                            </font>
                        </b> 
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
        
        <?php
        
        
        $acceptedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
            ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
            INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
            WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id' 
            ORDER BY tbl_appointment_detail.appointment_date ASC";

        $acceptedrequest_result = mysqli_query($db, $acceptedrequests);
        
        if($acceptedrequest_result==TRUE) { 
            $count = mysqli_num_rows($acceptedrequest_result);                
            if($count>0) 
            {
                $i = 1;
                while($rows=mysqli_fetch_assoc($acceptedrequest_result)) {
        ?>
                    
                    <div class="row_app">
                        <div class="col_app" id="serialno">
                            <?php echo $i++; ?>
                        </div>
                        
                        <div class="col_app" id="appdate">
                            <?php 
                                $appointment_date = $rows['appointment_date'];
                                
                                if($appointment_date<=$currentdate){
                                    echo "<font color='red';>" . $appointment_date . "</font>";
                                }
                                else {
                                    echo $rows['appointment_date'];
                                }
                            ?>
                        </div>
                        
                        <div class="col_app" id="apptype">
                            <?php echo $rows['appointment_type']; ?>
                            <small>
                                <p><b>Date Accepted:</b></p><p><?php echo $rows['date_accepted']; ?></p> 
                                <p><b>Date Requested:</b></p><p><?php echo $rows['date_created']; ?></p>
                            </small>
                            
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
                                ?><pre><?php echo $rows['note'];  ?></pre><?php
                            }
                            ?>
                        </div> 

                        <div class="col_app" id="resched">
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

                        <div class="col_app" id="comment">
                            <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php ---------------------->  
                            <form action ="appointment/cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">
                                <textarea type="textarea" name="comment"></textarea><br><br>
                                <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                
                            <!-------------------------Send Form Data to cancel.php ------------------------------>
                        </div>  

                        <div class="col_app" id="canceldone">
                                <input id="cancel" type="submit" name="cancel" value="CANCEL">
                            </form>
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
                echo "No Appointments Scheduled.";
            }
        }
    } 
            //-------------------------Show All Accepted Requests WITHOUT Sorting By Date------------------------------> 
            ?>
         

<!-------------------------Show Accepted Requests ------------------------------>     


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
    #apptype small{
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