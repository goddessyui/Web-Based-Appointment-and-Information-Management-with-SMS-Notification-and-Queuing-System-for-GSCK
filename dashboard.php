<?php 
    include("new_header_admin.php");
?>


    <main>
            
        <!---------------Reports for Registrar------------------------------------------------->
        <?php
        if ($position == "Registrar") {//Start of show if Registrar
            include("count_gsck.php");
        }//End of show if Registrar
        ?>
        <!---------------Reports for Registrar------------------------------------------------->


            
                <!---------------Limit Appointments and Show List of Students and Staff, only seen by Registrar------------------------------------------------->
       
            <div class="limit_div">
                <?php 
                if ($position == "Registrar") { ?>
                    <div class="limit_container">
                        <form action="appointment_limit.php" method="post">
                            <div class="top_flex">
                                <h4>Max number of Appointment per Day</h4>
                            
                                <?php
                                    $limit = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
                                    $limitvalue= mysqli_query($db, $limit);
                                    if($limitvalue==TRUE){
                                        while($al=mysqli_fetch_assoc($limitvalue)){

                                            ?><h4><?php echo $al['appointment_limit'];?></h4><?php
                                ?>
                            </div>

                            <div class="top_flex">
                                        <h4>Input Appointment Limit</h4>
                                        <div class="form_group">
                                            <input type="number" class="limit_value" name="limit_value" value="<?php echo $al['appointment_limit'];?>" min="1" max="5000">
                                        </div>

                                        <div class="form_group">
                                            <input class="limit_btn" type="submit" name="limit" value="Set Limit">
                                        </div>
                            </div>

                            <?php
                                    }
                                }
                            ?>
                        </form>
                    </div>

                    <?php
                }
                if ($position == "Accounting Staff/Scholarship Coordinator" OR $position=="Teacher") { 
                    ?>

                
                    <div class="limit_container">
                        <div class="top_flex">
                            <h4>Allowed No. of Appointments Today:</h4>
                            <?php  
                            $applimit = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
                            $al = mysqli_query($db, $applimit);
                            
                            $limit= mysqli_fetch_assoc($al);
                                ?><h4><?php echo $limit['appointment_limit'];?></h4>
                        </div>
                        <div class="top_flex">
                            <h4 style="font-family: 'Roboto'; font-size: 13px; font-weight: 400; margin-top: 30px; text-transform: uppercase;">No. of Appointment Slots Taken Today:</h4>
                            <?php
                            date_default_timezone_set('Asia/Manila');                           		
                            $currentdate = date("Y-m-d");
                            
                            $applimit = "SELECT appointment_detail_id FROM tbl_appointment_detail 
                                WHERE `status` = ('Accepted' OR 'Cancelled') 
                                AND appointment_date = '$currentdate'";
                            $al = mysqli_query($db, $applimit);
                            $count = mysqli_num_rows($al);
                            ?><h4 style="font-family: 'Roboto Serif'; font-size: 30px; font-weight: 500;"><?php echo $count; ?></h4>     
                        </div>
                    </div>
                    <?php
                }

                date_default_timezone_set('Asia/Manila');                           		
                $currentdate = date("Y-m-d");

                $countapp = "SELECT * FROM tbl_appointment_detail 
                WHERE appointment_date = '$currentdate' 
                AND `status`='Accepted'";

                $countapp_today = mysqli_query($db, $countapp);
                $countapp_today_result = mysqli_num_rows($countapp_today);
             
                if($countapp_today_result>0){
                    ?>
                    <div class="limit_container">
                        <div id="top_x_div"></div>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="limit_container">
                        <div class="no_sched">No Scheduled Appointments Today</div>
                    </div>
                    <?php
                }
                ?>

                <div class="limit_container">
                    <div id="piechart"></div>
                </div>
            
            </div>

            <div class="error_message">
                <!--success or error-->                        
                <?php 
                    if(isset($_GET['success'])){
                ?>
                        <p>
                            <?php 
                                echo $_GET['success'];
                            ?>
                        </p>
                <?php
                    }
                    if(isset($_GET['error'])){
                ?>
                                <p>
                                    <?php 
                                        echo $_GET['error'];
                                    ?>
                                </p>
                        <?php
                            }
                    else{
                    }
                ?>
                <!--success or error-->
            </div>



            <div class="appointment_result">
                <?php 
                if ($position == "Registrar") { ?>    
                    <div class="list_div">

                        <div class="reg_print_div">

                        <h4>List of Registered Staff</h4>

                                <form method="post">
                                    <span>Alphabetical</span>
                                    <select name="alphabetical_ln_staff" id="alphabetical_ln_staff">
                                        <option value="('%')">ALL</option>
                                        <option value="'A%'">A</option>
                                        <option value="'B%'">B</option>
                                        <option value="'C%'">C</option>
                                        <option value="'D%'">D</option>
                                        <option value="'E%'">E</option>
                                        <option value="'F%'">F</option>
                                        <option value="'G%'">G</option>
                                        <option value="'H%'">H</option>
                                        <option value="'I%'">I</option>
                                        <option value="'J%'">J</option>
                                        <option value="'K%'">K</option>
                                        <option value="'L%'">L</option>
                                        <option value="'M%'">M</option>
                                        <option value="'N%'">N</option>
                                        <option value="'O%'">O</option>
                                        <option value="'P%'">P</option>
                                        <option value="'Q%'">Q</option>
                                        <option value="'R%'">R</option>
                                        <option value="'S%'">S</option>
                                        <option value="'T%'">T</option>
                                        <option value="'U%'">U</option>
                                        <option value="'V%'">V</option>
                                        <option value="'W%'">W</option>
                                        <option value="'X%'">X</option>
                                        <option value="'Y%'">Y</option>
                                        <option value="'Z%'">Z</option>
                                    </select>

                                    <button id="regstaff" onclick="printDiv_regstaff()" disabled hidden>Print</button>
                                    <input id="ajaxSubmit_gen_report_regstaff" type="submit" value="Show List"/>
                                    <input id="hide_gen_report_regstaff" type="submit" value="Hide List" hidden/>
                                
                                </form>

                            <!--<div class="row" id="generated_rep_registeredstaff"></div>-->
                            <div class="row" id="generated_rep_registeredstaff_hidden"></div><!--- style="display: none;"-->
                            
                        </div>
                    </div>

                    <div class="list_div">

                        <div class="reg_print_div">

                            <h4>List of Registered Students</h4>

                                <form method="post">
                                    <span>Alphabetical</span>

                                    <select name="alphabetical_ln_student" id="alphabetical_ln_student">
                                        <option value="('%')">ALL</option>
                                        <option value="'A%'">A</option>
                                        <option value="'B%'">B</option>
                                        <option value="'C%'">C</option>
                                        <option value="'D%'">D</option>
                                        <option value="'E%'">E</option>
                                        <option value="'F%'">F</option>
                                        <option value="'G%'">G</option>
                                        <option value="'H%'">H</option>
                                        <option value="'I%'">I</option>
                                        <option value="'J%'">J</option>
                                        <option value="'K%'">K</option>
                                        <option value="'L%'">L</option>
                                        <option value="'M%'">M</option>
                                        <option value="'N%'">N</option>
                                        <option value="'O%'">O</option>
                                        <option value="'P%'">P</option>
                                        <option value="'Q%'">Q</option>
                                        <option value="'R%'">R</option>
                                        <option value="'S%'">S</option>
                                        <option value="'T%'">T</option>
                                        <option value="'U%'">U</option>
                                        <option value="'V%'">V</option>
                                        <option value="'W%'">W</option>
                                        <option value="'X%'">X</option>
                                        <option value="'Y%'">Y</option>
                                        <option value="'Z%'">Z</option>
                                    </select>

                                    <span>Course:</span>
                                    <select name="student_course_report" id="student_course_report">
                                        <option value="('%')">ALL</option>  
                                        <option value="'BSHM'">BSHM</option>
                                        <option value="'BSTM'">BSTM</option>
                                        <option value="'BSIT'">BSIT</option>
                                        <option value="'BSSW'">BSSW</option>
                                        <option value="'ABE'">ABE</option>
                                        <option value="'BECE'">BECE</option>
                                        <option value="'BTVED'">BTVED</option>
                                        <option value="'BSBA'">BSBA</option>
                                        <option value="'ACT'">ACT</option>
                                        <option value="'HM'">HM</option>
                                        <option value="'TESDA PROGRAM'">TESDA PROGRAM</option>
                                    </select>

                                    <span>Year: </span> 
                                    <select name="student_year_report" id="student_year_report">
                                        <option value="('%')">ALL</option>
                                        <option value="'1'">1st Year</option>
                                        <option value="'2'">2nd Year</option>
                                        <option value="'3'">3rd Year</option>
                                        <option value="'4'">4th Year</option>
                                    </select>

                                    <button id="regstudent" onclick="printDiv_regstudent()" disabled hidden>Print</button>
                                    <input id="ajaxSubmit_gen_report_regstudent" type="submit" value="Show List"/>
                                    <input id="hide_gen_report_regstudent" type="submit" value="Hide List" hidden/>
                                    
                                </form>

                            <!--<div class="row" id="generated_rep_registeredstudents"></div>-->
                            <div class="row" id="generated_rep_registeredstudents_hidden"></div><!--- style="display: none;"-->
                        </div>
                    </div>
                

                    <div class="list_div">

                        <div class="reg_print_div">
                            <h4>List of Appointment Schedules</h4>
                                <form method="post">   
                                    <span>DATE:</span>
                                    <input type="date" name="appointment_date" id="appointmentdate" value="<?php echo date("Y-m-d");?>" style="float: none; background: none; border: 1px solid lightgrey; color: #333; padding: 8px; margin-left: 8px; width: 150px;">         
                                            
                                    <button id="print_app" onclick="printDiv_appointment_sched()" disabled hidden>PRINT</button>
                                    <input id="ajaxSubmit_appointment_schedule" type="submit" value="Show List"/>
                                    <input id="hide_appointment_schedule" type="submit" value="Hide List" hidden/>
                                </form>
                            
                                <div class="row" id="generated_appointment_schedule_hidden"></div>
                        </div>
                    </div>

                    <?php
                }
                    ?>    


                    <div class="list_div">
                        <!-- Show and Print Appointment REPORT, seen by all admins -->
                        <div class="reg_print_div">
                            <h4>Appointment Reports</h4>
                            <form method="post">

                                <span>STATUS:</span>
                                <select name="status_report" id="status_report">  
                                    <option value="'Accepted'">Accepted</option>
                                    <option value="'Declined'">Declined</option>
                                    <option value="'Canceled'">Canceled</option>
                                    <option value="'Done'">Done</option>
                                    <option value="'Accepted' AND DATE(tbl_appointment_detail.appointment_date) < CURDATE()">Missed</option>
                                </select>
                                
                                <span>FREQUENCY:</span>
                                <select name="time_report" id="time_report">  
                                    <option value="daily">Daily Report</option>
                                    <option value="weekly">Weekly Report</option>
                                    <option value="monthly">Monthly Report</option>
                                </select>                   
                                    
                                <button id="print_report"onclick="printDiv_appointment_report()" disabled hidden>PRINT</button>
                                <input id="ajaxSubmit_appointment_report" type="submit" value="Show List"/>
                                <input id="hide_appointment_report" type="submit" value="Hide List" hidden/>
                            </form>
                                <div class="row" id="generated_appointment_report_hidden"></div>
                        </div>
                        <!-- Show and Print Appointment REPORT, seen by all admins -->
                    </div>

 

                        <?php 
                    if ($position == "Accounting Staff/Scholarship Coordinator") { ?> 

                        <div class="list_div">

                            <div class="reg_print_div">
                                <h4>List of Unifast Grantees</h4>


                                <form method="post">
                                    <span>Alphabetical (Last Name):</span>
                                    <select name="alphabetical_ln_ug" id="alphabetical_ln_ug">
                                        <option value="('%')">ALL</option>
                                        <option value="'A%'">A</option>
                                        <option value="'B%'">B</option>
                                        <option value="'C%'">C</option>
                                        <option value="'D%'">D</option>
                                        <option value="'E%'">E</option>
                                        <option value="'F%'">F</option>
                                        <option value="'G%'">G</option>
                                        <option value="'H%'">H</option>
                                        <option value="'I%'">I</option>
                                        <option value="'J%'">J</option>
                                        <option value="'K%'">K</option>
                                        <option value="'L%'">L</option>
                                        <option value="'M%'">M</option>
                                        <option value="'N%'">N</option>
                                        <option value="'O%'">O</option>
                                        <option value="'P%'">P</option>
                                        <option value="'Q%'">Q</option>
                                        <option value="'R%'">R</option>
                                        <option value="'S%'">S</option>
                                        <option value="'T%'">T</option>
                                        <option value="'U%'">U</option>
                                        <option value="'V%'">V</option>
                                        <option value="'W%'">W</option>
                                        <option value="'X%'">X</option>
                                        <option value="'Y%'">Y</option>
                                        <option value="'Z%'">Z</option>
                                    </select>

                                    <span>Batch Status:</span>
                                    <select name="batchstatus_ug" id="batchstatus_ug">
                                        <option value="('new' OR 'old')">ALL</option>
                                        <option value="'old'">OLD</option>
                                        <option value="'new'">NEW</option>
                                    </select>
                                    <button id="regug" onclick="printDiv_regug()" disabled hidden>PRINT</button>
                                    <input id="ajaxSubmit_gen_report_ug" type="submit" value="Show List"/>
                                    <input id="ajax_hide_gen_report_ug" type="submit" value="Hide List" hidden/>
                                    
                                </form>
                                <!---<div class="row" id="generated_rep_ug"></div>--->
                                <div class="row" id="generated_rep_ug_hidden" ></div> <!--- style="display: none;"-->

                            </div>

                            <div class="list_div">
                
                                <!-- Show and Print UniFast Schedule, only seen by Accounting Staff -->
                                <div class="reg_print_div">
                                    <h4>List of UniFast Schedules</h4>
                                    <form method="post">
                                        <span>TYPE:</span>
                                            <select name="type" id="type">  
                                                <option value="UniFAST - Claim Cheque">Unifast - Claim Cheque</option>
                                                <option value="UniFAST - Submit Documents">UniFAST - Submit Documents</option>
                                            </select>
                                        

                                        <span>DATE:</span>
                                        <input type="date" name="unifast_appointmentdate" id="unifast_appointmentdate" value="<?php echo date("Y-m-d");?>"  style="float: none; background: none; border: 1px solid lightgrey; color: #333; padding: 8px; margin-left: 8px; width: 150px;">

                                        <button id="print_unifast" onclick="printDiv_unifastsched()" disabled hidden>PRINT</button>
                                        <input id="ajax_show_unifast" type="submit" value="Show List"/>
                                        <input id="ajax_hide_unifast" type="submit" value="Hide List" hidden/>
                                    </form>  
                                        
                                        <div class="row" id="generated_unifast_schedule_hidden"></div>
                                </div>

                                <!-- Show and Print UniFast Schedule, only seen by Accounting Staff -->
                            </div>

                        </div> 
                        <?php 
                    }    ?> 



                <!--------------------- Appointment Limit and Show List of Students and Staff, only seen by Accounting Staff------------------------------------------>




            </div>
   
    </div>
  </main>



  </div>
