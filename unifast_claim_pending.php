<?php
    include("new_header_admin.php");
?>
    <main>
    <?php include("unifast_count_app.php"); ?>
            <?php 
        if($position=="Accounting Staff/Scholarship Coordinator") {//if Accounting Staff/Scholarship Coordinator
            ?>  
            <h2>UniFAST - Claim Cheque Appointment Requests</h2>
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
            <div class="pending_container_top">

                <div class="pending_column_batch">
                    <button type="submit" onclick='selectAll()' value="Select All">Select All</button>
                    <button type="submit" onclick='UnSelectAll()' value="Unselect All">Unselect All</button>
                    <button type="submit" onclick='select10()' value="Select 2">Select 10</button>

                    <form action="#" method="POST" onclick="e.preventDefault()" >
                        <select name="batchstate" id="batchstate"  onchange="this.form.submit();">
                            <option value="">Select Batch Status</option>
                            <option value="('new' OR 'old')">ALL</option>
                            <option value="'old'">OLD</option>
                            <option value="'new'">NEW</option>
                        </select>
                    </form>
                </div>

                    
                <div class="pending_column_all" id="buttonsforall">

                    <?php 
                        if(isset($_POST['batchstate'])) {
                            $bs = $_POST['batchstate'];
                            date_default_timezone_set('Asia/Manila');                           		
                            $currentdate = date("Y-m-d");
                            ?>

                            <div class="pending_row_header">

                                <form action="appointment/claim_multipleacceptordecline.php" method="post"><!----------------------------Start of FORM------------------------------------------------------------------>    
                                <!-------------------------BUTTONS FOR ALL------------------------->
                                    <div class="input_group">
                                        <p>Enter Date of Appointment</p>
                                        <input type="date" name="ad[]" value=""
                                                min="<?php echo $currentdate;?>" max="<?php echo date('Y-m-d', 
                                                strtotime($currentdate. ' + 90 days'));?>">
                                    </div>

                                    <div class="input_group">
                                        <p>Comment</p>
                                        <textarea class="form-control" name="com[]">
                                        </textarea>
                                    </div>

                                    <div class="input_group">
                                        <button  type="submit" name="accept">ACCEPT</button>
                                        <button type="submit" name="decline">DECLINE</button>
                                    </div>
                                    <!----------------------------BUTTONS FOR ALL-----------------------> 

                            </div>                       
                </div>

                <div class="pending_column">

                                <?php
                                    $staff_id = $_SESSION["staff_id"];
                                    date_default_timezone_set('Asia/Manila');                           		
                                    $currentdate = date("Y-m-d");

                                    $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                                        tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                                        tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                                        tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_unifast_grantee.batch_status
                                        FROM tbl_appointment INNER JOIN tbl_staff_registry 
                                        ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                        LEFT OUTER JOIN tbl_unifast_grantee ON tbl_student_registry.student_id = tbl_unifast_grantee.student_id 
                                        WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                                        WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                                        AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type='UniFAST - Claim Cheque' 
                                        AND tbl_unifast_grantee.batch_status = $bs
                                        ORDER BY date_created ASC";

                                    $request_result = mysqli_query($db, $requests);

                                    if($request_result==TRUE) {
                                        $count = mysqli_num_rows($request_result);

                                        if($count>0) {
                                            $t = 1;?>
                                            <div class="label_for_appnt">

                                                <div class="pending_label">
                                                    <h4>S.N.</h4>
                                                </div>

                                                <div class="pending_label">
                                                    <p>Check</p>
                                                </div>

                                                <div class="pending_label">
                                                    <h4>Date Requested</h4>
                                                </div>

                                                <div class="pending_label">
                                                    <h4>Student</h4>
                                                </div>

                                                <div class="pending_label">
                                                    <h4>Batch Status</h4>
                                                </div>

                                                <div class="pending_label">
                                                    <h4>Appointment Type</h4>
                                                </div>

                                                <div class="pending_label">
                                                    <h4>Student's Note</h4>
                                                </div>
                                            </div>

                                                <?php
                                            while($rows=mysqli_fetch_assoc($request_result)) {
                                                ?>
                                                <div class="label_for_appnt">
                                            
                                                    <div class="pending_label">
                                                        <?php echo $t++; //Adds Row Counter ?>
                                                    </div>

                                                    <div class="pending_label">
                                                        <input type="checkbox" name="pending[]" value="<?php echo $rows['appointment_id'];?>">
                                                        <input type="hidden" name="appointment_id[]" value="<?php echo $rows['appointment_id'];?>">    
                                                    </div>

                                                    <div class="pending_label">
                                                        <?php echo $rows['date_created']; ?>
                                                    </div>

                                                    <div class="pending_label">
                                                        <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                                        <p>
                                                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                                                        </p>
                                                    </div>

                                                    <div class="pending_label">
                                                        <?php echo $rows['batch_status']; ?>
                                                    </div>
                                                    
                                                    <div class="pending_label">
                                                        <?php echo $rows['appointment_type']; ?>
                                                    </div>

                                                    <div class="pending_label">
                                                        <?php
                                                            if($rows['note']==""){
                                                                echo "No note.";
                                                            }
                                                            else{
                                                                echo $rows['note'];
                                                            }
                                                        ?>
                                                    </div>

                                                </div>
                                                <?php
                                            }
                                        }
                                        else {
                                            echo "No pending appointments.";
                                        }
                                    }
                                    else {
                                        echo "There is no data in the database." . mysqli_error($db);
                                    }
                                        ?>
                            </form> <!----------------------------End of FORM-------------------------------------------------------------------------------------------->  
                            <?php   
                        }//end of batch status
                        else {
                            date_default_timezone_set('Asia/Manila');                           		
                            $currentdate = date("Y-m-d");//start of show all status
                        ?>

                            <div class="pending_row_header">
                                <form action="appointment/claim_multipleacceptordecline.php" method="post"><!----------------------------Start of FORM------------------------------------------------------------------>    
                                    <!-------------------------BUTTONS FOR ALL------------------------->
                                    <div class="input_group">
                                        <p>Enter Date of Appointment</p>
                                        <input type="date" name="ad[]" value=""
                                                min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                                strtotime($currentdate. ' + 90 days'));?>">
                                    </div>

                                    <div class="input_group">
                                        <p>Comment</p>
                                        <textarea class="form-control" name="com[]" placeholder="Comment here..."></textarea>
                                    </div>
                                    
                                    <div class="input_group">
                                        <button  type="submit" name="accept">ACCEPT</button>
                                        <button type="submit" name="decline">DECLINE</button>
                                    </div>
                                    <!----------------------------BUTTONS FOR ALL----------------------->
                            </div>        
                </div>

                <div class="pending_column">

                            <?php
                                $staff_id = $_SESSION["staff_id"];
                                date_default_timezone_set('Asia/Manila');                           		
                                $currentdate = date("Y-m-d");

                                $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                                    tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                                    tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                                    tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_unifast_grantee.batch_status
                                    FROM tbl_appointment INNER JOIN tbl_staff_registry 
                                    ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                    LEFT OUTER JOIN tbl_unifast_grantee ON tbl_student_registry.student_id = tbl_unifast_grantee.student_id 
                                    WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                                    WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                                    AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type='UniFAST - Claim Cheque' 
                                    ORDER BY date_created ASC";

                                $request_result = mysqli_query($db, $requests);

                                if($request_result==TRUE) {
                                    $count = mysqli_num_rows($request_result);
                                    if($count>0) {
                                        $t = 1;?>

                                        <div class="label_for_appnt">
                                            <div class="pending_label">
                                                <h4>S.N.</h4>
                                            </div>

                                            <div class="pending_label">
                                                <p>Check</p>
                                            </div>

                                            <div class="pending_label">
                                                <h4>Date Requested</h4>
                                            </div>

                                            <div class="pending_label">
                                                <h4>Student</h4>
                                            </div>

                                            <div class="pending_label">
                                                <h4>Batch Status</h4>
                                            </div>

                                            <div class="pending_label">
                                                <h4>Appointment Type</h4>
                                            </div>

                                            <div class="pending_label">
                                                <h4>Student's Note</h4>
                                            </div>
                                        </div>
                                            <?php
                                        while($rows=mysqli_fetch_assoc($request_result)) {?>

                                            <div class="label_for_appnt_row">
                                                
                                                <div class="pending_label">
                                                    <?php echo $t++; //Adds Row Counter ?>
                                                </div>  

                                                <div class="pending_label">
                                                    <input type="checkbox" name="pending[]" value="<?php echo $rows['appointment_id'];?>">
                                                    <input type="hidden" name="appointment_id[]" value="<?php echo $rows['appointment_id'];?>">
                                                    
                                                </div>

                                                <div class="pending_label">
                                                    <?php echo $rows['date_created']; ?>
                                                </div>

                                                <div class="pending_label">
                                                    <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                                    <p>
                                                        <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                                                        
                                                    </p>
                                                </div>

                                                <div class="pending_label">
                                                        <?php echo $rows['batch_status']; ?>
                                                </div>
                                                
                                                <div class="pending_label">
                                                        <?php echo $rows['appointment_type']; ?>
                                                </div>

                                                <div class="pending_label">
                                                        <?php
                                                            if($rows['note']==""){
                                                                echo "No note.";
                                                            }
                                                            else{
                                                            echo $rows['note'];
                                                            }
                                                        ?>
                                                </div>

                                            </div>
                                        <?php
                                        }
                                    }
                                    else {
                                        echo "No pending appointments.";
                                    }
                                }
                                else {
                                    echo "There is no data in the database." . mysqli_error($db);
                                }
                                    ?>
                        </form> <!----------------------------End of FORM--------------------------------------------------------------------------------------------> 

                    <?php
                    }//end of show all status
                    
                    ?>
                                    
                </div>
                
            </div> 
            <?php
        } //if Accounting Staff/Scholarship Coordinator
        else{ //if not Accounting Staff/Scholarship Coordinator
            echo "Test: You are not an Accounting Staff/Scholarship Coordinator";
        }//if not Accounting Staff/Scholarship Coordinator
    
        include("backtotop.php");
    
            ?>
       
    </main>

    </div>
