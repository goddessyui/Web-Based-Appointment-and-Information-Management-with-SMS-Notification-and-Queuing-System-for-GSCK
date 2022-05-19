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
    <div class="limit_container">
        <div class="chart_panel">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script>
       

       const ctx = document.getElementById('myChart');

        var xValues = ["8am - 9am", "9am - 10am", "10am - 11am", "11am - 12nn", "1pm - 2pm", "2pm - 3pm", "3pm - 4pm", "4pm - 5pm"];
        var yValues = [2, 5, 9, 4, 5, 1, 0, 10];

        const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(110,193,247,0.9)');
        gradient.addColorStop(1, 'rgba(15,79,121,1)');

        Chart.defaults.global.defaultFontColor = '#333';


        new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: gradient,
            data: yValues
            }]
        },

        options: {
       
            scales: {
          
                xAxes: [{
                    ticks: {
                        fontSize: 14,
                        fontFamily: 'Quicksand'
                    },
                        gridLines: {
                        drawOnChartArea: false
                    }
                        
                }],
                
      
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        fontSize: 14,
                        fontFamily: 'Quicksand',
                        stepSize: 1
                    }
                       
                }]
            
            },
            
           
            
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    bottom: 20,
                    top: 10,
                    left: 40,
                    right: 20
                }
            },
            legend: {display: false},
            title: {
            display: true,
            text: "No. of Appointment per Designated Hour",
            fontSize: 16,
            fontFamily: 'Quicksand',
            padding: 20
            }
        }
        });
    </script>


       <div class="appointment">

            <div class="current_appnt">
                <div class="pending_title">
                    <?php
                    date_default_timezone_set('Asia/Manila');                           		
                    $currentdate = date("F j, Y");
                    ?>
                    <h3>Today's Appointments (<?php echo $currentdate;?>)</h3>
                    <button>View all</button>
                </div>
                <table>
                    <tr>
                        <th>Student Name</th>
                        <th>Date Requested</th>
                        <th>Appointment Type</th>
                        <th>Note</th>
                    </tr>

                    <?php 
                        date_default_timezone_set('Asia/Manila');                           		
                        $currentdate = date("Y-m-d");

                        $listapp = "SELECT 
                            tbl_student_registry.first_name, 
                            tbl_student_registry.last_name, 
                            tbl_appointment.date_created, 
                            tbl_appointment.appointment_type, 
                            tbl_appointment.note
                        FROM tbl_appointment_detail 
                        INNER JOIN tbl_appointment ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                        WHERE tbl_appointment.staff_id ='$staff_id' 
                        AND tbl_appointment_detail.appointment_date = '$currentdate' 
                        AND tbl_appointment_detail.status = 'Accepted' 
                        LIMIT 5";

                        $listapp_query = mysqli_query($db, $listapp);
                        $count=mysqli_num_rows($listapp_query);
                        if($count>0) {

                        while($applist=mysqli_fetch_assoc($listapp_query)) { ?>
                            <tr>
                                <td>
                                    <?php  echo $applist['first_name']. " ".  $applist['last_name'];?>
                                </td>
                                <td>
                                    <?php  echo date('F j, Y', strtotime($applist['date_created'])); ?>
                                </td>
                                <td>
                                    <?php  echo $applist['appointment_type']; ?>
                                </td>
                                <td>
                                    <?php   echo $applist['note']; ?>
                                </td>
                            </tr> <?php

                        }
                        }
                        else {
                            ?>
                                <tr>
                                    <td colspan = "4">
                                        <?php echo "You have no appointments today.";?>
                                    </td>
                                </tr>
                            <?php
                        }                  
                    ?>


                </table>
            </div>

            <div class="limit_appnt"></div>
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
        background: #fff;
    }
    .card_row_div .col_3 a {
        text-decoration: none;
        color: #000;
        cursor: auto;
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
        font-family: 'Roboto';
        color: #333;
    }








    .limit_container {
        width: 100%;
        padding: 0 15px;
    }
    .limit_container .chart_panel {
        background: #fff;
        width: 100%;
        height: 48vh;
    }
   

   
    .appointment {
        width: 100%;
        display: flex;
        padding: 15px;
    }
    .appointment .current_appnt {
        width: 70%;
        background: #fff;
        padding: 30px;
        min-height: 55vh;
    }
    .current_appnt .pending_title {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .current_appnt table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }
    .current_appnt table th {
        padding: 20px 15px;
        background: #fff;
        border: none;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 500;
        text-align: left;
    }
    .current_appnt table td {
        padding: 20px 15px;
        font-size: 14px;
        color: #444;
        font-weight: 500;
    }
    .current_appnt table tr {
        background: #fff;
    }
    .current_appnt table tr:nth-child(even) {
        background-color: #f2f2f2
    }
    

        .pending_title h3 {
            font-size: 16px;
            color: #333;
        }
        .pending_title button {
            border: none;
            width: 120px;
            height: 26px;
            background: #FE4961;
            color: #eee;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 12px;
            border-radius: 15px;
            font-weight: 500;
        }

    .appointment .limit_appnt {
        width: 30%;
        height: 50vh;
        background: #fff;
        margin-left: 15px;
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
 


