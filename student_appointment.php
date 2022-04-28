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
    <div class="search_container">
        <form name="form1" method="get" action="">
            <div class="search-box">
                <h2>Select Appointment Type</h2>
                <p class="at_under_staff">OFFICE HOURS ARE FROM 8AM-5AM ONLY</p>
            </div>

            <div class="search-box">
                <input type="text" autocomplete="off" placeholder="Search staff name..." name="search" id="search" value="" required>
                <div class="result"></div>

                <button type="submit" value="Find" name="formsubmit" id="formsubmit">Search</button>
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
                    
            <?php
                }
                else{//--end of message if insert appointment successful-->
                }    
            ?>
                        
                    <div class="main_apt_container">
                        <div class="aptype-container">

                            <button type="submit" class="aptype" value="Meeting" name="appointmenttype" onclick="meeting_at()">
                                <div class="content_type">
                                    <h4>Meeting</h4>
                                    <div class="p_flex_end">
                                    <p>This is a general appointment type. Indicate your purpose in the note.</p>
                                    </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Presentation" name="appointmenttype" onclick="presentation_at()">
                                <div class="content_type">
                                    <h4>Presentation</h4>
                                    <div class="p_flex_end">
                                    <p>For defense, reporting, or other presentation types.</p>
                                    </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Module Claiming or Submission" name="appointmenttype" onclick="modulesubmission_at()">
                                <div class="content_type">
                                    <h4>Module Claiming or Submission</h4>
                                    <div class="p_flex_end">
                                    <p>Bring your receipt to claim your module.</p>
                                    </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Project Submission" name="appointmenttype" onclick="projectsubmission_at()">
                                <div class="content_type">
                                    <h4>Project Submission</h4>
                                    <div class="p_flex_end">
                                    <p> Office hours are from 8 am to 5 pm.</p>
                                    </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Evaluation of Grades" name="appointmenttype" onclick="evaluationofgrades_at()">
                                <div class="content_type">
                                    <h4>Evaluation of Grades</h4>
                                    <div class="p_flex_end">
                                    <p>Choose the correct Department Head for your department.</p>
                                        </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Pre-Enrollment" name="appointmenttype" onclick="preenrollment_at()">
                                <div class="content_type">
                                    <h4>Pre-Enrollment</h4>
                                    <div class="p_flex_end">
                                    <p>Please bring a pen and necessary documents.</p>
                                        </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Enrollment" name="appointmenttype" onclick="enrollment_at()">
                                <div class="content_type">
                                    <h4>Enrollment</h4>
                                    <div class="p_flex_end">
                                    <p>Please bring a pen and necessary documents.</p>
                                    </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Request Documents From Registrar" name="appointmenttype" onclick="requestdocuments_at()">
                                <div class="content_type">
                                    <h4>Request Documents</h4>
                                    <div class="p_flex_end">
                                    <p>Requested From Registrar. Bring your own pen.</p>
                                    </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Request for Grades" name="appointmenttype" onclick="requestforgrades_at()">
                                <div class="content_type">
                                    <h4>Request for Grades</h4>
                                    <div class="p_flex_end">
                                    <p>Requested From Registrar.</p>
                                    </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="Application for Graduation" name="appointmenttype" onclick="grad_at()">
                                <div class="content_type">
                                    <h4>Application for Graduation</h4>
                                    <div class="p_flex_end">
                                        <p>Bring your own pen and necessary documents.</p>
                                    </div>
                                </div>
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
                                <div class="content_type">
                                    <h4>UniFAST - Claim Cheque</h4>
                                    <div class="p_flex_end">
                                    <p>Bring your own pen and necessary documents.</p>
                                    </div>
                                </div>
                            </button>

                            <button type="submit" class="aptype" value="UniFAST - Submit Documents" name="appointmenttype" onclick="unifastsd_at()">
                                <div class="content_type">
                                    <h4>UniFAST - Submit Documents</h4>
                                    <div class="p_flex_end">
                                    <p>Bring your own pen and necessary documents.</p>
                                        </div>
                                </div>
                            </button>

                        </div>
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
                
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>
                        
                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Meeting">             
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Meeting------------------------------------------------------------------------------------->



                <div id="at_enrollment"><!-- Start of Enrollment------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Enrollment">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Enrollment------------------------------------------------------------------------------------->



                <div id="at_evaluationofgrades"> <!-- Start of Evaluation of Grades------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Evaluation of Grades'";

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Evaluation of Grades">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Evaluation of Grades------------------------------------------------------------------------------------->



                <div id="at_modulesubmission"> <!-- Start of Module Submission------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Module Claiming or Submission'";

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Module Claiming or Submission">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Module Submission------------------------------------------------------------------------------------->



                <div id="at_preenrollment"><!-- Start of Pre-enrollment------------------------------------------------------------------------------------->
                    <div class="apt_content">


                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Pre-Enrollment">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Pre-enrollment------------------------------------------------------------------------------------->



                <div id="at_presentation"><!-- Start of Presentation------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Presentation">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Presentation------------------------------------------------------------------------------------->



                <div id="at_projectsubmission"><!-- Start of Project Submission------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Project Submission">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Project Submission------------------------------------------------------------------------------------->



                <div id="at_requestdocuments"><!-- Start of Request Documents------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Request Documents From Registrar">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Request Documents------------------------------------------------------------------------------------->



                <div id="at_requestforgrades"><!-- Start of Request for Grades------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Request for Grades">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Request for Grades------------------------------------------------------------------------------------->



                <div id="at_unifastcc"><!-- Start of Unifast Claim Cheque------------------------------------------------------------------------------------->
                    <div class="apt_content">


                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="UniFAST - Claim Cheque">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Unifast CLaim Cheque------------------------------------------------------------------------------------->



                <div id="at_unifastsd"><!-- Start of Unifast Submit Documents------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

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
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="UniFAST - Submit Documents">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Unifast Submit Documents------------------------------------------------------------------------------------->


                <div id="at_appforgrad"><!-- Start of Application for Graduation------------------------------------------------------------------------------------->
                    <div class="apt_content">

                        <button class="bg-outer" onclick="CloseLoginBtn()">
                            <div class="outer">
                                <div class="inner">
                                    <label>EXIT</label>
                                </div>
                            </div>
                        </button>

                        <div class="apt_container_div">

                    <?php
                        $staff_appointment ="SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
                                            tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id 
                                            WHERE EXISTS(SELECT * FROM tbl_staff_record 
                                            WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id)  
                                            AND appointment_type = 'Application for Graduation'";

                        $atresult = mysqli_query($db, $staff_appointment);
                        $count = mysqli_num_rows($atresult);

                            if($count > 0) {
                    ?>  
                                <h2>Appointment Type: Application for Graduation</h2>
                                <h3>Select A Staff Member:</h3>

                                <form action="appointment/student_insert_appointment.php" method="post">                 
                                    <?php
                                    while($rows = mysqli_fetch_assoc($atresult)) { 
                                    ?>
                                        <label class="radio_design">
                                            <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                            <span><?php echo $rows['first_name']." ".$rows['last_name'];?></span>
                                        </label>

                                        <input type="hidden" name="appointmenttype" value="Application for Graduation">                   
                                    <?php   
                                    }
                                    ?>
                                    <h4>Note to Staff (Optional):</h4>
                                    <small>You can specify an appointment or add additional appointment requests for the same staff here. 
                                    Please keep your message brief and relevant.  (For example: "Verification of Grades", "Request for TOR.")</small>
                                    <div class="textarea_div"><textarea name="note"></textarea></div>
                                    <input type="submit" id="request" name="request" value="Request Appointment">

                                </form>
                            <?php }
                            else {
                                echo "No staff with this appointment type.";
                            } ?>
                        </div>
                    </div>
                </div><!-- End of Application for Graduation------------------------------------------------------------------------------------>


        <?php
        }
        ?>
   </div> 