</div>

<div class="mobile_header"></div>

</body>
</html>




<script>
    //-----------------START OF BUTTONS FOR ALL--------------------------------//     
    function selectAll(){
        var items=document.getElementsByName('pending[]');
        for(var i=0; i<items.length; i++){
            if(items[i].type=='checkbox')
                items[i].checked=true;
        }
    }

    function UnSelectAll(){
        var items=document.getElementsByName('pending[]');
        for(var i=0; i<items.length; i++){
            if(items[i].type=='checkbox')
                items[i].checked=false;
        }
    }

    function select10(){
        var items=document.getElementsByName('pending[]');

        for(var i=0; i<items.length; i++){
            if(items[i].type=='checkbox')
                items[i].checked=false;
        }
        for(var i=0; i<10; i++){
            
            if(items[i].type=='checkbox')
            
                items[i].checked=true;
        }
    }
    //----------------END OF BUTTONS FOR ALL-----------------------------------------------//   


             
</script>

<style>
    main {
       width: 100%;
       padding: 15px;
       min-height: 100vh;
       margin-top: 60px;
    }
    main h2 {
        margin-left: 15px;
        font-size: 20px;
        font-family: 'Roboto';
        margin-bottom: 15px;
    }
    .pending_container_top {
        background: #fff;
    }
    .pending_container_top .pending_column_batch {
        background: #fff;
        padding: 15px;
        display: flex;
    }
    .pending_container_top .pending_column_batch button {
        width: 120px;
        height: 30px;
        border: 1px solid #444;
        cursor: pointer;
        margin-right: 20px;
        background: none;
        font-family: 'Roboto';
    }
    .pending_container_top .pending_column_batch select {
        height: 30px;
        font-family: 'Roboto';
    }
    .pending_column_all {
        background: #fff;
        padding: 15px;
    }
   .pending_row_header {
       margin-top: 40px;
       padding: 5px;
   }
   .pending_row_header form {
       display: flex;
       align-items: center;
   }
   .pending_row_header form .input_group {
       display: flex;
       align-items: center;
       margin-right: 20px;
   }
   .pending_row_header form .input_group p {
       color: #333;
       font-size: 13px;
       text-transform: uppercase;
       margin-right: 8px;
       font-family: 'Roboto';
       font-weight: 400;
   }
   .pending_row_header form .input_group input {
       width: 120px;
       height: 30px;
       padding-left: 5px;
       font-family: 'Roboto Serif';
   }
   .pending_row_header form .input_group textarea {
       width: 280px;
       height: 30px;
       padding-left: 5px;
       padding-top: 5px;
       font-family: 'Roboto Serif';
   }
   .pending_row_header form .input_group:last-child {
       flex: 1;
       justify-content: right;
   }
   .pending_row_header form .input_group:last-child button {
       width: 120px;
       height: 30px;
       border: none;
       font-family: 'Roboto';
       cursor: pointer;
   }
   .pending_row_header form .input_group:last-child button:first-child {
       margin-right: 20px;
       background: #324e9e;
       color: #eee;
       
   }
   .pending_row_header form .input_group:last-child button:nth-child(2) {
       background: #ec3237;
       color: #eee;
   }
   .label_for_appnt {
       display: flex;
       align-items: center;
       padding: 10px 20px;
       background: #324E9E;
       margin-top: 40px;
   }
   .label_for_appnt_row {
       display: flex;
       align-items: center;
       padding: 10px 20px;
   }
   .label_for_appnt .pending_label,
   .label_for_appnt_row .pending_label {
       width: 300px;
   }
   .label_for_appnt .pending_label {
       color: #eee;
       font-family: 'Roboto';
       font-size: 13px;
       text-transform: uppercase;
       font-weight: 400;
       padding: 10px 0;
   }
   .label_for_appnt .pending_label h4 {
       font-weight: 400;
   }
   .label_for_appnt_row .pending_label {
       font-family: 'Roboto';
       font-size: 13px;
   }
   input[type=checkbox] {
       width: 15px;
       height: 15px;

   }
  
   .label_for_appnt .pending_label:nth-child(1),
   .label_for_appnt_row .pending_label:nth-child(1),
   .label_for_appnt .pending_label:nth-child(2),
   .label_for_appnt_row .pending_label:nth-child(2) {
       width: 100px;
   }


   .label_for_appnt_row:nth-child(odd) {
        background: lightgrey;
   }

  
      #claimpendingrequests {
          background: #324e9e;
      }
      #claimpendingrequests .card_title,
      #claimpendingrequests .card_body {
          color: #fff;
      }
  

</style>

