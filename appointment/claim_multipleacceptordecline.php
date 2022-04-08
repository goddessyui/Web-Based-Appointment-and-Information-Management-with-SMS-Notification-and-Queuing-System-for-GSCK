<?php
include_once("../dbconfig.php");
session_start();


   $l = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
   $limitvalue= mysqli_query($db, $l);

      if($limitvalue==TRUE) {

         while($al=mysqli_fetch_assoc($limitvalue)) {   
            $limit = $al['appointment_limit'];

            if(isset($_POST['accept'])) {//accept appointment
               $staff_id = $_SESSION["staff_id"];
               
               foreach ($_POST['pending'] as $appointment_id) {
                  date_default_timezone_set('Asia/Manila');                           		
                  $currentdate = date("Y-m-d");

                  foreach ($_POST['ad'] as $ad) {
                     $appointment_date = $ad;

                     foreach ($_POST['com'] as $com) {
                        $comment = $com;

                        $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                           tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                           tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                           tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year
                           FROM tbl_appointment INNER JOIN tbl_staff_registry 
                           ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                           INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                           WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                           WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                           AND tbl_staff_registry.staff_id = '$staff_id' 
                           AND tbl_appointment.appointment_id = $appointment_id 
                           ORDER BY date_created ASC";

                        $request_result = mysqli_query($db, $requests);
                        $rows=mysqli_fetch_assoc($request_result);

                        $student_id = $rows['student_id'];
                        $appointment_type = $rows['appointment_type'];
                        
                        $noofappointments ="SELECT * FROM tbl_appointment_detail 
                           WHERE appointment_date = '$appointment_date' AND `status` = 'Accepted'";
                        
                        $appnumber = mysqli_query($db, $noofappointments);
                        $countapp = mysqli_num_rows( $appnumber);
                        
                        if($countapp<=($limit-1)) {
                           $acceptappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                              VALUES ('$appointment_id', '$currentdate', '$appointment_date', '$comment', 'Accepted')";
            
                           if(mysqli_query($db, $acceptappointment)) {
            
                              // insert data into tbl_notification if staff accept a request
                              $querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
                                 $rows = $querys->fetch_assoc();
                                 $fullnames = $rows['first_name'].' '.$rows['last_name'];
                                 mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`, `link`) VALUES 
                                 ('REQUEST UPDATE', 
                                 '$fullnames has ACCEPTED your request for  $appointment_type', '0', 
                                 '$student_id', 'student_appointment_details.php?status=accepted&apde=$appointment_id')");
            
                              header("refresh:2;url=../claimcheque_pendingapp.php");
                              echo "Appointment request accepted and scheduled on". " ". $appointment_date;
                                 //Add Queueing and SMS function here???-----------------------------------------
                                 $q="SELECT queuenum FROM (SELECT *, ROW_NUMBER() OVER(ORDER BY appointment_id) AS queuenum 
                                    FROM tbl_appointment_detail WHERE (`status` = 'Accepted' OR `status` = 'Cancelled') 
                                    AND appointment_date = '$appointment_date') T2 
                                    WHERE appointment_id = '$appointment_id'";
                                 $qnum = mysqli_query($db, $q); 
                                 $queue = mysqli_fetch_assoc($qnum);
                                 //Queue Number---------------------------------------------------------------------------------------//
                                 $queuenumber = $queue['queuenum'];
                                 echo "<br><br>Queue Number:" . $queuenumber;
                                 //Queue Number---------------------------------------------------------------------------------------//   
                           } 
                           else { 
                              header("refresh:10;url=../claimcheque_pendingapp.php");
                              echo "ERROR: Not able to execute. " . mysqli_error($db);
                           }
                        }
                        else {
                           header("refresh:10;url=../claimcheque_pendingapp.php");
                           echo "Appointments for ". $appointment_date . " are limited to " . $limit;
                        }



                              ?>
                              <hr>
                              <?php
                     }    

                  }
               }   
            } //accept appointment
            
            if(isset($_POST['decline'])) {//decline appointment
               $staff_id = $_SESSION["staff_id"];
               
               foreach ($_POST['pending'] as $appointment_id) {
                  date_default_timezone_set('Asia/Manila');                           		
                  $currentdate = date("Y-m-d");

                  foreach ($_POST['ad'] as $ad) {
                     $appointment_date = $ad;

                     foreach ($_POST['com'] as $com) {
                        $comment = $com;

                        $requests="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                           tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                           tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                           tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year
                           FROM tbl_appointment INNER JOIN tbl_staff_registry 
                           ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                           INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                           WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                           WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                           AND tbl_staff_registry.staff_id = '$staff_id' 
                           AND tbl_appointment.appointment_id = $appointment_id 
                           ORDER BY date_created ASC";

                        $request_result = mysqli_query($db, $requests);
                        $rows=mysqli_fetch_assoc($request_result);

                        $student_id = $rows['student_id'];
                        $appointment_type = $rows['appointment_type'];
                        
                        $noofappointments ="SELECT * FROM tbl_appointment_detail 
                           WHERE appointment_date = '$appointment_date' AND `status` = 'Declined'";
                        
                        $appnumber = mysqli_query($db, $noofappointments);
                        $countapp = mysqli_num_rows( $appnumber);
                        
                        if($countapp<=($limit-1)) {
                           $acceptappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                              VALUES ('$appointment_id', '$currentdate', '$appointment_date', '$comment', 'Accepted')";
            
                           if(mysqli_query($db, $acceptappointment)) {
            
                              // insert data into tbl_notification if staff accept a request
                              $querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
                                 $rows = $querys->fetch_assoc();
                                 $fullnames = $rows['first_name'].' '.$rows['last_name'];
                                 mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`,`link`) VALUES 
                                 ('REQUEST UPDATE', 
                                 '$fullnames has DECLINED your request for  $appointment_type', '0', 
                                 '$student_id', 'student_appointment_details.php?status=declined&apde=$appointment_id')");
            
                              header("refresh:2;url=../claimcheque_pendingapp.php");
                              echo "Appointment request accepted and scheduled on". " ". $appointment_date;
                                 //Add Queueing and SMS function here???-----------------------------------------
                                 $q="SELECT queuenum FROM (SELECT *, ROW_NUMBER() OVER(ORDER BY appointment_id) AS queuenum 
                                    FROM tbl_appointment_detail WHERE (`status` = 'Accepted' OR `status` = 'Cancelled') 
                                    AND appointment_date = '$appointment_date') T2 
                                    WHERE appointment_id = '$appointment_id'";
                                 $qnum = mysqli_query($db, $q); 
                                 $queue = mysqli_fetch_assoc($qnum);
                                 //Queue Number---------------------------------------------------------------------------------------//
                                 $queuenumber = $queue['queuenum'];
                                 echo "<br><br>Queue Number:" . $queuenumber;
                                 //Queue Number---------------------------------------------------------------------------------------//   
                           } 
                           else { 
                              header("refresh:10;url=../claimcheque_pendingapp.php");
                              echo "ERROR: Not able to execute. " . mysqli_error($db);
                           }
                        }
                        else {
                           header("refresh:10;url=../claimcheque_pendingapp.php");
                           echo "Appointments for ". $appointment_date . " are limited to " . $limit;
                        }



                              ?>
                              <hr>
                              <?php
                     }    

                  }
               }   


            }//decline appointment


         }
      }

            
            

         ?>
 


