
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
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

</script>

    <div>
        <form name="form1" method="get" action=" ">
        <div class="search-box"><label><h1>Set An Appointment</h1></label></div>
        <div class="search-box">
            <input type="text" autocomplete="off" placeholder="Search staff name..." name="search" value="" required>
            <div class="result"></div>
        </div>
        <div class="search-box">
            <input type="submit" value="Find" name="submit">
    </div>
    </div>
    </form>

<?php

 if(isset($_GET['submit'])){
    ?>
    <h2>Appointments Under <?php echo  $_GET['search']; ?></h2>
    <h4>Select An Appointment Type:</h4>
    <?php
    $button = $_GET['submit'];
    $name = explode(" ", $_GET['search']);
    $search = $name[0];
    $search2 = end($name);

    $sql="SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name, tbl_staff_registry.staff_id, 
    tbl_staff_appointment.appointment_type 
    FROM tbl_staff_registry INNER JOIN tbl_staff_appointment 
    ON tbl_staff_registry.staff_id = tbl_staff_appointment.staff_id 
    WHERE tbl_staff_registry.last_name = '$search2' AND tbl_staff_registry.first_name LIKE '".$search."%'";
    $run= mysqli_query($db, $sql);
    
    if($run==TRUE) {
        $foundnum = mysqli_num_rows($run);
        if($foundnum > 0) { 
    ?>
                <form method="post">
    <?php
            while($rows = mysqli_fetch_assoc($run)) { 
                
    ?>  
                <button type="submit" class="aptype" name="at" required value="<?php echo $rows['appointment_type'];?>">
                    <?php echo $rows['appointment_type'];?><hr>
                    <?php
                        $atype=$rows['appointment_type'];
                        if($atype=="Meeting"){?>
                            <p>Description: Please select this appointment type if the appointment type you're looking for is not in the list. 
                            Indicate your purpose in the note. Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="Enrollment"){?>
                            <p>Description: Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                        <?php
                        }
                        if($atype=="Evaluation of Grades - Department Head"){?>
                            <p>Description: Please choose the correct Department Head for your department. 
                            Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="Module Submission"){?>
                            <p>Description: Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                        <?php
                        }
                        if($atype=="Pre-Enrollment"){?>
                            <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm. 
                            Please bring a pen and necessary documents.</p>
                        <?php
                        }
                        if($atype=="Presentation"){?>
                            <p>Description: Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="Project Submission"){?>
                            <p>Description: Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="Request Documents From Registrar"){?>
                            <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm. Please bring a pen.</p> 
                        <?php
                        }
                        if($atype=="Request for Grades"){?>
                           <p>Description: Requested From Registrar. Office hours are from 8 am to 5 pm.</p>
                        <?php
                        }
                        if($atype=="UniFAST - Claim Cheque"){?>
                            <p>Description: Requested From Accounting Staff/Scholarship Coordinator. 
                            Office hours are from 8 am to 5 pm. Please bring a pen and your ID. </p>
                        <?php
                        }
                        if($atype=="UniFAST - Submit Documents"){?>
                            <p>Description: Requested From Accounting Staff/Scholarship Coordinator.
                             Office hours are from 8 am to 5 pm. Please bring a pen and necessary documents.</p>
                        <?php
                        }
                    ?>
                    
                </button>
                <input type="hidden" name="fn" value="<?php echo $rows['first_name'];?>"> 
                <input type="hidden" name="ln" value="<?php echo $rows['last_name'];?>"> 
                <input type="hidden" name="staff_id" value="<?php echo $rows['staff_id'];?>"> 
                
    <?php     
            }
            ?>
            </form>
            <?php
        }
        else {
            echo "<script>window.location.href='student_appointment.php'</script>";
        }
    }
  
 }
 if(isset($_POST['at'])){
    $appointment_type =$_POST['at'];
    $staff_id =$_POST['staff_id'];
    $first_name =$_POST['fn'];
    $last_name =$_POST['ln'];
    
    $sql = "SELECT student_id FROM tbl_unifast_grantee WHERE student_id ='$student_id'";
    $result = mysqli_query($db, $sql);
                    
    if (mysqli_num_rows($result) > 0) {
        while($id = mysqli_fetch_assoc($result)){
        $ug_id= $id['student_id'];

            if($student_id==$ug_id){//if student is unifast grantee
                 ?>
<!---------------TURN TO MODAL ON CLICK OF APPOINTMENT BUTTON------------------------------------------>
                <h2>Appointment Type: <?php echo $appointment_type;?></h2>
                <h2>Staff: <?php echo $first_name . " ". $last_name;?></h2>          
                <form action="appointment/student_insert_appointment.php" method="post"> 
                    <h4>Note to Staff (Optional):</h4>
                    <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                    Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                    <textarea name="note"></textarea>
                    <input type="hidden" name="appointmenttype" value="<?php echo $appointment_type;?>"> 
                    <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>"> 
                    <br><br>
                    <input type="submit" name="request" value="Request Appointment">
                   
                </form><br><br>
<!---------------TURN TO MODAL ON CLICK OF APPOINTMENT BUTTON------------------------------------------>     
                 <?php 
            }
        }
    }
    else{//if student is NOT a unifast grantees
        if($appointment_type=="UniFAST - Claim Cheque" OR $appointment_type=="UniFAST - Submit Documents"){
            //if appointment type is unifast app
            echo "You cannot make this appointment as you are not a UniFAST Grantee.";
        }
        else {
            //if appointment type is unifast app
            ?>
<!---------------TURN TO MODAL ON CLICK OF APPOINTMENT BUTTON------------------------------------------>             
            <h2>Appointment Type: <?php echo $appointment_type;?></h2>
            <h2>Staff: <?php echo $first_name . " ". $last_name;?></h2>          
            <form action="appointment/student_insert_appointment.php" method="post">
                
                <h4>Note to Staff (Optional):</h4>
                <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                <textarea name="note"></textarea>
                <input type="hidden" name="appointmenttype" value="<?php echo $appointment_type;?>"> 
                <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>"> 
                <br><br>
                <input type="submit" name="request" value="Request Appointment">
            </form><br><br>
<!---------------TURN TO MODAL ON CLICK OF APPOINTMENT BUTTON------------------------------------------>            
<?php   
        }     
    }    
}
?>

<style>
    
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
       
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        top: 100%;
        left: 0;
        background-color: white;
        
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>