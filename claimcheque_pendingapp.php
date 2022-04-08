<?php
    include("admin_header.php");
?>
    <main>
        <?php 
            if($position=="Accounting Staff/Scholarship Coordinator") {//if Accounting Staff/Scholarship Coordinator
        ?>  
            <h2>UniFAST - Claim Cheque Appointment Requests</h2>
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

                        ?>
                            <form action="appointment/claim_multipleacceptordecline.php" method="post"><!----------------------------Start of FORM------------------------------------------------------------------>    
                            <!-------------------------BUTTONS FOR ALL------------------------->
                                <label>Enter Date of Appointment:</label>
                                <input type="date" name="ad[]" required placeholder="" value=" "
                                        min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', 
                                        strtotime($currentdate. ' + 20 days'));?>">
                                <label>Comment:</label>
                                    <textarea name="com[]" required placeholder="For UniFAST transactions, please bring your school ID, blue ballpen, and 5 photocopies of your school ID.">
                                    "For UniFAST transactions, please bring your school ID, blue ballpen, and 5 photocopies of your school ID."
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
                                        AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type='UniFAST - Claim Cheque' 
                                        AND tbl_unifast_grantee.batch_status = $bs
                                        ORDER BY date_created ASC";

                                    $request_result = mysqli_query($db, $requests);

                                    if($request_result==TRUE) {
                                        $count = mysqli_num_rows($request_result);
                                        if($count>0) {
                                            $t = 1;
                                ?>
                                    
                                        <?php
                                            while($rows=mysqli_fetch_assoc($request_result)) {
                                        ?>
                                        <div class="pending-row">
                                            
                                            <input type="checkbox" name="pending[]" value="<?php echo $rows['appointment_id'];?>">
                                            <input type="hidden" name="appointment_id[]" value="<?php echo $rows['appointment_id'];?>">
                                            <p><span><?php echo $t++; //Adds Row Counter ?></p>
                                            <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                                            <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p> 
                                            <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                                            <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                                            <p><span>Student's Note: </span><?php echo $rows['note']; ?></p> 
                                            <p><span>Batch Status: </span><?php echo $rows['batch_status']; ?></p>

                                        </div><hr>
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
                         else {//start of show all status
                        ?>


                        <form action="appointment/claim_multipleacceptordecline.php" method="post"><!----------------------------Start of FORM------------------------------------------------------------------>    
                        <!-------------------------BUTTONS FOR ALL------------------------->
                            <label>Enter Date of Appointment:</label>
                            <input type="date" name="ad[]" required placeholder="" value=" "
                                    min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', 
                                    strtotime($currentdate. ' + 20 days'));?>">
                            <label>Comment:</label>
                                <textarea name="com[]" required placeholder="For UniFAST transactions, please bring your school ID, blue ballpen, and 5 photocopies of your school ID.">
                                "For UniFAST transactions, please bring your school ID, blue ballpen, and 5 photocopies of your school ID."
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
                                    AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type='UniFAST - Claim Cheque' 
                                    ORDER BY date_created ASC";

                                $request_result = mysqli_query($db, $requests);

                                if($request_result==TRUE) {
                                    $count = mysqli_num_rows($request_result);
                                    if($count>0) {
                                        $t = 1;
                            ?>
                                
                                    <?php
                                        while($rows=mysqli_fetch_assoc($request_result)) {
                                    ?>
                                    <div class="pending-row">
                                        
                                        <input type="checkbox" name="pending[]" value="<?php echo $rows['appointment_id'];?>">
                                        <input type="hidden" name="appointment_id[]" value="<?php echo $rows['appointment_id'];?>">
                                        <p><span><?php echo $t++; //Adds Row Counter ?></p>
                                        <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                                        <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p> 
                                        <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                                        <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                                        <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                                        <p><span>Student's Note: </span><?php echo $rows['note']; ?></p> 
                                        <p><span>Batch Status: </span><?php echo $rows['batch_status']; ?></p> 

                                    </div><hr>
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


   
</style>

