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
    
            <div class="col_app">Date Requested</div>
            <div class="col_app">Appt. Type</div>
            <div class="col_app">Student Details</div>
            <div class="col_app">Student's Note</div>
            <div class="col_app">Set Appt. Date</div>
            <div class="col_app">Time</div>
            <div class="col_app">Comment</div>
            <div class="col_app"></div>

        </div>

                    
        <?php
        if($position!="Accounting Staff/Scholarship Coordinator") {?>
            <!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->          
            <?php
                $staff_id = $_SESSION["staff_id"];
            if (isset($_GET['apde'])){
                $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                    tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                    tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                    tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_student_registry.mobile_number
                    FROM tbl_appointment INNER JOIN tbl_staff_registry 
                    ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                    WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                    AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_id = '".$_GET['apde']."'";
            }
            else {
                $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                    tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                    tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                    tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_student_registry.mobile_number
                    FROM tbl_appointment INNER JOIN tbl_staff_registry 
                    ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                    WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                    AND tbl_staff_registry.staff_id = '$staff_id' ORDER BY date_created ASC";
            }
                    $request_result = mysqli_query($db, $requests);
                    //check whether the query is executed or not
                if($request_result==TRUE) {
                    $count = mysqli_num_rows($request_result);
                                  
                    if($count>0) {
                  
                        while($rows=mysqli_fetch_assoc($request_result)) {?>
                            <div class="row_app">
                                
                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['date_created']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['appointment_type']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p><?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                    <p><?php echo $rows['course']."-".$rows['year']; ?></p>
                                </div>

                                <div class="col_app">
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
                                    <?php
                                        //set the time to local time
                                        date_default_timezone_set('Asia/Manila');                           		
                                        $currentdate = date("Y-m-d");
                                    ?>
                                    
                                    <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                                    <form action="appointment/acceptordecline.php" method="post">
                                    
                                        <input type="date" name="appointment_date" id="appointmentdate" value=" "
                                            min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                            strtotime($currentdate. ' + 90 days'));?>">
                                </div>
                                <div class="col_app">
                                <select name="app_time" id="app_time">  
                                    <option value="08:00" >8:00AM - 9:00AM</option>
                                    <option value="09:00" >9:00AM - 10:00AM</option>
                                    <option value="10:00" >10:00AM - 11:00AM</option>
                                    <option value="11:00" >11:00AM - 12:00PM</option>
                                    <option value="13:00" >1:00PM - 2:00PM</option>
                                    <option value="14:00" >2:00PM - 3:00PM</option>
                                    <option value="15:00" >3:00PM - 4:00PM</option>
                                    <option value="16:00" >4:00PM - 5:00PM</option>
                                </select>
                                </div>

                                <div class="col_app">
                                        <textarea name="comment" placeholder="Comment here..." value=""></textarea>
                                </div>

                                <div class="col_app">
                                        <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                        <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                        <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                        <input type="hidden" name="student_fullname" value="<?php echo $rows['first_name'].' '.$rows['last_name']; ?>">
                                        <input type="hidden" name="number" value="<?php echo $rows['mobile_number']; ?>">
                                        <button  type="submit" name="accept" id="accept">ACCEPT</button>
                                        <button type="submit" name="decline" id="decline">DECLINE</button>

                                    </form>
                                    <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                                </div>

                            </div><?php 
                        }
                    }
                    else {
                        echo "No Pending Requests.";
                    }
                }
                else {
                    echo "The query was not executed.";
                }    
            ?>
            <!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->   
            <?php
        }

        if($position=="Accounting Staff/Scholarship Coordinator") {?>


            <!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->          
            <?php
                $staff_id = $_SESSION["staff_id"];

                $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                    tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                    tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                    tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_student_registry.mobile_number
                    FROM tbl_appointment INNER JOIN tbl_staff_registry 
                    ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                    WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                    AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type != 'UniFAST - Claim Cheque' 
                    AND tbl_appointment.appointment_type != 'UniFAST - Submit Documents' ORDER BY date_created ASC";

                $request_result = mysqli_query($db, $requests);

                if($request_result==TRUE) {
                    $count = mysqli_num_rows($request_result);
                                 
                    if($count>0) {
                        while($rows=mysqli_fetch_assoc($request_result)) {?>

                            <div class="row_app">
                                
                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['date_created']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['appointment_type']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p><?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                    <p><?php echo $rows['course']."-".$rows['year']; ?></p>
                                </div>

                                <div class="col_app">
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
                                    <?php
                                        //set the time to local time
                                        date_default_timezone_set('Asia/Manila');                           		
                                        $currentdate = date("Y-m-d");
                                    ?>
                                    
                                    <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                                    <form action="appointment/acceptordecline.php" method="post">
                                    
                                        <input type="date" name="appointment_date" id="appointmentdate" value=" "
                                            min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                            strtotime($currentdate. ' + 90 days'));?>">
                                </div>
                                <div class="col_app">
                                <select name="app_time" id="app_time">  
                                    <option value="08:00" >8:00AM - 9:00AM</option>
                                    <option value="09:00" >9:00AM - 10:00AM</option>
                                    <option value="10:00" >10:00AM - 11:00AM</option>
                                    <option value="11:00" >11:00AM - 12:00PM</option>
                                    <option value="13:00" >1:00PM - 2:00PM</option>
                                    <option value="14:00" >2:00PM - 3:00PM</option>
                                    <option value="15:00" >3:00PM - 4:00PM</option>
                                    <option value="16:00" >4:00PM - 5:00PM</option>
                                </select>
                                </div>

                                <div class="col_app">
                                        <textarea name="comment" placeholder="Comment here" value=""></textarea>
                                </div>

                                <div class="col_app">
                                        <input type="hidden" name="student_id" value="<?php echo $rows['student_id'];?>">
                                        <input type="hidden" name="appointment_type" value="<?php echo $rows['appointment_type'];?>">
                                        <input type="hidden" name="appointment_id" value="<?php echo $rows['appointment_id'];?>">
                                        <input type="hidden" name="student_fullname" value="<?php echo $rows['first_name'].' '.$rows['last_name']; ?>">
                                        <input type="hidden" name="number" value="<?php echo $rows['mobile_number']; ?>">
                                        <button  type="submit" name="accept" id="accept">ACCEPT</button>
                                        <button type="submit" name="decline" id="decline">DECLINE</button>

                                    </form>
                                    <!-------------------------To accept or decline an appointment. Send Form Data to acceptordecline.php ------------------------------>   
                                </div>

                            </div><?php
                        }
                    }
                    else {
                        echo "<p class='no_appt_result'>No Pending Requests.</p>";
                    }
                }
                else {
                    echo "<p class='no_appt_result'>The query was not executed.</p>";
                }    
            ?>
            <!-------------------------Show Pending Requests ------------------------------------------------------------------------------------------------->   



        <?php
        }


        ?>
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








    #pendingrequests {
        background: #324e9e;
    }
    #pendingrequests .card_title,
    #pendingrequests .card_body {
        color: #fff;
    }
</style>