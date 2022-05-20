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
           
            <div class="col_app">Date Done</div>
            <div class="col_app">Date Accepted</div>
            <div class="col_app">Date Requested</div>
            <div class="col_app">Appt.Type</div>
            <div class="col_app">Student</div> 
            <div class="col_app">Student's Note</div>
            <div class="col_app">Comment</div>

        </div>

        <div>
        <!-------------------------Show Done Appointments ------------------------------------------------------------------------------------------------>        
            <?php

                $donerequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                    WHERE tbl_appointment_detail.status = 'done' AND tbl_appointment.staff_id = '$staff_id' 
                    AND tbl_appointment.appointment_type NOT IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')
                    ORDER BY tbl_appointment_detail.appointment_date DESC";
            
                $donerequest_result = mysqli_query($db, $donerequest);
 
                if($donerequest_result==TRUE) {
                    $count = mysqli_num_rows($donerequest_result);
                                    
                    if($count>0) {
                      
                        while($rows=mysqli_fetch_assoc($donerequest_result)) {?>
                            <div class="row_app">

                                <div class="col_app">
                                    <?php echo $rows['appointment_date']; ?>
                                </div>

                                <div class="col_app">
                                    <?php echo $rows['date_accepted']; ?>
                                </div>

                                <div class="col_app">
                                    <?php echo $rows['date_created'];  ?>
                                </div>

                                <div class="col_app">
                                    <?php echo $rows['appointment_type']; ?>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                    </p>
                                    <p>
                                        <?php echo $rows['course']."-".$rows['year']; ?>
                                    </p>
                                 
                                </div>

                                <div class="col_app">
                                    <?php
                                    if($rows['note']==""){
                                        echo "No note.";
                                    }
                                    else{
                                        ?><?php echo $rows['note'];  ?><?php
                                    }
                                    ?>
                                </div>

                                <div class="col_app">
                                    <?php
                                    if($rows['comment']==""){
                                        echo "You did not comment.";
                                    }
                                    else{
                                        ?><?php echo $rows['comment'];  ?><?php
                                    }
                                    ?>
                                </div>
                                
                            </div>
            <?php 
                        }
                    }
                    else{
                        echo "<p class='no_appt_result'>No Past Appointments.</p>";
                    }
                }   
            ?>
        <!-------------------------Show Done Appointments ----------------------------------------------------------------------------------------->          
        </div>
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
    #pastrequests {
        background: #324e9e;
    }
    #pastrequests .card_title,
    #pastrequests .card_body {
        color: #fff;
    }
</style>