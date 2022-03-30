<?php
    include("header.php");
    $student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
    $student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
    $staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
    $position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
    $staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
if ($staff_id != "" && $staff_username != ""){
    if ($position == "Registrar" OR "Accounting Staff/Scholarship Coordinator" OR "Teacher"){
        echo '<script type="text/javascript">window.location.href="admin.php"</script>';
    }
}
if (empty($_SESSION['student_id'])){
    echo '<script type="text/javascript">window.location.href="index.php"</script>';
}   
?>
<div class="parent-div">
    
<div id="search"><?php include("searchbox.php");?></div><hr>
<!-- This starts the buttons for appointment type-------------------------------------------------------------------------------------------------->
<?php    
    if(empty($_GET['submit']))//if no form is submitted, this will not show
    {
        if(isset($_GET['msg'])){//--start of message if insert appointment successful-->
?>
            <p>
                <?php 
                    echo $_GET['msg'];
                ?>
            </p>
            <hr>
<?php
        }
        else{//--end of message if insert appointment successful-->
        }    
?>
        <h4>Select An Appointment Type:</h4>
            <form action=" " method="post">
                <input type="submit" value="Enrollment" name="appointmenttype"><br/><br>
                <input type="submit" value="Evaluation of Grades - Department Head" name="appointmenttype"><br/><br/>
                <input type="submit" value="Meeting" name="appointmenttype"><br/><br>
                <input type="submit" value="Module Submission" name="appointmenttype"><br/><br>
                <input type="submit" value="Pre-Enrollment" name="appointmenttype"><br/><br>
                <input type="submit" value="Presentation" name="appointmenttype"><br/><br>
                <input type="submit" value="Project Submission" name="appointmenttype"><br/><br>
                <input type="submit" value="Request Documents From Registrar" name="appointmenttype"><br/><br>
                <input type="submit" value="Request for Grades" name="appointmenttype"><br/><br>
                <?php
                    $sql = "SELECT student_id FROM tbl_unifast_grantee WHERE student_id ='$student_id'";
                    $result = mysqli_query($db, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                      // output data of each row
                        while($id = mysqli_fetch_assoc($result)){
                            $ug_id= $id['student_id'];
                            if($student_id==$ug_id){?>
                <input type="submit" value="UniFAST - Claim Cheque" name="appointmenttype"><br/><br>
                <input type="submit" value="UniFAST - Submit Documents" name="appointmenttype"><br/><br>
                       <?php
                            }
                            else{
                                echo "UniFAST appointment types will only appear if you are an official UniFAST grantee";
                            }
                        }
                    }
                    else{
                        echo "UniFAST appointment types will only appear if you are an official UniFAST grantee";
                    }
                   
                                           
                ?>
                
                <?php
              
                ?>
            </form><hr>
<?php                     
    }                               
?>                      
<!-- This ends the buttons for appointment type------------------------------------------------------------------------------------------------->

<!-- This starts the form for the modal used to insert into tbl_appointment through student_insert_appointment.php -->
    <?php
        //get data
        if(isset($_POST['appointmenttype']))
        {   
            $appointment_type = $_POST['appointmenttype'];
            $staff_appointment =    "SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                    tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                    WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                    WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                    AND appointment_type = '$appointment_type'";

            $result = mysqli_query($db, $staff_appointment);
            if($result==TRUE) {
                $count = mysqli_num_rows($result);
                if($count > 0) {
    ?>  
                    <h2>Appointment Type: <?php echo $appointment_type;?></h2>
                    <h4>Select A Staff Member:</h4>
    <!-- This starts the Form For Getting List of Teachers and Submitting the Appointment Request-->  
                    <form action="appointment/student_insert_appointment.php" method="post">
                                      
    <?php 
                    while($rows = mysqli_fetch_assoc($result)) { 
    ?>
                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                        <label><?php echo $rows['first_name']." ".$rows['last_name'];?></label>
                        <input type="hidden" name="appointmenttype" value="<?php echo $appointment_type;?>">                   
    <?php   
                    }
                }
            }
    ?>
                        <br><br>
                        <h4>Note to Staff (Optional):</h4>
                        <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                        Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                        <textarea name="note"></textarea>
                        <input type="hidden" name="at" value="<?php echo $appointment_type;?>">
                        <br><br>
                        <input type="submit" name="request" value="Request Appointment">
                       
                    </form><br><br>

    <?php        
        }
    ?>
 </div>                       
                        
    <!-- This ends the Form For Getting List of Teachers and Submitting the Appointment Request-->  
                    
<!-- This ends the form for the modal used to insert into tbl_appointment through student_insert_appointment.php --></body>

<style>
    .parent-div{
        padding-top: 150px;
        margin-left: 15%;
        margin-right: 15%;
 
    }
</style>