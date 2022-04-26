<?php

include("dbconfig.php");
session_start();
?>
<div id="at_all">
    <div class="apt_content">
<?php 
    $student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
    $student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';

    $appointment_type =$_POST['appointment_type'];
    
    $first_name =$_POST['fn'];
    $last_name =$_POST['ln'];
    
    $sql = "SELECT student_id FROM tbl_unifast_grantee WHERE student_id ='$student_id'";
    $result = mysqli_query($db, $sql);
    $sql2="SELECT staff_id FROM tbl_staff_registry WHERE first_name = '$first_name' AND last_name = '$last_name'";
    $run2= mysqli_query($db, $sql2);
    $id2 = mysqli_fetch_assoc($run2);
    $staff_id =$id2['staff_id'];
                   
        if (mysqli_num_rows($result) > 0) {
            
            while($id = mysqli_fetch_assoc($result)) {
            $ug_id= $id['student_id'];

                if($student_id==$ug_id){//if student is unifast grantee
                    ?>
                    

                    <button class="bg-outer" onclick="CloseLoginBtn()">
                        <div class="outer">
                            <div class="inner">
                                <label>EXIT</label>
                            </div>
                        </div>
                    </button>
                    
                    <div class="apt_container_div">

                        <!---------------TURN TO MODAL ON CLICK OF APPOINTMENT BUTTON------------------------------------------>
                        <h2>Appointment Type: <?php echo $appointment_type;?></h2>
                        <h2>GSCK Staff: <?php echo $staff_id ." ".$first_name . " ". $last_name;?></h2>
                                  
                        <form action="appointment/student_insert_appointment.php" method="post">

                            <h4>Note to Staff (Optional):</h4>
                            <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                            Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                            <textarea name="note"></textarea>
                            <input type="hidden" name="appointmenttype" value="<?php echo $appointment_type;?>"> 
                            <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>"> 
                            <input type="submit" name="request" id="request" value="Request Appointment">
                        
                        </form>
                        <!---------------TURN TO MODAL ON CLICK OF APPOINTMENT BUTTON------------------------------------------> 
                    </div>   
                    <?php 
                }
            }
        }
        else {//if student is NOT a unifast grantees
            if($appointment_type=="UniFAST - Claim Cheque" OR $appointment_type=="UniFAST - Submit Documents"){
                //if appointment type is unifast app
                echo "You cannot make this appointment as you are not a UniFAST Grantee.";
            }
            else {
                //if appointment type is unifast app
                ?>

                <button class="bg-outer" onclick="CloseLoginBtn()">
                        <div class="outer">
                            <div class="inner">
                                <label>EXIT</label>
                            </div>
                        </div>
                    </button>
                    <div class="apt_container_div">
                        <!---------------TURN TO MODAL ON CLICK OF APPOINTMENT BUTTON------------------------------------------>             
                        <h2>Appointment Type: <?php echo $appointment_type;?></h2>
                        <h2>GSCK Staff: <?php echo $first_name . " ". $last_name;?></h2>

                        <form action="appointment/student_insert_appointment.php" method="post">

                            <h4>Note to Staff (Optional):</h4>
                            <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                            Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                            <textarea name="note"></textarea>
                            <input type="hidden" name="appointmenttype" value="<?php echo $appointment_type;?>"> 
                            <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>"> 
                            <input type="submit" name="request" id="request" value="Request Appointment">
                            
                        </form>
                    <!---------------TURN TO MODAL ON CLICK OF APPOINTMENT BUTTON------------------------------------------>
                    </div>   
                
                <?php   
            }     
        }?>
            </div> 
        </div>  