</div>

    
<style>
    .parent_div{
       width: 100%;
       margin-top: 80px;
       padding-top: 5vh;
       padding-bottom: 5vh;
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
    #at_unifastsd,
    #at_appforgrad {
        display: flex;
        transform: translateY(-90vh);
        opacity: 0;
        position: fixed;
        width: 100%;
        height: 90vh;
        background: #0005;
        top: 80px;
        align-items: center;
        justify-content: center;
        transition: all .3s ease-in-out;
    }

    #at_all{
        display: flex;
        position: fixed;
        width: 100%;
        height: 90vh;
        background: #0005;
        top: 80px;
        align-items: center;
        justify-content: center;
        transition: all .3s ease-in-out;
    }

    .apt_content {
        width: 760px;
        height: 60vh;
        background: #fff;
    }




.main_apt_container {
    margin-top: 10px;
    padding: 5% 0;
    background: green;
    background-image: url("./image/appoint.jpg");
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}
    .aptype-container {
        width: 80%;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
    }
    .aptype {
        background: #fff;
        border: none;
        cursor: pointer;
        display: flex;
        width: 24.15%;
        margin: 5px;
        justify-content: center;
        box-shadow: 0 1px 5px #0001;
        transition: all .2s ease-in-out;
    }

    .aptype:hover {
        transform: scale(1.025);
        background: #FCD227;
    }
   
    .aptype .content_type {
        width: 100%;
        padding: 30px;
    }
    .aptype-container .aptype .content_type h4 {
        font-size: 20px;
        font-family: 'times new roman';
        text-transform: uppercase;
        color: #333;
        text-align: left;
        height: 40px;
        text-decoration: underline;
    }
    .p_flex_end {
        height: 80px;
        display: flex;
        align-items: flex-end;
    }
    .aptype-container .aptype .content_type p {
       text-align: left;
       font-family: 'times new roman';
       font-size: 16px;
       color: #555;
    }
    .at_under_staff {
        font-family: Lato;
        text-transform: uppercase;
        transform: translateY(6px);
        font-size: 14px;
        color: #333;
    }
    





