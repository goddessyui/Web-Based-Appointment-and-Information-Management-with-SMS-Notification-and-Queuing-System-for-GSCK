<?php
include("dbconfig.php");
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<div>
    
    <?php
    
    $name = explode(", ", $_POST['search']);
    $search2 = $name[0];
    $search = end($name);


    $sql="SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name, tbl_staff_registry.staff_id, 
    tbl_staff_appointment.appointment_type 
    FROM tbl_staff_registry INNER JOIN tbl_staff_appointment 
    ON tbl_staff_registry.staff_id = tbl_staff_appointment.staff_id 
    WHERE EXISTS(SELECT * FROM tbl_staff_record WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id) AND tbl_staff_registry.last_name = '$search2' AND tbl_staff_registry.first_name LIKE '$search'";
    $run= mysqli_query($db, $sql);
    
    if($run==TRUE) {
        $foundnum = mysqli_num_rows($run);
        if($foundnum > 0) {$i=0;
             
    ?><h2>Appointments Under <?php echo  $_POST['search']; ?></h2>
    <h4>Select An Appointment Type:</h4>
                <form method="post">
    <?php
            while($rows = mysqli_fetch_assoc($run)) { 
                $at = "at".$i++;
    ?>          
                <button type="submit" class="aptype" name="<?php echo $at;?>" id="<?php echo $at;?>" required value="<?php echo $rows['appointment_type'];?>">
                    <?php echo $rows['appointment_type'];?><hr>
                    <?php
                        $atype=$rows['appointment_type'];
                        if($atype=="Meeting"){?>
                            <p>Description: Please select this appointment type if the appointment type you're looking for is not in the list. 
                            Indicate your purpose in the note. Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="Enrollment"){?>
                            <p>Description: Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                        <?php
                        }
                        if($atype=="Evaluation of Grades"){?>
                            <p>Description: Please choose the correct Department Head for your department. 
                            Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="Module Claiming/Submission"){?>
                            <p>Description: Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                        <?php
                        }
                        if($atype=="Pre-Enrollment"){?>
                            <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm. 
                            Please bring a pen and necessary documents.</p>
                        <?php
                        }
                        if($atype=="Presentation"){?>
                            <p>Description: Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="Project Submission"){?>
                            <p>Description: Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="Request Documents From Registrar"){?>
                            <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm. Please bring a pen.</p> 
                        <?php
                        }
                        if($atype=="Request for Grades"){?>
                           <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="UniFAST - Claim Cheque"){?>
                            <p>Description: Requested From Accounting Staff/Scholarship Coordinator. 
                            Office hours are from 8 am to 5 pm. Please bring a pen and your ID. </p>
                        <?php
                        }
                        if($atype=="UniFAST - Submit Documents"){?>
                            <p>Description: Requested From Accounting Staff/Scholarship Coordinator.
                             Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                        <?php
                        }
                    ?>
                    
                </button>
                <input type="hidden" name="fn" id="fn" value="<?php echo $rows['first_name'];?>"> 
                <input type="hidden" name="ln" id="ln" value="<?php echo $rows['last_name'];?>"> 
                <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $rows['staff_id'];?>">
                <input type="hidden" name="appointment_type" id="appointment_type" value="<?php echo $rows['appointment_type'];?>"> 
                
    <?php     
            }
            ?>
            </form>
            <?php
        }
        else {
            
            echo "<br><br><br>No result. This person is not a current staff of GSCK."
            ?>
            
            <br><a href="student_appointment.php"><button>Back to List of Appointments</button></a>
            <?php
            
        }
    }
    else {
        echo "This staff has no appointment types listed.";
    }
?>
</div>

<!------Shows the result when pressing the appointment type button---->
<div id="showform"></div>
<!------Shows the result when pressing the appointment type button---->

<script>
$(document).ready(function() {

    for(let i=0;i<12;i++){
        
        $('#at'+i).click(function(){
    

            $.post("search_button_form.php", 
            {fn: $('#fn').val(),
            ln: $('#ln').val(),
            staff_id: $('#staff_id').val(),
            appointment_type: $('#at'+i).val(),}, 
            function(data){
                $('#showform').html(data);
            });
            return false;

        });
    }   
});


</script>