<?php 
    include("new_header_admin.php");
?>     
<main>        
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

                                    <span>Status: </span> 
                                    <select name="staff_status" id="staff_status">
                                        <option value="all">ALL</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
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

                                    <span>Status: </span> 
                                    <select name="student_status" id="student_status">
                                        <option value="all">ALL</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
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
            student_status: $('#student_status').val(),
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
            {alphabetical_ln_staff: $('#alphabetical_ln_staff').val(),
                staff_status: $('#staff_status').val(),},
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



<style>
    .appointment_result {
        margin-top: 15px;
        padding: 0 15px;
    }
    .limit_div {
        display: flex;
        width: 100%;
        background: #EFF0F4;
        align-items: center;
        justify-content: space-between;
        padding-top: 5px;
        padding-left: 15px;
        padding-right: 15px;
    }
    .limit_div .limit_container {
        width: 33%;
        background: #fff;
        padding: 15px;
        height: 32vh;
    }
    .limit_div .limit_container:nth-child(1) {
        padding: 30px;
    }
    .limit_div .limit_container:nth-child(2) {
        margin: 0 15px;
    }

    .limit_div .limit_container:nth-child(1) form {
        height: 100%;
    }

    form .top_flex:nth-child(1) {
        height: 36%;
    }

          .top_flex:nth-child(1) h4:nth-child(1) {
              color: #333;
              font-family: 'Roboto';
              font-size: 14px;
              font-weight: 400;
              text-transform: uppercase;
              margin-bottom: 8px;
          }
          .top_flex:nth-child(1) h4:nth-child(2) {
              color: #000;
              font-size: 30px;
              font-family: 'Roboto Serif';
              font-weight: 400;
          }
    form .top_flex:nth-child(2) {
        height: 40%;
    }
    form .top_flex:nth-child(2) h4 {
       margin-top: 15px;
       font-family: 'Roboto';
       margin-bottom: 8px;
       color: #333;
    }
         .top_flex:nth-child(2) .form_group {
             height: 40px;
         }
                                .form_group input {
                                    height: 30px;
                                }
                                .form_group input[type=number] {
                                    margin-bottom: 15px;
                                    width: 100%;
                                    padding: 0 8px;
                                    border: 1px solid lightgrey;
                                    height: 30px;
                                }
                                .form_group input[type=submit] {
                                    width: 100%;
                                    border: none;
                                    background: #324E9E;
                                    color: #fff;
                                    font-size: 14px;
                                    cursor: pointer;
                                    text-transform: uppercase;
                                    height: 30px;
                                }
.error_message {
    background: orange;
    margin-top: 15px;
}
.error_message p {
    padding: 2px 30px;
    font-family: 'Roboto Serif';
    font-size: 14px;
    color: #fff;
}
.card_title,
.card_body {
    cursor: auto;
}



                    .list_div .reg_print_div {
                        background-color: #fff;
                        padding: 30px;
                    }
                    .list_div .reg_print_div:nth-child(1) {
                        margin-bottom: 15px;
                    }

.reg_print_div h4 {
    color: #333;
    font-family: 'Roboto';
    margin-bottom: 15px;
}
.reg_print_div form {
    font-family: 'Roboto';
    font-weight: 400;
    font-size: 14px;
    text-transform: uppercase;
}
.reg_print_div form input {
    border: none;
    background: #324E9E;
    color: #fff;
    height: 32px;
    width: 220px;
    margin-right: 12px;
    cursor: pointer;
    float: right;
}
.reg_print_div form button {
    float: right;
    border: none;
    background: #333;
    color: #eee;
    height: 32px;
    width: 150px;
    font-size: 14px;
    cursor: pointer;
    text-transform: uppercase;
    font-family: 'Roboto';
}
.reg_print_div form select {
    outline: none;
    height: 29px;
    margin-left: 5px;
    margin-right: 12px;
    padding: 0 8px;
    background: none;
    border: 1px solid lightgrey;
    font-family: 'roboto';
    font-size: 14px;
}
.reg_print_div form select option {
    font-family: 'Roboto';
}
.no_sched {
    font-family: 'Roboto Serif';
}



</style>