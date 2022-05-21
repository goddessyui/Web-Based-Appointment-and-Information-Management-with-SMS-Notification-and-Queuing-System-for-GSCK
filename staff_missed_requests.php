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
                    AND tbl_staff_registry.staff_id = '$staff_id'
                    AND tbl_appointment.appointment_type NOT IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')
                     ORDER BY tbl_appointment_detail.appointment_date ASC";
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

                                                <select name="app_time" id="app_time">  
                                                    <option value="08:00" <?php echo $rows["appointment_time_open"]=='08:00:00'?'selected':'';?>>8:00AM - 9:00AM</option>
                                                    <option value="09:00" <?php echo $rows["appointment_time_open"]=='09:00:00'?'selected':'';?>>9:00AM - 10:00AM</option>
                                                    <option value="10:00" <?php echo $rows["appointment_time_open"]=='10:00:00'?'selected':'';?>>10:00AM - 11:00AM</option>
                                                    <option value="11:00" <?php echo $rows["appointment_time_open"]=='11:00:00'?'selected':'';?>>11:00AM - 12:00PM</option>
                                                    <option value="13:00" <?php echo $rows["appointment_time_open"]=='13:00:00'?'selected':'';?>>1:00PM - 2:00PM</option>
                                                    <option value="14:00" <?php echo $rows["appointment_time_open"]=='14:00:00'?'selected':'';?>>2:00PM - 3:00PM</option>
                                                    <option value="15:00" <?php echo $rows["appointment_time_open"]=='15:00:00'?'selected':'';?>>3:00PM - 4:00PM</option>
                                                    <option value="16:00" <?php echo $rows["appointment_time_open"]=='16:00:00'?'selected':'';?>>4:00PM - 5:00PM</option>
                                                </select>

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
                                                <!-- <input id="cancel" type="submit" name="cancel" value="CANCEL"> -->
                                                <button type="button" id="cancel" onclick="del(this);">CANCEL</button>
                                            </div>

                                            <!-- delete announcement modal -->
                                        <div id="myModal" class="modal">
                                        <!-- Modal content -->
                                        <div class="modal-content">

                                        <div>
                                        <div id="mess_delete"></div>
                                        </div>
                                        
                                        <div>
                                        <p>
                                            Do you really want to Cancel?
                                        </p>
                                        </div>

                                        <div>
                                        
                                            <button class="delete" type="submit" id= "cancel" name="cancel">Yes</button>
                                            <button class="close1" type="button">No</button>
                                        
                                        </div>

                                    </div>
                                    </div>
                                        <!-- delete announcement modal -->


                                        </form>
                                        
                                        <!-------------------------Send data to done.php ------------------------------>  
                                        <div>
                                            <!-- <button type="submit" id="done"><a href="appointment/done_missed.php?appointment_id=<?php echo $rows['appointment_id']; ?>">
                                            DONE</a>
                                            </button> -->
                                            <button type="button" onclick="confirm(this);">DONE</button>
                                        </div>
                                        <!-------------------------Send data to done.php ------------------------------> 
                                    </div>   
                                    

                                    <!-- delete announcement modal -->
                                    <div id="confirmModal" class="modal">
                                        <!-- Modal content -->
                                        <div class="modal-content">

                                        <div>
                                        <div id="mess_delete"></div>
                                        </div>
                                        
                                        <div>
                                        <p>
                                            Confirm done
                                        </p>
                                        </div>

                                        <div>
                                        
                                            <button class="submit" type="submit" id= "cancel" name="cancel" onclick="location.href='appointment/done_missed.php?appointment_id=<?php echo $rows['appointment_id']; ?>'" >Confirm</button>
                                            
                                            <button class="close2" type="button">Cancel</button>
                                        
                                        </div>

                                    </div>
                                    </div>
                                        <!-- delete announcement modal -->


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






    #missedrequests {
        background: #324e9e;
    }
    #missedrequests .card_title,
    #missedrequests .card_body {
        color: #fff;
    }



      
    .modal,
    .addmodal,
    .editmodal  {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 20vw;
        top: 10vh;
        width: 80vw; /* Full width */
        height: 100vh; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background: #0008;
    }
    .modal p {
      margin-bottom: 20px;
    }
 

    /* Delete Modal Content */ 
    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 30px;
        border: 1px solid #888;
        width: 30%;
        position: relative;
        top: 40%;
        transform: translateY(-40%);
    }

    /* add and edit modal Content */
    .addmodal-content,
    .editmodal-content {
        background-color: #fff;
        margin: auto;
        padding: 30px;
        border: 1px solid #888;
        max-width: 50%;
        position: relative;
        top: 40%;
        transform: translateY(-40%);
    }


    /* The Close Button */
    .close1 {
        color: #eee;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        height: 28px;
        width: 120px;
        background: #324E9E;
        text-transform: capitalize;
    }
    /* The Close Button */
    .close2 {
        color: #eee;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        height: 28px;
        width: 120px;
        background: #324E9E;
        text-transform: capitalize;
    }
    /* The Close Button */
    .submit {
        color: #eee;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        height: 28px;
        width: 120px;
        background: #324E9E;
        text-transform: capitalize;
    }
    .delete {
        background-color: #EC3237;
        color: #eee;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        margin-right: 10px;
        height: 28px;
        width: 120px;
        text-transform: capitalize;
    }

    .delete:hover,
    .delete:focus,
    .submit:hover,
    .submit:focus {
        background: #424F59;
    }
    .close1:hover,
    .close1:focus {
      background: #424F59;
    }
    .close2:hover,
    .close2:focus {
      background: #424F59;
    }
</style>
<script>


        // Get the modal
        var cmodal = document.getElementById("confirmModal");
        var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var close = document.getElementsByClassName("close1")[0];
var close2 = document.getElementsByClassName("close2")[0];

// When the user clicks the delete button, open the modal 
function del() {
    modal.style.display = "block";
}

function confirm() {
    cmodal.style.display = "block";
}



// When the user clicks on cancel button, close the modal
close.onclick = function() {
  modal.style.display = "none";
  cmodal.style.display = "none";
}
close2.onclick = function() {
  modal.style.display = "none";
  cmodal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == cmodal) {
    cmodal.style.display = "none";
  }
}

    </script>