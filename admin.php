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




            <!---------------Limit Appointments and Show List of Students and Staff, only seen by Registrar------------------------------------------------->
                <?php 
            if ($position == "Registrar") {?>

                <div class="row">
                    <div class="col-6">

                        <form action="appointment_limit.php" method="post">
                            <h5>Limit the No. of Appointments Per Day:</h5>
                            <?php
                                $limit = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
                                $limitvalue= mysqli_query($db, $limit);
                                if($limitvalue==TRUE){
                                    while($al=mysqli_fetch_assoc($limitvalue)){
                            ?>
                                        <input type="text" name="limit_value" value="<?php echo $al['appointment_limit'];?>" 
                                        min="1" max="5000">
                                        <input type="submit" name="limit" value="Limit">
                            <?php
                                    }
                                }
                            ?>
                        </form>
                    
                    <div>

                    <div class="col-6">
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

                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="row">
                            <h4>List of Registered Staff</h4>
                        </div>
                        <div class="row">
                            <form method="post">
                                <span>Alphabetical (Last Name):</span>
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
                  

                    <div class="col-sm-6">
                        <div class="row">
                            <h4>List of Registered Students</h4>
                        </div>
                        <div class="row">
                        
                            <form method="post">
                                <span>Alphabetical (Last Name):</span>
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
                            <div class="card_title">Allowed No. of Appointment Slots Today:</div>
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

         
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.187416904765!2d124.83928635046632!3d6.4979414952765255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f8188deb24eeb5%3A0x2b58bb78e9ae72!2sGoldenstate%20College%20of%20Koronadal%20City!5e0!3m2!1sen!2sph!4v1651155144915!5m2!1sen!2sph" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
    </main>
</body>
</html>

<style>
    main {
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 100px;
    }

</style>

<script>
       $(document).ready(function() {
        $('#ajaxSubmit_gen_report_regstudent').click(function(){
      
            $.post("adminajax_regstudent.php", 
            {alphabetical_ln_student: $('#alphabetical_ln_student').val(),
            student_course_report: $('#student_course_report').val(),
            student_year_report: $('#student_year_report').val(),},
            function(data){
                $('#generated_rep_registeredstudents').html(data);
            });
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
      
            $.post("adminajax_regstaff.php", 
            {alphabetical_ln_staff: $('#alphabetical_ln_staff').val(),},
            function(data){
                $('#generated_rep_registeredstaff').html(data);
            });
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
      
            $.post("adminajax_ug.php", 
            {alphabetical_ln_ug: $('#alphabetical_ln_ug').val(),
            batchstatus_ug: $('#batchstatus_ug').val(),},
            function(data){
                $('#generated_rep_ug').html(data);
            });
            $.post("adminajax_ugprint.php", 
            {alphabetical_ln_ug: $('#alphabetical_ln_ug').val(),
            batchstatus_ug: $('#batchstatus_ug').val(),},
            function(data){
                $('#generated_rep_ug_hidden').html(data);
            });
            
            return false;
                    
                });

        });
   
        
    </script>
 


