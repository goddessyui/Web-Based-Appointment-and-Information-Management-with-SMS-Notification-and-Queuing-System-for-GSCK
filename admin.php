<?php 
    include("admin_header.php");
?>


    <main>
            
        <!---------------Reports for Registrar------------------------------------------------->
        <?php
        if ($position == "Registrar") {//Start of show if Registrar
            include("count_gsck.php");
        }//End of show if Registrar
        ?>
        <!---------------Reports for Registrar------------------------------------------------->


            <div class="limit_div">
                <div class="limit_container">
                <!---------------Limit Appointments and Show List of Students and Staff, only seen by Registrar------------------------------------------------->
                <?php 
                if ($position == "Registrar") {?>

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
                        <div>No Scheduled Appointments Today</div>
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
            <div class="list_div">

                <div class="reg_print_div">

                <h4>List of Registered Staff</h4>
 
                    <div class="row">
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

                            <input id="ajaxSubmit_gen_report_regstaff" type="submit" value="Show List of Registered Staff"/>
                            <button onclick="printDiv_regstaff()">PRINT</button>
                        </form>
                    </div>
                    <!--<div class="row" id="generated_rep_registeredstaff"></div>-->
                    <div class="row" id="generated_rep_registeredstaff_hidden"></div><!--- style="display: none;"-->
                    
                </div>
            

                <div class="reg_print_div">

                    <h4>List of Registered Students</h4>

                    <div class="row">
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
                            <input id="ajaxSubmit_gen_report_regstudent" type="submit" value="Show List of Registered Students"/>
                            <button onclick="printDiv_regstudent()">PRINT</button>
                        </form>
            
                    </div>
                    <!--<div class="row" id="generated_rep_registeredstudents"></div>-->
                    <div class="row" id="generated_rep_registeredstudents_hidden"></div><!--- style="display: none;"-->

                </div>
            </div>

            <?php
        }
            ?><!---------------Limit Appointments and Show List of Students and Staff, only seen by Registrar------------------------------------------------->
        
        
        






































        
        <!--------------------- Appointment Limit and Show List of Students and Staff, only seen by Accounting Staff------------------------------------------>
        <?php
        if($position=="Accounting Staff/Scholarship Coordinator" OR $position=="Teacher") { 
        ?>
            <div class="row">

                <div class="col_3">
                    <div class="card">
                        <div class="card_title">Allowed No. of Appointments Today:</div>
                        <div class="card_body">
                            <div class="card_text">
                            <?php
                            
                                $applimit = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
                                $al = mysqli_query($db, $applimit);
                                
                                $limit= mysqli_fetch_assoc($al);
                                    echo $limit['appointment_limit'];

                            ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col_3">
                    <div class="card">
                        <div class="card_title">No. of Appointment Slots Taken Today:</div>
                        <div class="card_body">
                            <div class="card_text">
                            <?php
                                date_default_timezone_set('Asia/Manila');                           		
                                $currentdate = date("Y-m-d");
                                
                                $applimit = "SELECT appointment_detail_id FROM tbl_appointment_detail 
                                    WHERE `status` = ('Accepted' OR 'Cancelled') 
                                    AND appointment_date = '$currentdate'";
                                $al = mysqli_query($db, $applimit);
                                $count = mysqli_num_rows($al);

                                echo $count; 
                            ?>
                            </div>
                        </div>
                    </div>                
                </div>  

            </div>
        <?php
        }
        ?>
        
        <?php
        if($position=="Accounting Staff/Scholarship Coordinator") { 
        ?>    
            <div class="row">
        
                <div class="col-sm-6">
                    <div class="row">
                        <h4>List of Unifast Grantees</h4>
                    </div>
                    <div class="row">
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
                            <input id="ajaxSubmit_gen_report_ug" type="submit" value="Show List of UniFAST Grantees"/>
                            <button onclick="printDiv_regug()">PRINT</button>
                        </form>
                        
                    </div>
                    <!---<div class="row" id="generated_rep_ug"></div>--->
                    <div class="row" id="generated_rep_ug_hidden" ></div> <!--- style="display: none;"-->
                
                </div> 

            </div>
        
        <?php
        }
        ?> <!--------------------- Appointment Limit and Show List of Students and Staff, only seen by Accounting Staff------------------------------------------>

   
    </div>
  </main>

</body>
</html>


<style>
    .limit_div {
        display: flex;
        width: 100%;
        background: #EFF0F4;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
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
        border: 1px solid #3871CF;
    }
    .limit_div .limit_container:nth-child(3) {
        border: 1px solid #DC3912;
    }
    .limit_div .limit_container:nth-child(1) form {
        height: 100%;
    }

    form .top_flex:nth-child(1) {
        height: 40%;
    }

          .top_flex:nth-child(1) h4:nth-child(1) {
              color: #333;
              font-family: 'Roboto';
              font-size: 13px;
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
        height: 50%;
    }
    form .top_flex:nth-child(2) h4 {
       margin-top: 15px;
       font-family: 'Roboto Serif';
       margin-bottom: 8px;
       color: #333;
    }
         .top_flex:nth-child(2) .form_group {
             height: 40px;
         }
                                .form_group input {
                                    height: 32px;
                                }
                                .form_group input[type=number] {
                                    margin-bottom: 15px;
                                    width: 100%;
                                    padding: 0 8px;
                                    border: 1px solid lightgrey;
                                }
                                .form_group input[type=submit] {
                                    width: 100%;
                                    border: none;
                                    background: #4285F4;
                                    color: #fff;
                                    font-size: 13px;
                                    cursor: pointer;
                                }
.error_message {
    background: orange;
}
.error_message p {
    padding: 2px 20px;
    font-family: 'Roboto';
    font-size: 13px;
    color: #000;
}
.card_title,
.card_body {
    cursor: auto;
}
</style>












<script>
       $(document).ready(function() {
        $('#ajaxSubmit_gen_report_regstudent').click(function(){
            
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
            });
            
            return false;
                    
                });

        });

        $(document).ready(function() {
        $('#ajaxSubmit_gen_report_regstaff').click(function(){
            
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
            });
            
            return false;
                    
                });

        });

        $(document).ready(function() {
        $('#ajaxSubmit_gen_report_ug').click(function(){
      
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
    
    </script>
 