</div>

<div class="mobile_header"></div>

</body>
</html>


<style>
    .card_row_div {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        padding: 15px;
        background: #EDEEF3;
    }
    .card_row_div .col_3 {
        width: 182px;
        height: 110px;
        text-align: center;
        cursor: pointer;
        background: #FFFEFE;
    }
    .card_row_div .col_3 a {
        text-decoration: none;
        color: #000;
    }

    .card_row_div .col_3 .card .card_title {
        padding: 15px;
        font-size: 14px;
        text-transform: uppercase;
        color: #333;
        height: 50px;
        font-weight: 500;
    }
    .card_row_div .col_3 .card .card_body {
        padding-bottom: 15px;
        font-size: 30px;
    }
</style>


<script>
       $(document).ready(function() {
        $('#ajaxSubmit_gen_report_regstudent').click(function(){
            $('#regstudent').prop('disabled', true);
            $("#regstudent").hide();
            
            /*
            $.post("adminajax_regstudent.php", 
            {alphabetical_ln_student: $('#alphabetical_ln_student').val(),
            student_course_report: $('#student_course_report').val(),
            student_year_report: $('#student_year_report').val(),},
            function(data){
                $('#generated_rep_registeredstudents').html(data);
            });
            */
            $.post("adminajax_regstudentprint.php", 
            {alphabetical_ln_student: $('#alphabetical_ln_student').val(),
            student_course_report: $('#student_course_report').val(),
            student_year_report: $('#student_year_report').val(),},
            function(data){
                $('#generated_rep_registeredstudents_hidden').html(data);
                if (!data.includes('No result.')){
                    $('#regstudent').prop('disabled', false);
                     $('#regstudent').show();
                     $("#hide_gen_report_regstudent").show();
                     $("#ajaxSubmit_gen_report_regstudent").hide();
                }
            });
            
            return false;
                    
                });

        });

        $(document).ready(function() {
        $('#ajaxSubmit_gen_report_regstaff').click(function(){
            $('#regstaff').prop('disabled', true);
            $("#regstaff").hide();
            
            /*
            $.post("adminajax_regstaff.php", 
            {alphabetical_ln_staff: $('#alphabetical_ln_staff').val(),},
            function(data){
                $('#generated_rep_registeredstaff').html(data);
            });
            */
            $.post("adminajax_regstaffprint.php", 
            {alphabetical_ln_staff: $('#alphabetical_ln_staff').val(),},
            function(data){
                $('#generated_rep_registeredstaff_hidden').html(data);
                if (!data.includes('No result.')){
                    $('#regstaff').prop('disabled', false);
                     $('#regstaff').show();
                     $('#hide_gen_report_regstaff').show();
                     $('#ajaxSubmit_gen_report_regstaff').hide();
                }
            });
            
            return false;
                    
                });

        });

        $(document).ready(function() {
        $('#ajaxSubmit_gen_report_ug').click(function(){
            $('#regug').prop('disabled', true);
            $("#regug").hide();
      
            /*
            $.post("adminajax_ug.php", 
            {alphabetical_ln_ug: $('#alphabetical_ln_ug').val(),
            batchstatus_ug: $('#batchstatus_ug').val(),},
            function(data){
                $('#generated_rep_ug').html(data);
            });
            */

            $.post("adminajax_ugprint.php", 
            {alphabetical_ln_ug: $('#alphabetical_ln_ug').val(),
            batchstatus_ug: $('#batchstatus_ug').val(),},
            function(data){
                $('#generated_rep_ug_hidden').html(data);
                if (!data.includes('No result.')){
                    $('#regug').prop('disabled', false);
                     $('#regug').show();
                     $('#ajax_hide_gen_report_ug').show();
                     $('#ajaxSubmit_gen_report_ug').hide();
                }
            });
            
            return false;
                    
                });

        });
   
       
        function printDiv_regstudent() {
            var printContents_regstudent = document.getElementById("generated_rep_registeredstudents_hidden").innerHTML;
			var originalContents_regstudent = document.body.innerHTML;
			document.body.innerHTML = printContents_regstudent;
			window.print();
			document.body.innerHTML = originalContents_regstudent;
        }

        function printDiv_regstaff() {
            var printContents_regstaff = document.getElementById("generated_rep_registeredstaff_hidden").innerHTML;
			var originalContents_regstaff  = document.body.innerHTML;
			document.body.innerHTML = printContents_regstaff;
			window.print();
			document.body.innerHTML = originalContents_regstaff ;

        }

        function printDiv_regug() {
            var printContents_regug = document.getElementById("generated_rep_ug_hidden").innerHTML;
			var originalContents_regug = document.body.innerHTML;
			document.body.innerHTML = printContents_regug;
			window.print();
			document.body.innerHTML = originalContents_regug;

        }
    


