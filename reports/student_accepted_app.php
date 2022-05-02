
<!----------------Shows Student's Active Appointments------------------------------------------------------------>
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
            AND tbl_appointment_detail.appointment_date > '$currentdate'
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
                    <div>
                        <td>
                            <?php   echo $i;
                                    $i++; 
                            ?>
                        </td>
                        <p><span>Appointment Date:</span>
                        <?php      
                                        if($appointment_date<=$currentdate){
                                            echo "<font color='red';>" . $appointment_date . ": Missed Appointment. </font>";
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
                                echo "Queue Number:" . $queuenumber;
                                //Queue Number---------------------------------------------------------------------------------------// 
                            ?>

                        </p>
                        <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p>
                        <p><span>Appointment ID:</span> <?php echo $rows['appointment_id']; ?></p>
                        <p><span>My Note:</span><pre><?php echo $rows['note']; ?></pre></p>
                        <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                        <p><span>Staff: </span><?php echo $rows['first_name']. " ". $rows['last_name']; ?></p>
                        <p><span>Staff's Comment:</span><pre><?php echo $rows['comment']; ?></pre></p>
                        <hr>
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