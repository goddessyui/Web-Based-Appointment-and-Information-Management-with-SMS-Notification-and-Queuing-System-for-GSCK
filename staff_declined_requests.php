<?php
include("admin_header.php");
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
          
            <div class="col_app">Date Declined</div>
            <div class="col_app">Date Requested</div>
            <div class="col_app">Appt.Type</div>
            <div class="col_app">Student</div> 
            <div class="col_app">Student's Note</div>
            <div class="col_app">Comment</div>

        </div>

        <div>
        <!-------------------------Show Declined Requests in Descending Order or From Most Current------------------------------>  
            <?php
        
                $declinedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE tbl_appointment_detail.status = 'Declined' AND tbl_appointment.staff_id = '$staff_id' 
                    ORDER BY appointment_date DESC";
                $declinedrequest_result = mysqli_query($db, $declinedrequests);
            
                if($declinedrequest_result==TRUE) {
                    $count = mysqli_num_rows($declinedrequest_result);
                                
                    if($count>0) {
                        
                        while($rows=mysqli_fetch_assoc($declinedrequest_result)) {?>
                            <div class="row_app">

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
                                    <p>
                                        <?php echo $rows['appointment_type']; ?>
                                    </p>
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
                                    <p>
                                        <?php
                                        if($rows['note']==""){
                                            echo "No note.";
                                        }
                                        else{
                                            echo $rows['note'];
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php
                                        if($rows['comment']==""){
                                            echo "You did not comment.";
                                        }
                                        else{
                                        echo $rows['comment'];
                                        }
                                        ?>
                                    </p>    
                                </div>
                                
                            </div><?php 
                        }
                    }
                    else{
                        echo "<p class='no_appt_result'>No Declined Appointments.</p>";
                    }
                }   
            ?>
        <!-------------------------Show Declined Requests ------------------------------>          
        </div>
    </div>
        <?php
        include("backtotop.php");
        ?>  
</main>

<style>
    #declinedrequests {
        background: #324e9e;
    }
    #declinedrequests .card_title,
    #declinedrequests .card_body {
        color: #fff;
    }
</style>