// FETCH DATA for Appointment Schedule for Registrar
    $(document).ready(function() {
    $('#ajaxSubmit_appointment_schedule').click(function(){
        $('#print_app').prop('disabled', true);
        $('#print_app').hide();
        $.post("adminajax_appointment_schedule.php", 
        {appointment_date: $('#appointmentdate').val(),},
        function(data){
            $('#generated_appointment_schedule_hidden').html(data);
            if (!data.includes('No result.')){
            $('#print_app').prop('disabled', false);
            $('#print_app').show();
            $('#hide_appointment_schedule').show();
            $('#ajaxSubmit_appointment_schedule').hide();        
            }
        });
        return false;        
            });
        });

    function printDiv_appointment_sched() {
        var printContents_regstudent = document.getElementById("generated_appointment_schedule_hidden").innerHTML;
		var originalContents_regstudent = document.body.innerHTML;
		document.body.innerHTML = printContents_regstudent;
		window.print();
		document.body.innerHTML = originalContents_regstudent;
    }
    // FETCH DATA for Appointment Schedule for Registrar


// FECTCH DATA for appointment reports
$(document).ready(function() {
        $('#ajaxSubmit_appointment_report').click(function(){
            $('#print_report').prop('disabled', true);
            $("#print_report").hide();
            $.post("adminajax_appointmentreport.php", 
            {status_report: $('#status_report').val(),
            time_report: $('#time_report').val(),},
            function(data){
                $('#generated_appointment_report_hidden').html(data);
                if (!data.includes('No result.')){
                $('#print_report').prop('disabled', false);
                $("#print_report").show();
                $("#hide_appointment_report").show();
                $("#ajaxSubmit_appointment_report").hide();
                }
            });
            
            return false;
                    
                });

        });

        function printDiv_appointment_report() {
            var printContents_regstudent = document.getElementById("generated_appointment_report_hidden").innerHTML;
			var originalContents_regstudent = document.body.innerHTML;
			document.body.innerHTML = printContents_regstudent;
			window.print();
			document.body.innerHTML = originalContents_regstudent;
        }
        // FECTCH DATA for appointment reports


    // FETCH DATA for Unifast schedules for accounting Staff
    $(document).ready(function() {
        $('#ajax_show_unifast').click(function(){   
            $('#print_unifast').prop('disabled', true);
            $('#print_unifast').hide();
            $.post("adminajax_unifastschedule.php", 
            {appointment_date: $('#unifast_appointmentdate').val(),
            appointment_type: $('#type').val(),},
            function(data){
                $('#generated_unifast_schedule_hidden').html(data);
                if (!data.includes('No result.')){
                $('#print_unifast').prop('disabled', false);
                $('#print_unifast').show();
                $('#ajax_hide_unifast').show();
                $('#ajax_show_unifast').hide();
                }
                
            });
            return false;         
                });
        });
        function printDiv_unifastsched() {
            var printContents_regstudent = document.getElementById("generated_unifast_schedule_hidden").innerHTML;
			var originalContents_regstudent = document.body.innerHTML;
			document.body.innerHTML = printContents_regstudent;
			window.print();
			document.body.innerHTML = originalContents_regstudent;
        }
    // FETCH DATA for Unifast schedules for accounting Staff

    // HIDE LIST BUTTON PROCESS
    // appointment report
    $(document).ready(function() {
        $('#hide_appointment_report').click(function(){   
            $('#generated_appointment_report_hidden').html('');
            $("#print_report").hide();
            $("#hide_appointment_report").hide();
            $("#ajaxSubmit_appointment_report").show();
            return false;         
        });
    });
    // registred staff
    $(document).ready(function() {
        $('#hide_gen_report_regstaff').click(function(){   
            $('#generated_rep_registeredstaff_hidden').html('');
            $('#regstaff').hide();
            $('#hide_gen_report_regstaff').hide();
            $('#ajaxSubmit_gen_report_regstaff').show();
            return false;         
        });
    });
    // registred student
    $(document).ready(function() {
        $('#hide_gen_report_regstudent').click(function(){   
            $('#generated_rep_registeredstudents_hidden').html('');
            $('#regstudent').hide();
            $("#hide_gen_report_regstudent").hide();
            $("#ajaxSubmit_gen_report_regstudent").show();
            return false;         
        });
    });
    // appointment schedule
    $(document).ready(function() {
        $('#hide_appointment_schedule').click(function(){   
            $('#generated_appointment_schedule_hidden').html('');
            $('#print_app').hide();
            $('#hide_appointment_schedule').hide();
            $('#ajaxSubmit_appointment_schedule').show(); 
            return false;         
        });
    });
    // List of unifast grantees
    $(document).ready(function() {
        $('#ajax_hide_gen_report_ug').click(function(){   
            $('#generated_rep_ug_hidden').html('');
            $('#regug').hide();
            $('#ajax_hide_gen_report_ug').hide();
            $('#ajaxSubmit_gen_report_ug').show();
            return false;         
        });
    });
    // Unifast Schedule
    $(document).ready(function() {
        $('#ajax_hide_unifast').click(function(){   
            $('#generated_unifast_schedule_hidden').html('');
            $('#print_unifast').hide();
            $('#ajax_hide_unifast').hide();
            $('#ajax_show_unifast').show();
            return false;         
        });
    });

    // HIDE LIST BUTTON PROCESS
    
         

    </script>
 


