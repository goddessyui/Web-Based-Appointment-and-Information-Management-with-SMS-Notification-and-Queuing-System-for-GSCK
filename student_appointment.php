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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
/*--------------------------------------Search box script---------------------------------------------------------*/
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("appointment/backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());

        $(this).parent(".result").empty();

    });
});

$(document).ready(function() {
    $('#formsubmit').click(function(){
      
        $.post("search_name.php", 
        {search: $('#search').val()}, 
        function(data){
            $('#response').html(data);
            $('#thisappointment').hide();
        });
        
        return false;
        
    });

});
/*--------------------------------------Search box script---------------------------------------------------------*/
</script>

<div class="parent_div">
    <!--------------------------------------Search box--------------------------------------------------------->
    <div>
        <form name="form1" method="get" action="">
            <div class="search-box"><label><h3>Set An Appointment</h3></label></div>
            <div class="search-box">
                <input type="text" autocomplete="off" placeholder="Search staff name..." name="search" id="search" value="" required>
                <div class="result"></div>
            </div>
            <div class="search-box">
                <button type="submit" value="Find" name="formsubmit" id="formsubmit">Find</button>
            </div>
        </form>
    </div>
    
    <!------Shows the result when pressing find---->
    <div id="response"></div>
    <!------Shows the result when pressing find---->
    <!--------------------------------------Search box--------------------------------------------------------->
   
    <div id="thisappointment">

        <?php
        if(empty($_POST['search'])) {
                if(isset($_GET['msg'])) {//--start of message if insert appointment successful-->
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
                    
                        <div class="aptype-container">
                            <button type="submit" class="aptype" value="Meeting" name="appointmenttype" onclick="meeting_at()">
                                <h4>Meeting</h4><hr>
                                <p>Description: Please select this appointment type if the appointment type you're looking for is not in the list. 
                                    Indicate your purpose in the note. Office hours are from 8 am to 5 pm.</p>
                            </button>

                            <button type="submit" class="aptype" value="Enrollment" name="appointmenttype" onclick="enrollment_at()">
                                <h4>Enrollment</h4><hr>
                                <p>Description: Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                            </button>

                            <button type="submit" class="aptype" value="Evaluation of Grades" name="appointmenttype" onclick="evaluationofgrades_at()">
                                <h4>Evaluation of Grades</h4><hr>
                                <p>Description: Please choose the correct Department Head for your department. 
                                    Office hours are from 8 am to 5 pm.</p>
                            </button>

                            <button type="submit" class="aptype" value="Module Claiming/Submission" name="appointmenttype" onclick="modulesubmission_at()">
                                <h4>Module Claiming/Submission</h4><hr>
                                <p>Description: Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                            </button>

                            <button type="submit" class="aptype" value="Pre-Enrollment" name="appointmenttype" onclick="preenrollment_at()">
                                <h4>Pre-Enrollment</h4><hr>
                                <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm. 
                                    Please bring a pen and necessary documents.</p>
                            </button>

                            <button type="submit" class="aptype" value="Presentation" name="appointmenttype" onclick="presentation_at()">
                                <h4>Presentation</h4><hr>
                                <p>Description: Office hours are from 8 am to 5 pm.</p>
                            </button>

                            <button type="submit" class="aptype" value="Project Submission" name="appointmenttype" onclick="projectsubmission_at()">
                                <h4>Project Submission</h4><hr>
                                <p>Description: Office hours are from 8 am to 5 pm.</p>
                            </button>

                            <button type="submit" class="aptype" value="Request Documents From Registrar" name="appointmenttype" onclick="requestdocuments_at()">
                                <h4>Request Documents</h4><hr>
                                <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm. Please bring a pen.</p> 
                            </button>

                            <button type="submit" class="aptype" value="Request for Grades" name="appointmenttype" onclick="requestforgrades_at()">
                                <h4>Request for Grades</h4><hr>
                                <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm.</p>
                            </button>
                        
                        <?php
                            $sql = "SELECT student_id FROM tbl_unifast_grantee WHERE student_id ='$student_id'";
                            $ugresult = mysqli_query($db, $sql);
                            
                            if (mysqli_num_rows($ugresult) > 0) {
                            // output data of each row

                                while($id = mysqli_fetch_assoc($ugresult)) {
                                    $ug_id= $id['student_id'];
                                    if($student_id==$ug_id){?>
                            <button type="submit" class="aptype" value="UniFAST - Claim Cheque" name="appointmenttype" onclick="unifastcc_at()">
                                <h4>UniFAST - Claim Cheque</h4><hr>
                                <p>Description: Requested From Accounting Staff/Scholarship Coordinator. 
                                    Office hours are from 8 am to 5 pm. Please bring a pen and your ID.</p>
                            </button>

                            <button type="submit" class="aptype" value="UniFAST - Submit Documents" name="appointmenttype" onclick="unifastsd_at()">
                                <h4>UniFAST - Submit Documents</h4><hr>
                                <p>Description: Requested From Accounting Staff/Scholarship Coordinator.
                                    Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                            </button>
                        </div>
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
                        
                                    
            <!-- This ends the buttons for appointment type------------------------------------------------------------------------------------------------->

        
                <div id="at_meeting"><!-- Start of Meeting------------------------------------------------------------------------------------->
                    
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Meeting'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Meeting</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Meeting">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Meeting------------------------------------------------------------------------------------->

                <div id="at_enrollment"><!-- Start of Enrollment------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Enrollment'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Enrollment</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Enrollment">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Enrollment------------------------------------------------------------------------------------->

                <div id="at_evaluationofgrades"> <!-- Start of Evaluation of Grades------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Evaluation of Grades - Department Head'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Evaluation of Grades</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Evaluation of Grades - Department Head">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Evaluation of Grades------------------------------------------------------------------------------------->

                <div id="at_modulesubmission"> <!-- Start of Module Submission------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Module Submission'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Module Submission</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Module Submission">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Module Submission------------------------------------------------------------------------------------->

                <div id="at_preenrollment"><!-- Start of Pre-enrollment------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Pre-Enrollment'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Pre-Enrollment</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Pre-Enrollment">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Pre-enrollment------------------------------------------------------------------------------------->

                <div id="at_presentation"><!-- Start of Presentation------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Presentation'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Presentation</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Presentation">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Presentation------------------------------------------------------------------------------------->

                <div id="at_projectsubmission"><!-- Start of Project Submission------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Project Submission'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Project Submission</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Project Submission">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Project Submission------------------------------------------------------------------------------------->

                <div id="at_requestdocuments"><!-- Start of Request Documents------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Request Documents From Registrar'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Request Documents</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Request Documents From Registrar">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Request Documents------------------------------------------------------------------------------------->

                <div id="at_requestforgrades"><!-- Start of Request for Grades------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Request for Grades'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Request for Grades</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="Request for Grades">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Request for Grades------------------------------------------------------------------------------------->

                <div id="at_unifastcc"><!-- Start of Unifast Claim Cheque------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'UniFAST - Claim Cheque'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: UniFAST - Claim Cheque</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="UniFAST - Claim Cheque">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                </div><!-- End of Unifast CLaim Cheque------------------------------------------------------------------------------------->

                <div id="at_unifastsd"><!-- Start of Unifast Submit Documents------------------------------------------------------------------------------------->
                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'UniFAST - Submit Documents'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: UniFAST - Submit Documents</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                        <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        <input type="hidden" name="appointmenttype" value="UniFAST - Submit Documents">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                                    <textarea name="note"></textarea>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                    
                </div><!-- End of Unifast Submit Documents------------------------------------------------------------------------------------->

        <?php
        }
        ?>
   </div> 
</div>
    
<style>
    .parent_div{
       width: 100%;
       padding-top: 80px;
       padding-left: 5%;
       padding-right: 5%;
    }
    #thisappointment {
        display: block;
    }
    #at_meeting,
    #at_enrollment,
    #at_evaluationofgrades,
    #at_modulesubmission,
    #at_preenrollment,
    #at_presentation,
    #at_projectsubmission,
    #at_requestdocuments,
    #at_requestforgrades,
    #at_unifastcc,
    #at_unifastsd {
        display: none;
    }

    
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
       
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        top: 100%;
        left: 0;
        background-color: white;
        
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* End of Formatting search box */
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
    /* End of Formatting result items */
    

    </style>


<script>

    function meeting_at() {
        document.getElementById('at_meeting').style.display = "block";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function enrollment_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "block";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function evaluationofgrades_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "block";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function modulesubmission_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "block";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function preenrollment_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "block";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function presentation_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "block";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function projectsubmission_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "block";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function requestdocuments_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "block";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function requestforgrades_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "block";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "none";
    }
    
    function unifastcc_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "block";
        document.getElementById('at_unifastsd').style.display = "none";
    }

    function unifastsd_at() {
        document.getElementById('at_meeting').style.display = "none";
        document.getElementById('at_enrollment').style.display = "none";
        document.getElementById('at_evaluationofgrades').style.display = "none";
        document.getElementById('at_modulesubmission').style.display = "none";
        document.getElementById('at_preenrollment').style.display = "none";
        document.getElementById('at_presentation').style.display = "none";
        document.getElementById('at_projectsubmission').style.display = "none";
        document.getElementById('at_requestdocuments').style.display = "none";
        document.getElementById('at_requestforgrades').style.display = "none";
        document.getElementById('at_unifastcc').style.display = "none";
        document.getElementById('at_unifastsd').style.display = "block";
    }

</script>





