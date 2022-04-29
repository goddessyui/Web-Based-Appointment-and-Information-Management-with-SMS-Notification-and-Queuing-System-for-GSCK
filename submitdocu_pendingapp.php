<?php
    include("admin_header.php");
?>
    <main>
        <?php 
            if($position=="Accounting Staff/Scholarship Coordinator") {//if Accounting Staff/Scholarship Coordinator
        ?>  
            <h2>UniFAST - Submit Documents Appointment Requests</h2>
                                    <!--success or error-->
                                    <?php 
                            if(isset($_GET['success'])){
                        ?>
                                <p align="center">
                                    <?php 
                                        echo $_GET['success'];
                                    ?>
                                </p>
                        <?php
                            }
                            if(isset($_GET['error'])){
                        ?>
                                        <p align="center">
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

            <div class="pending-container">

                    <div class="pending-column">
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
                    
                    <div class="pending-column" id="buttonsforall">

                    
                    <?php 
                        if(isset($_POST['batchstate'])) {
                            $bs = $_POST['batchstate'];
                            date_default_timezone_set('Asia/Manila');                           		
                                    $currentdate = date("Y-m-d");
                    ?>
                            <form action="appointment/submit_multipleacceptordecline.php" method="post"><!----------------------------Start of FORM------------------------------------------------------------------>    
                                <!-------------------------BUTTONS FOR ALL------------------------->
                                <label>Enter Date of Appointment:</label>
                                <input type="date" name="ad[]" value=" "
                                        min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                        strtotime($currentdate. ' + 60 days'));?>">
                                <label>Comment:</label>
                                    <textarea class="form-control" name="com[]" placeholder="For UniFAST transactions, please bring your school ID, blue ballpen, and 5 photocopies of your school ID.">For UniFAST transactions, please bring your school ID, blue ballpen, and 5 photocopies of your school ID.
                                </textarea>
                                <button  type="submit" name="accept">ACCEPT</button>
                                <button type="submit" name="decline">DECLINE</button>
                                <!----------------------------BUTTONS FOR ALL----------------------->   
                                

                    </div>                
                    <div class="pending-column">

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
                                        AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type='UniFAST - Submit Documents' 
                                        AND tbl_unifast_grantee.batch_status = $bs
                                        ORDER BY date_created ASC";

                                    $request_result = mysqli_query($db, $requests);

                                    if($request_result==TRUE) {
                                        $count = mysqli_num_rows($request_result);
                                        if($count>0) {
                                            $t = 1;?>
                                            <div class="pending-row">
                                                <div class="sdpending_count">
                                                    <h4>S.N.</h4>
                                                </div>
                                                <div class="sdpending_checkbox">
                                                    
                                                </div>

                                                <div class="ccpending_date">
                                                    <h4>Date Requested</h4>
                                                </div>

                                                <div class="sdpending_col">
                                                    <h4>Student</h4>
                                                </div>

                                                <div class="sdpending_bs">
                                                    <h4>Batch Status</h4>
                                                </div>

                                                <div class="sdpending_col">
                                                    <h4>Appointment Type</h4>
                                                </div>

                                                <div class="sdpending_col">
                                                    <h4>Student's Note</h4>
                                                </div>
                                            </div><hr>
                                        <?php
                                            while($rows=mysqli_fetch_assoc($request_result)) {
                                        ?>
                                        <div class="pending-row">
                                            
                                            <div class="sdpending_count">
                                            <?php echo $t++; //Adds Row Counter ?>
                                            </div>   
                                            <div class="sdpending_checkbox">
                                                <input type="checkbox" name="pending[]" value="<?php echo $rows['appointment_id'];?>">
                                                <input type="hidden" name="appointment_id[]" value="<?php echo $rows['appointment_id'];?>">
                                                
                                            </div>

                                            <div class="ccpending_date">
                                                <?php echo $rows['date_created']; ?>
                                            </div>

                                            <div class="sdpending_col">
                                                <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                                <small>
                                                    <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                                                </small>
                                            </div>

                                            <div class="sdpending_bs">
                                                <?php echo $rows['batch_status']; ?>
                                            </div>
                                            
                                            <div class="sdpending_col">
                                                <?php echo $rows['appointment_type']; ?>
                                            </div>

                                            <div class="sdpending_col">
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
                        

                        <form action="appointment/submit_multipleacceptordecline.php" method="post"><!----------------------------Start of FORM------------------------------------------------------------------>    
                        <!-------------------------BUTTONS FOR ALL------------------------->
                            <label>Enter Date of Appointment:</label>
                            <input type="date" name="ad[]" value=" "
                                    min="<?php echo $currentdate; ?>" max="<?php echo date('Y-m-d', 
                                    strtotime($currentdate. ' + 90 days'));?>">
                            <label>Comment:</label>
                                <textarea class="form-control" name="com[]" placeholder="For UniFAST transactions, please bring your school ID, blue ballpen, and 5 photocopies of your school ID.">For UniFAST transactions, please bring your school ID, blue ballpen, and 5 photocopies of your school ID.
                            </textarea>
                            <button  type="submit" name="accept">ACCEPT</button>
                            <button type="submit" name="decline">DECLINE</button>
                            <!----------------------------BUTTONS FOR ALL----------------------->        
                </div>                
                <div class="pending-column">

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
                                    AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type='UniFAST - Submit Documents' 
                                    ORDER BY date_created ASC";

                                $request_result = mysqli_query($db, $requests);

                                if($request_result==TRUE) {
                                    $count = mysqli_num_rows($request_result);
                                    if($count>0) {
                                        $t = 1;?>
                                        <div class="pending-row">
                                                <div class="sdpending_count">
                                                    <h4>S.N.</h4>
                                                </div>
                                                <div class="sdpending_checkbox">
                                                    
                                                </div>

                                                <div class="ccpending_date">
                                                    <h4>Date Requested</h4>
                                                </div>

                                                <div class="sdpending_col">
                                                    <h4>Student</h4>
                                                </div>

                                                <div class="sdpending_bs">
                                                    <h4>Batch Status</h4>
                                                </div>

                                                <div class="sdpending_col">
                                                    <h4>Appointment Type</h4>
                                                </div>

                                                <div class="sdpending_col">
                                                    <h4>Student's Note</h4>
                                                </div>
                                            </div><hr>
                                
                                    <?php
                                        while($rows=mysqli_fetch_assoc($request_result)) {
                                    ?>
                                    <div class="pending-row">
                                        
                                        <div class="sdpending_count">
                                            <?php echo $t++; //Adds Row Counter ?>
                                        </div>   
                                        <div class="sdpending_checkbox">
                                            <input type="checkbox" name="pending[]" value="<?php echo $rows['appointment_id'];?>">
                                            <input type="hidden" name="appointment_id[]" value="<?php echo $rows['appointment_id'];?>">
                                            
                                        </div>

                                        <div class="ccpending_date">
                                            <?php echo $rows['date_created']; ?>
                                        </div>

                                        <div class="sdpending_col">
                                            <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                            <small>
                                                <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                                            </small>
                                        </div>

                                        <div class="sdpending_bs">
                                            <?php echo $rows['batch_status']; ?>
                                        </div>
                                        
                                        <div class="sdpending_col">
                                            <?php echo $rows['appointment_type']; ?>
                                        </div>

                                        <div class="sdpending_col">
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
</body>
</html>




<script>
    //--------------START OF BUTTONS FOR ALL------------------------------------------//       
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
    //--------------END OF BUTTONS FOR ALL-----------------------------------------------// 

      
            
</script>

<style>
    main {
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 100px;
    }
    .pending-container {
        width: 100%;
        background: lightgrey;
        padding:20px;
    }
    .pending-column {
        background: lightblue;  
        margin-bottom: 20px;
    }
    .pending-row{
        display: flex;
        flex-wrap: wrap;
    }

    .sdpending_col {
        width: 20%;
        padding: 5px;
        word-break: break-all;
        margin: auto;
    }
    .sdpending_checkbox {
        width: 5%;
        padding: 5px;
        text-align: center;
        margin: auto;
    }
    .sdpending_checkbox input[type=checkbox] {
        accent-color: gold;
        transform: scale(3);
    }
    .sdpending_count {
        width: 5%;
        text-align: center;
        padding: 5px;
        margin: auto;
    }
    .sdpending_bs, .ccpending_date {
        width: 15%;
        padding: 5px;
        margin: auto;
    }

</style>

