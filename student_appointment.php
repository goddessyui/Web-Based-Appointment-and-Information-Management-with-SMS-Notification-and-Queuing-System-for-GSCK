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
                                    <div class="staff_list_label">                 
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Meeting">   
                                        </div>          
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">                 
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Enrollment">     
                                        </div>              
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">                
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Evaluation of Grades">   
                                        </div>                
                                        <?php   
                                        }
                                        ?>
                                        </div>
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
                                    <div class="staff_list_label">                 
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Module Claiming or Submission"> 
                                        </div>                  
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">                
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Pre-Enrollment">    
                                        </div>               
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">                 
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Presentation">   
                                        </div>                
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">               
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Project Submission"> 
                                        </div>   

                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">                   
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Request Documents From Registrar"> 
                                        </div>                  
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">                  
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Request for Grades">      
                                        </div>             
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">                 
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="UniFAST - Claim Cheque">    
                                        </div>               
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">         
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="UniFAST - Submit Documents">    
                                        </div>               
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
                                    <div class="staff_list_label">               
                                        <?php
                                        while($rows = mysqli_fetch_assoc($atresult)) { 
                                        ?>
                                        <div class="div_label">
                                            <label class="radio_design">
                                                <input type="radio" name="staff_id" required value="<?php echo $rows['staff_id'];?>">
                                                <p><?php echo $rows['first_name']." ".$rows['last_name'];?></p>
                                            </label>

                                            <input type="hidden" name="appointmenttype" value="Application for Graduation"> 
                                        </div>                  
                                        <?php   
                                        }
                                        ?>
                                    </div>
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
    background: #EFF0F4;
    
}
    .aptype-container {
        width: 80%;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        padding: 5px 0;
    }
    .aptype {
        background: #fff;
        border: none;
        cursor: pointer;
        display: flex;
        width: 24.12%;
        flex-wrap: wrap;
        margin: 5px;
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
        text-transform: uppercase;
        color: #000;
        text-align: left;
        height: 40px;
        font-family: 'Roboto';
    }
    .p_flex_end {
        height: 80px;
        display: flex;
        align-items: flex-end;
    }
    .aptype-container .aptype .content_type p {
       text-align: left;
       font-size: 14px;
       color: #444;
       text-transform: initial;
       font-family: 'Roboto Serif';
    }
    .at_under_staff {
        text-transform: uppercase;
        transform: translateY(6px);
        font-size: 13px;
        color: #444;
        font-family: 'Roboto';
    }
    





/* ----apt_container_div----- */


.apt_container_div {
    background: #fff;
    padding: 40px;
    height: 60vh;
    overflow: auto;
    width: 100%;
}
.apt_container_div h2 {
    font-size: 16px;
    font-family: 'Roboto Serif';
    margin-bottom: 20px;
}





.apt_container_div h3 {
    font-family: 'Roboto';
    font-size: 14px;
    font-weight: 400;
    color: #333;
    text-transform: uppercase;
    margin-bottom: 12px;
}

form .staff_list_label {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
    width: 100%;
}
.div_label {
   width: 180px;
}

.apt_container_div form .radio_design {
    color: #eee;
    background-color: #444;
    display: flex;
    align-items: center;
    height: 30px;
    width: 160px;
    cursor: pointer;

}


form .staff_list_label input[type=radio] {
    margin-right: 6px;
    margin-left: 12px;
}


form .staff_list_label p {
    font-family: 'Roboto';
    color: #eee;
    font-size: 13px;
    font-weight: 400;
    text-transform: uppercase;
}

.apt_container_div form h4 {
    color: red;
    margin-bottom: 5px;
    font-family: 'Roboto';
    font-size: 13px;
    font-weight: 400;
    color: #333;
    text-transform: uppercase;
}
.apt_container_div form small {
    color: yellow;
    font-family: 'Roboto Serif';
    font-size: 12px;
    color: #444;
}

.apt_container_div form textarea {
    width: 100%;
    height: 80px;
    margin-top: 20px;
    margin-bottom: 12px;
}

.apt_container_div form input[type=submit] {
    background: #324E9E;
    border: none;
    color: #eee;
    font-family: 'Roboto';
    height: 30px;
    padding: 0 20px;
    cursor: pointer;
}










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
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;

    }
    .search-box:nth-child(1) h2 {
        text-decoration: none;
        font-size: 20px;
        color: #333;
        font-family: 'Times New Roman';
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
        padding-left: 10px;
        color: #444;

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
        font-family: 'Roboto Serif';
        font-size: 13px;
        color: #444;
    }
    /* End of Formatting search box */
    /* Formatting result items */
    .result p{
        cursor: pointer;
        background: #324E9E;
        padding: 5px 12px;
        color: #eee;
        text-transform: uppercase;
        font-size: 13px;
        font-family: 'Roboto';
    }
    .result p:hover{
        background: #5463FF;
    }
    /* End of Formatting result items */
    


@media screen and (max-width: 652px) {

    .apt_content {
        width: 80%;
    }
    .div_label:not(:first-child) {
        margin: 0;
        margin-bottom: 5px;
    }
    .div_label {
        margin-bottom: 5px;
    }
    .aptype-container {
        width: 96%;
    }

    .aptype {
        width: 100%;
    }
    .search_container {
        width: 96%;
    }
  
    .search-box:nth-child(2) {
        width: 100%;
        margin-top: 20px;
        padding-bottom: 20px;
    }
  
    .result {
        position: absolute;        
        top: 200px;
        left: 0;
        margin-left: 4%;
    }
    #thisappointment {
        margin-top: 40px;
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
        top: 60px;
    }
    }
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";

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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";

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
            document.getElementById('dropdown_id').style.transform = "translateX(70vh)";
    }


</script>