/* ----apt_container_div----- */


.apt_container_div {
    background: #fff;
    padding: 40px;
    height: 60vh;
}
.apt_container_div h2 {
    font-size: 20px;
    text-decoration: underline;
    margin-bottom: 40px;
}





.apt_container_div h3 {

}
.apt_container_div form {

}
.apt_container_div form h4 {

}
.apt_container_div form small {

}
.apt_container_div form .radio_design {
    color: #fff;
    background-color: gray;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    height: 30px;
}
.apt_container_div form .radio_design span {

}
.apt_container_div form input[type=radio] {

}
.apt_container_div form input[type=submit] {

}
.apt_container_div form textarea {

}

/* end --- apt_container_div */







    /* Formatting search box */
    .search_container {
        width: 80%;
        height: 80px;
        margin: 0 auto;
        padding: 0 8px;
    }
    .search_container form {
        width: 100%;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: space-between;

    }
    .search-box:nth-child(1) h2 {
        text-decoration: underline;
    }
    .search-box:nth-child(2) {
        width: 50%;
        display: flex;
    }

    .search-box input[type="text"]{
        height: 30px;
        outline: none;
        border: none;
        background: none;
        border: 1px solid lightgrey;
        font-size: 15px;
        font-family: 'times new roman';
        padding-left: 10px;
        color: #666;

    }
    .search-box:nth-child(2) button {
        height: 30px;
        outline: none;
        border: none;
        background: #333;
        color: #eee;
        cursor: pointer;
        padding-left: 30px;
        padding-right: 30px;
        font-family: Roboto;
        text-transform: uppercase;
        font-size: 12px;
        margin-left: 10px;
    }
   
    .result{
        position: absolute;        
        top: 175px;
        left: 0;
        margin-left: 50%;
    }
    .search-box input[type="text"] {
        width: 100%;
    }
    /* End of Formatting search box */
    /* Formatting result items */
    .result p{
        cursor: pointer;
        background: #324E9E;
        padding: 5px 12px;
        color: #eee;
        font-family: Lato;
        text-transform: uppercase;
        font-size: 12px;
    }
    .result p:hover{
        background: #5463FF;
    }
    /* End of Formatting result items */
    

    </style>


<script>

    function meeting_at() {
        document.getElementById('at_meeting').style.transform = "translateY(0)";
        document.getElementById('at_meeting').style.opacity = "1";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";
        
        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";

    }

    function enrollment_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(0)";
        document.getElementById('at_enrollment').style.opacity = "1";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }

    function evaluationofgrades_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(0)";
        document.getElementById('at_evaluationofgrades').style.opacity = "1";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }

    function modulesubmission_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(0)";
        document.getElementById('at_modulesubmission').style.opacity = "1";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }

    function preenrollment_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(0)";
        document.getElementById('at_preenrollment').style.opacity = "1";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }

    function presentation_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(0)";
        document.getElementById('at_presentation').style.opacity = "1";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }

    function projectsubmission_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(0)";
        document.getElementById('at_projectsubmission').style.opacity = "1";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }

    function requestdocuments_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(0)";
        document.getElementById('at_requestdocuments').style.opacity = "1";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }

    function requestforgrades_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(0)";
        document.getElementById('at_requestforgrades').style.opacity = "1";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";
        
        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }
    
    function unifastcc_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(0)";
        document.getElementById('at_unifastcc').style.opacity = "1";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }

    function unifastsd_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(0)";
        document.getElementById('at_unifastsd').style.opacity = "1";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";
        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";

    }

    function grad_at() {
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(0)";
        document.getElementById('at_appforgrad').style.opacity = "1";

        menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";
    }


</script>





