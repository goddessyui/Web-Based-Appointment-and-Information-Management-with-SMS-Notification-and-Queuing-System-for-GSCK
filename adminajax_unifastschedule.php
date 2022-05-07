<?php

include("dbconfig.php");
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$appointment_date = $_POST['appointment_date'];
$appointment_type = $_POST['appointment_type'];
?>


<?php

$check = mysqli_query($db,"SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id
                    WHERE tbl_appointment_detail.appointment_date = '$appointment_date'
                    AND tbl_appointment.appointment_type = '$appointment_type'
                    AND tbl_appointment_detail.status = 'Accepted'");

if (mysqli_num_rows($check) != 0){

$fetch="SELECT tbl_appointment.appointment_id, 
                    tbl_appointment_detail.appointment_date, 
                    tbl_appointment_detail.date_accepted, 
                    tbl_appointment.staff_id, 
                    tbl_appointment.appointment_type,
                    tbl_appointment.note, 
                    tbl_appointment_detail.status, 
                    tbl_student_registry.first_name, 
                    tbl_student_registry.last_name
                    FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                    WHERE tbl_appointment_detail.status IN ('Accepted', 'Canceled')
                    AND tbl_appointment_detail.appointment_date = '$appointment_date'
                    ORDER BY tbl_appointment_detail.appointment_detail_id ASC";


$fetch_result = mysqli_query($db, $fetch);

//check whether the query is executed or not
if($fetch_result==TRUE) { // count rows to check whether we have data in database or not
    $count = mysqli_num_rows($fetch_result);
    //check the num of rows                 
    if($count>0) { //we have data in database
        $i = 1;
        ?>

            <div class="row_container">
            <div class="row_unifast">
                <div class="schedunifast_row">Appointment ID</div>
                <div class="schedunifast_row">Queue Number</div>
                <div class="schedunifast_row">Student Name</div>
                <div class="schedunifast_row">Appointment Type</div>
                <div class="schedunifast_row">Schedule Date</div>
            </div>
    
        <tbody>
        <?php
        while($rows=mysqli_fetch_assoc($fetch_result)) {
            if($rows['appointment_type']==$appointment_type){   
            if($rows['status']=='Accepted'){
?>

        <div class="row_unifast_list">
                    <div class="schedunifast_row">
                    <?php echo $rows['appointment_id']; ?>
                    </div>
                        
                    <div class="schedunifast_row">
                    <?php echo $i; ?> 
                    </div>

                    <div class="schedunifast_row">
                    <?php echo $rows['first_name'].' '.$rows['last_name']; ?> 
                    </div>
                    
                    <div class="schedunifast_row">
                    <?php echo $rows['appointment_type']; ?>
                    </div>

                    <div class="schedunifast_row">
                    <?php echo date("F d, Y", strtotime($rows['appointment_date'])); ?>
                    </div>

            </div>

        
        <?php }} ++$i; ?>
    
<?php 
        }
    } 
    else{
        echo "No result.";
    }
} 
?>
</div>
<?php
}
else{
        echo "No result.";
    }
?>
 

 <style>
    .row_container {
        margin-top: 40px;
        width: 100%;
    }
    .row_container .row_unifast,
    .row_container .row_unifast_list {
        display: flex;
        width: 100%;
        padding: 5px;
    }
    .row_unifast {
        font-family: 'Roboto';
        font-weight: 500;
        margin-bottom: 15px;
    }
    .schedunifast_row {
        width: 25%;
    }
    .row_unifast_list .schedunifast_row {
        font-family: 'Roboto';
        font-size: 13px;
        padding: 5px 0;
        color: #333;
    }
    .row_unifast_list:nth-child(even) {
        background: #0001;
    }
</style>