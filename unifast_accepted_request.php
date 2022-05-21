<?php
include("new_header_admin.php");
?>


<main>

    <?php include("unifast_count_app.php"); ?>


    <?php 
    if(isset($_GET['type'])){
        $unifasttype = $_GET['type'];
    }
    else if(!isset($_GET['type'])) {
        $unifasttype = 'UniFAST - Claim Cheque';
        
    }
    
    ?>

    <div class="appointment_result">

       <!-------------------------Sort Requests By Date------------------------------> 
       <div class="row date_input_h3">
           <p>List of Active Requests</p>
            <?php 
                date_default_timezone_set('Asia/Manila');                           		
                $currentdate = date("Y-m-d");
            ?>

                <select onchange="location = this.value;">
                <option value="?type=UniFAST - Claim Cheque" <?php echo isset($_GET['type'])?$_GET['type']=='UniFAST - Claim Cheque'?'selected':'':''?>>Claim Cheque</option>
                <option value="?type=UniFAST - Submit Documents" <?php echo isset($_GET['type'])?$_GET['type']=='UniFAST - Submit Documents'?'selected':'':''?>>Submit Documents</option>
                </select>  

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
                        AND tbl_appointment.appointment_type = '$unifasttype' 
                        ORDER BY tbl_appointment_detail.appointment_id, tbl_appointment_detail.appointment_time_open ASC";
                    
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
                                        <!-------------------------To reschedule appointment. Send Form Data to unifast_reschedule.php --------------------------->       
                                        <form action="appointment/unifast_reschedule.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
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
                                        <!-------------------------Send Form Data to unifast_reschedule.php ------------------------------>   
                                    </div>  

                                    <div class="col_app">
                                        <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php ---------------------->  
                                        <form action ="appointment/unifast_cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">

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
                                            <button type="submit" id="done"><a href="appointment/unifast_done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
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
                    AND tbl_appointment.appointment_type = '$unifasttype' 
                    ORDER BY tbl_appointment_detail.appointment_date, tbl_appointment_detail.appointment_time_open ASC";
        
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
                                    <!-------------------------To reschedule appointment. Send Form Data to unifast_reschedule.php --------------------------->       
                                    <form action="appointment/unifast_reschedule.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
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
                                    <!-------------------------Send Form Data to unifast_reschedule.php ------------------------------>   
                                </div>  

                                <div class="col_app">
                                    <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php ---------------------->  
                                    <form action ="appointment/unifast_cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">

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
                                        <button type="submit" id="done"><a href="appointment/unifast_done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
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
            
                    AND tbl_appointment.appointment_type = '$unifasttype' 
                    ORDER BY tbl_appointment_detail.appointment_date, tbl_appointment_detail.appointment_time_open ASC";

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
                                    <!-------------------------To reschedule appointment. Send Form Data to unifast_reschedule.php --------------------------->       
                                    <form action="appointment/unifast_reschedule.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
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
                                    <!-------------------------Send Form Data to unifast_reschedule.php ------------------------------>   
                                </div>  

                                <div class="col_app">
                                    <!-------------------------To Cancel Appointment and add note. Send Form Data to cancel.php ---------------------->  
                                    <form action ="appointment/unifast_cancel.php?appointment_id=<?=$rows['appointment_id']?>"  method="post">

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
                                        <button type="submit" id="done"><a href="appointment/unifast_done.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
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


</div>
</div>

<div class="mobile_header"></div>

</body>
</html>



  <style>

@import url('https://fonts.googleapis.com/css2?family=Roboto+Serif:opsz,wght@8..144,400;8..144,500;8..144,700&family=Roboto:wght@400;500;700&display=swap');

main {  
    padding: 15px;
    background: #EFF0F4;
}

main h3 {
    text-transform: uppercase;
    margin-left: 15px;
    margin-bottom: 15px;
    font-family: 'Roboto';
    color: red;
}
.card_row_div {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: 15px;
    background: #EFF0F4;
    padding: 0 15px;
}
.card_row_div .col_3 {
    width: 182px;
    text-align: center;
    cursor: pointer;
    background: #fff;
}
.card_row_div .col_3 a {
    text-decoration: none;
    color: #000;
}

