
<!----------------Shows Student's Active Appointments------------------------------------------------------------>
<div class="my_appointment">

<?php
    date_default_timezone_set('Asia/Manila');                           		
    $currentdate = date("Y-m-d");

     if (isset($_GET['apde'])){
        $acceptedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
        tbl_appointment.note, tbl_appointment_detail.comment
        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Accepted'
        AND tbl_appointment.appointment_id = '".$_GET['apde']."'
        ORDER BY appointment_date ASC";
     }
    else {
        $acceptedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
            tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
            tbl_appointment.note, tbl_appointment_detail.comment
            FROM tbl_appointment_detail INNER JOIN tbl_appointment 
            ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
            INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
            WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Accepted'
            AND tbl_appointment_detail.appointment_date >= '$currentdate'
            ORDER BY appointment_date ASC";
     }
        $accepted_appointment_list = mysqli_query($db, $acceptedappointment);
                    
        //check whether the query is executed or not
        if($accepted_appointment_list==TRUE) {
            $count = mysqli_num_rows($accepted_appointment_list);
            //check the num of rows                 
            if($count>0) {
                $i = 1;
                while($rows=mysqli_fetch_assoc($accepted_appointment_list)) {
                    $appointment_id = $rows['appointment_id'];
                    $appointment_date = $rows['appointment_date'];
                
                    date_default_timezone_set('Asia/Manila');                           		
                    $currentdate = date("Y-m-d");?>
                    <div class="my_appnt_data">

                        <div class="number_container">
                            <p class="appointment_number">
                                <?php   echo $i;
                                        $i++; 
                                ?>
                            </p>
                        </div>

                        <p>
                        <?php      
                                        if($appointment_date<$currentdate){
                                            echo $appointment_date . ": Missed Appointment";
                                        }
                                        else {
                                            echo $rows['appointment_date'];
                                        }?></p>
                        <p><?php
                            $q="SELECT queuenum FROM (SELECT *, ROW_NUMBER() OVER(ORDER BY appointment_id) AS queuenum 
                                FROM tbl_appointment_detail WHERE (`status` = 'Accepted' OR `status` = 'Cancelled') 
                                AND appointment_date = '$appointment_date') T2 WHERE appointment_id='$appointment_id'";
                                $qnum = mysqli_query($db, $q); 
                                $queue = mysqli_fetch_assoc($qnum);
                                //Queue Number---------------------------------------------------------------------------------------//
                                $queuenumber = $queue['queuenum'];
                                echo $queuenumber;
                                //Queue Number---------------------------------------------------------------------------------------// 
                            ?>

                        </p>
                        <p><?php echo $rows['date_created']; ?></p>
                        <p><?php echo $rows['appointment_id']; ?></p>
                        <p><?php echo $rows['note']; ?></p>
                        <p><?php echo $rows['appointment_type']; ?></p>
                        <p><?php echo $rows['first_name']. " ". $rows['last_name']; ?></p>
                        <p><?php echo $rows['comment']; ?></p>
                        
                    </div>
    <?php 
                }
            }
            else {
                echo isset($_GET['apde'])?"The Appointment already been done/cancelled":"No Active Appointments.";
            }
        }

    ?>
<!----------------Shows Student's Active Appointments------------------------------------------------------------>
</div>

<style>
    .my_appointment {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .my_appointment .my_appnt_data {
        border: 1px solid lightgrey;
        width: 320px;
        min-height: 40vh;
        padding: 20px;
    }
    
    .my_appnt_data p {
        border: 1px solid #fff; 
    }
    .number_container  {
        display: flex;
        align-items: center;
        justify-content: end;
    }
    .my_appnt_data .number_container .appointment_number {
        width: 38px;
        height: 38px;
        line-height: 38px;
        text-align: center;
        background: #324E9E;
        border-radius: 50%;
        transform: translate(35px, -35px);
        color: #eee;
        font-family: 'Roboto Serif';
    }
  
</style>