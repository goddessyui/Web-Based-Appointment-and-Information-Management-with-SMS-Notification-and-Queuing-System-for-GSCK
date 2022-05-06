<?php

include("dbconfig.php");
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$status_report = $_POST['status_report'];
$time_report = $_POST['time_report'];
$info= mysqli_query($db, "SELECT first_name 'fname', last_name 'lname'FROM tbl_staff_registry WHERE staff_id = '$staff_id'");
$row3 = $info->fetch_assoc();
?>

<?php

if ($time_report=='daily'){
$fetch="SELECT tbl_appointment.appointment_id, 
                    tbl_appointment_detail.appointment_date, 
                    tbl_appointment_detail.date_accepted, 
                    tbl_appointment.staff_id, 
                    tbl_appointment.appointment_type,
                    tbl_appointment_detail.status, 
                    tbl_appointment_detail.appointment_detail_id,
                    tbl_student_registry.first_name 's_fname', 
                    tbl_student_registry.last_name 's_lname'
                    FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                    WHERE tbl_appointment_detail.status = '$status_report' AND tbl_appointment.staff_id = '$staff_id'
                    AND day(tbl_appointment_detail.appointment_date) = day(CURDATE())
                    AND year(tbl_appointment_detail.appointment_date) = year(CURDATE())
                    AND month(tbl_appointment_detail.appointment_date) = month(CURDATE())
                    ORDER BY tbl_appointment_detail.appointment_detail_id ASC";
}
if ($time_report=='weekly'){
    $fetch="SELECT tbl_appointment.appointment_id, 
                        tbl_appointment_detail.appointment_date, 
                        tbl_appointment_detail.date_accepted, 
                        tbl_appointment.staff_id, 
                        tbl_appointment.appointment_type,
                        tbl_appointment_detail.status, 
                        tbl_student_registry.first_name 's_fname', 
                        tbl_student_registry.last_name 's_lname'
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                        WHERE tbl_appointment_detail.status = '$status_report' AND tbl_appointment.staff_id = '$staff_id'
                        AND year(tbl_appointment_detail.appointment_date) = year(CURDATE())
                        AND week(tbl_appointment_detail.appointment_date) = week(CURDATE())
                        ORDER BY tbl_appointment_detail.date_accepted ASC";
    }
if ($time_report=='monthly'){
        $fetch="SELECT tbl_appointment.appointment_id, 
                            tbl_appointment_detail.appointment_date, 
                            tbl_appointment_detail.date_accepted, 
                            tbl_appointment.staff_id, 
                            tbl_appointment.appointment_type,
                            tbl_appointment_detail.status, 
                            tbl_student_registry.first_name 's_fname', 
                            tbl_student_registry.last_name 's_lname'
                            FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                            ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                            INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                            WHERE tbl_appointment_detail.status = '$status_report' AND tbl_appointment.staff_id = '$staff_id'
                            AND year(tbl_appointment_detail.appointment_date) = year(CURDATE())
                            AND month(tbl_appointment_detail.appointment_date) = month(CURDATE())
                            ORDER BY tbl_appointment_detail.date_accepted ASC";
}

$fetch_result = mysqli_query($db, $fetch);

//check whether the query is executed or not
if($fetch_result==TRUE) { // count rows to check whether we have data in database or not
    $count = mysqli_num_rows($fetch_result);
    //check the num of rows                 
    if($count>0) { //we have data in database
       
        ?>
 <!-- $rows['fname'].' '.$rows['lname']; -->
 <div><p> STAFF ID: <?php echo $staff_id;?> NAME: <?php echo $row3['fname'].' '.$row3['lname'];?></p></div>
 <div><p> POSITION: <?php echo $staff_id;?></p></div>

            <div class="row_container">
            <div class="row_report">
                <div class="appreport_row">Appointment ID</b></div>
                <div class="appreport_row">Student Name</b></div>
                <div class="appreport_row">Status</b></div>
                <div class="appreport_row">Appointment Type</b></div>
                <div class="appreport_row">Date Validated</b></div>
                <div class="appreport_row">Schedule Date</b></div>
            </div>

        <?php
        while($rows=mysqli_fetch_assoc($fetch_result)) {
?>



        <div class="row_report_list">
                    <div class="appreport_row">
                        <?php echo $rows['appointment_id']; ?>
                    </div>
                        
                    <div class="appreport_row">
                    <?php echo $rows['s_fname'].' '.$rows['s_lname']; ?>
                    </div>

                    <div class="appreport_row">
                    <?php echo $rows['status']; ?>
                    </div>
                    
                    <div class="appreport_row">
                    <?php echo $rows['appointment_type']; ?>
                    </div>

                    <div class="appreport_row">
                    <?php echo date("F d, Y", strtotime($rows['date_accepted'])); ?>
                    </div>

                    <div class="appreport_row">
                    <?php echo date("F d, Y", strtotime($rows['appointment_date'])); ?>
                    </div>
            </div>


        
<?php 
        }
    } 
    else{
        echo "No result.";
    }
}  
?>
 
</div>
<style>
    .row_container {
        margin-top: 40px;
        width: 100%;
    }
    .row_container .row_report,
    .row_container .row_report_list {
        display: flex;
        width: 100%;
        padding: 5px;
    }
    .row_report {
        font-family: 'Roboto';
        font-weight: 500;
        margin-bottom: 15px;
    }
    .appreport_row {
        width: 25%;
    }
    .row_report_list .appreport_row {
        font-family: 'Roboto';
        font-size: 13px;
        padding: 5px 0;
        color: #333;
    }
    .row_report_list:nth-child(even) {
        background: #0001;
    }
</style>