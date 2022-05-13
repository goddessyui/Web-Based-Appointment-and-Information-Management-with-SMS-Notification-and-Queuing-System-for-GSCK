
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

                        <div class="appointment_data_row">
                            <p>Appointment Date</p>

                            <h3>
                                <?php      
                                    if($appointment_date<$currentdate){
                                        echo $appointment_date . ": Missed Appointment";
                                    }
                                    else {
                                        echo $rows['appointment_date'];
                                    }
                                ?>
                            </h3>
                        </div>

                        <div class="appointment_data_row">
                            <p>Queue Number</p>
                            <h3>
                            <?php
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
                            </h3>
                        </div>

                        <div class="appointment_data_row">
                            <p>Date Created</p>
                            <h3><?php echo $rows['date_created']; ?></h3>
                        </div>

                        <div class="appointment_data_row">
                            <div class="note_comment">
                                <div class="note_box">
                                    <p>Note</p>
                                    <small><?php echo $rows['note']; ?></small>
                                </div>
        
                                <div class="note_box">
                                    <p>Comment</p>
                                    <small><?php echo $rows['comment']; ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="appointment_data_row">
                            <p>Appointment Type</p>
                            <h3><?php echo $rows['appointment_type']; ?></h3>
                        </div>

                        <div class="appointment_data_row">
                            <p>Staff</p>
                            <h3><?php echo $rows['first_name']. " ". $rows['last_name']; ?></h3>
                        </div>

                       
                        
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
        justify-content: flex-start;
    }
    .my_appointment .my_appnt_data {
        width: 340px;
        min-height: 40vh;
        padding-top: 0;
        padding-left: 20px;
        padding-right: 30px;
        padding-bottom: 20px;
        margin-bottom: 30px;
        background: #fff;
    }
    .my_appointment .my_appnt_data:not(:nth-child(4)) {
        margin-right: 30px;
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
        transform: translate(45px, -15px);
        color: #eee;
        font-family: 'Roboto Serif';
    }
  .my_appnt_data .appointment_data_row {
      background: none;
      margin-bottom: 20px;
      padding: 0 20px;
  }
  .my_appnt_data .appointment_data_row p {
      margin-bottom: 4px;
      color: #444;
      font-family: 'Roboto';
      font-size: 13px;
  }
  .my_appnt_data .appointment_data_row h3 {
      font-family: 'Roboto';
      color: #333;
      font-weight: 400;
      font-size: 16px;
  }
  .my_appnt_data .appointment_data_row:nth-child(3) h3 {
      color: #324E9E;
      font-size: 20px;
      font-family: 'Roboto Serif';
      font-weight: bolder;
  }
  .my_appnt_data .appointment_data_row small {
      color: #444;
      font-family: 'Roboto Serif';
  }
        .note_comment .note_box {
            min-height: 5vh;
        }
        .note_box small {
            font-family: 'Roboto Serif';
            font-family: 12px;
            color: #444;
        }
        .note_comment .note_box:nth-child(1) {
            margin-bottom: 15px;
        }
            
.my_appnt_data .appointment_data_row:nth-child(2),
.my_appnt_data .appointment_data_row:nth-child(3),
.my_appnt_data .appointment_data_row:nth-child(4) {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.my_appnt_data .appointment_data_row:nth-child(2),
.my_appnt_data .appointment_data_row:nth-child(3) {
    margin-bottom: 5px;
}
.my_appnt_data .appointment_data_row:nth-child(2) h3,
.my_appnt_data .appointment_data_row:nth-child(3) h3,
.my_appnt_data .appointment_data_row:nth-child(4) h3 {
    width: 40%;
}

.my_appnt_data .appointment_data_row:nth-child(3) {
    display: flex;
    align-items: center;
    justify-content: space-between;
}



</style>