.card_row_div .col_3 .card .card_title {
    padding: 15px;
    font-size: 13px;
    text-transform: uppercase;
    color: #333;
    font-family: 'Roboto';
}
.card_row_div .col_3 .card .card_body {
    padding-bottom: 15px;
    font-size: 30px;
    font-family: 'Roboto';
}

/*---------appointment_result------------*/
.appointment_result {
    background: #EFF0F4;
    padding: 15px;
    padding-top: 5px;
    padding-bottom: 0;
}
.appointment_result .row {
    margin-bottom: 20px;
}
#error_appt {
    width: 100%;
    background: orange;
    color: #fff;
    font-size: 13px;
}
.row form input {
    padding: 4px 12px;
    border: none;
    background: #fff;
    cursor: pointer;
    outline: none;
    margin-right: 5px;
    transition: all .2s ease-in-out;
    font-size: 13px;
}
.row form input:hover {
    background: gold;
}
.row form input:nth-child(1) {
    border: 1px solid grey;
    background: #fff;
}


.appointment_result .row_app, .row_label {
    display: flex;
    justify-content: space-between;
    margin-top: 0;
}

.row_app {
    padding: 15px;
    background: #fff;
}
.row_app:nth-child(even) {
    background: #0001;
}
.row_label {
    text-transform: uppercase;
    color: #fff;
    background: #324e9e;
    padding: 0 15px;
    align-items: center;
}
.appointment_result .row_app .col_app,
.appointment_result .row_label .col_app {
    width:  10%;
    margin-right: 15px;
    font-size: 13px;
    font-family: 'Roboto';
}
.appointment_result .row_app .col_app,
.appointment_result .row_label .col_app :not(.col_app:nth-child(4)) {
    padding-top: 15px;
}


.appointment_result .row_label .col_app:nth-child(4) {
    width: 22%;
    padding: 15px;
}
.appointment_result .row_app .col_app:nth-child(4) {
    width: 22%;
    padding: 15px;
    background: none;
    color: #333;
    font-size: 14px;;
}
.appointment_result .row_app .col_app:nth-child(4) p {
    margin-bottom: 2px;
    font-family: 'Roboto Serif';
}
.appointment_result .row_app .col_app:nth-child(4) p:nth-child(1) {
    color: #324e9e;
    text-transform: uppercase;
    margin-bottom: 10px;
}
.appointment_result .row_app .col_app:nth-child(4) p:nth-child(4) {
    color: #324e9e;
    margin-top: 10px;
}
.appointment_result .row_app .col_app:nth-child(6),
.appointment_result .row_label .col_app:nth-child(6) {
    width: 20%;
}
.appointment_result .row_app .col_app:nth-child(5),
.appointment_result .row_label .col_app:nth-child(5) {
    width: 12%;
}



.appointment_result .row_app .col_app textarea {
    width: 90%;
    height: 105px;
    resize: none;
    padding: 5px;
    border: 1px solid gray;
    font-family: 'Roboto Serif';
}
.appointment_result .row_app .col_app input,
.appointment_result .row_app .col_app button {
    width: 90%;
    padding: 4px 12px;
    margin-bottom: 10px;
    font-size: 13px;
    cursor: pointer;
    border: none;
    color: #fff;
    background: #324e9e;
}

.appointment_result .row_app .col_app:nth-child(5) input:nth-child(1),
.appointment_result .row_app .col_app:nth-child(5) button {
    border: none;
    border: 1px solid gray;
    background: none;
    padding: 4px 12px;
    color: #333;
}
.appointment_result .row_app .col_app:nth-child(7) input {
    border: none;
    background: #444;
    padding: 4px 12px;
}
.appointment_result .row_app .col_app:nth-child(7) button {
    background: #324e9e;
}
.appointment_result .row_app .col_app:nth-child(7) a {
    color: #fff;
}



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
      .date_input_h3 {
          display: flex;
          padding: 0;
          align-items: flex-end;
          justify-content: space-between;
      }
      .date_input_h3 p {
          text-transform: uppercase;
          font-size: 13px;
          font-family: 'Roboto';
          font-weight: 500;
      }
      .date_input_h3 input:nth-child(3) {
          margin: 0;
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

