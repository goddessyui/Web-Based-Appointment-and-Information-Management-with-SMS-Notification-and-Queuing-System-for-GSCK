<?php
include_once("../dbconfig.php");
session_start();
//Reschedule Appointment

$l = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '2'";
   $limitvalue= mysqli_query($db, $l);
   
   if($limitvalue==TRUE){
      while($al=mysqli_fetch_assoc($limitvalue)){   
         $limit = $al['appointment_limit'];

         if(isset($_POST['reschedule'])){
         // Prepare an update statement
            date_default_timezone_set('Asia/Manila');                           		
            $currentdate = date("Y-m-d");
            $original = $_POST['appointment_date'];  
            $newDate = date("Y-m-d", strtotime($original));  
                                          echo $newDate;
            $appointment_id = $_GET['appointment_id'];
            $comment = $_POST['comment'];
            

            $noofappointments ="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
            ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id
            WHERE tbl_appointment_detail.appointment_date = '$newDate' AND tbl_appointment_detail.status = 'Accepted' AND tbl_appointment.appointment_type IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')";
            $appnumber = mysqli_query($db, $noofappointments);
            $countapp = mysqli_num_rows( $appnumber);
            
            if($countapp<=($limit-1)){                         
               $updatedate = "UPDATE tbl_appointment_detail SET `status` ='Cancelled' WHERE appointment_id ='".$_GET['appointment_id']."'";
            
            
               if (mysqli_query($db, $updatedate)) {
                  

                  $insertnew ="INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                  VALUES ('$appointment_id', '$currentdate', '$newDate', '$comment', 'Accepted')";
                  
                  if (mysqli_query($db, $insertnew)) {

                     // insert data into tbl_notification if staff reschedule an appointment
                     $appointment_type = $_POST['appointment_type'];
                     $student_id = $_POST['student_id'];
                     $staff_id = $_SESSION["staff_id"];
                     $querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
                     $rows = $querys->fetch_assoc();
                      $fullnames = $rows['first_name'].' '.$rows['last_name'];
                      mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`, `link`) VALUES 
                     ('APPOINTMENT RESCHEDULED', 
                     '$fullnames has RESCHEDULED your appointment for  $appointment_type', '0', 
                     '$student_id', 'student_appointment_details.php?status=reschedule&apde=$appointment_id')");

                     // delete older notif if exced 10 rows
                     $result = mysqli_query($db, "SELECT notification_id FROM tbl_notification WHERE id='$student_id' ORDER BY notification_id DESC LIMIT 10,1");
                     $fetch = mysqli_fetch_assoc($result);
                     mysqli_query($db, "DELETE FROM `tbl_notification` WHERE `notification_id` < '".$fetch['notification_id']."' AND `id`='$student_id'");

                     
                     //Add Queueing and SMS function here???-----------------------------------------
                     $q="SELECT queuenum FROM (SELECT *, ROW_NUMBER() OVER(ORDER BY appointment_detail_id) AS queuenum 
                        FROM tbl_appointment_detail WHERE (`status` = 'Accepted' OR `status` = 'Cancelled') 
                        AND appointment_date = '$newDate') T2 
                        WHERE appointment_id = '$appointment_id'";
                     $qnum = mysqli_query($db, $q); 
                     $queue = mysqli_fetch_assoc($qnum);
                     //Queue Number---------------------------------------------------------------------------------------//
                     $queuenumber = $queue['queuenum'];
                     echo "<br><br>Queue Number:" . $queuenumber;
                     //Queue Number---------------------------------------------------------------------------------------//  
                     // send sms to student if apppointment rescheduled
                     $querys = mysqli_query($db, "SELECT mobile_number, last_name, first_name FROM tbl_student_registry WHERE student_id='".$student_id."'");
                     $rows1 = $querys->fetch_assoc();
                     $m_number = $rows1['mobile_number'];
                     $student_fullname = $rows1['first_name'].' '.$rows1['last_name'];
                     $move='true';
                     include ('sms_appointment.php');
                     
                     header('location: ../unifast_accepted_request.php?success="Appointment Successfully Rescheduled!'.$queuenumber.'"');
                     
                  }
                  else {
                     header('location: ../unifast_accepted_request.php?error="<?php echo "Error inserting record " . mysqli_error($db);?>"');
                  }
               } 

               else {
                 
                  header('location: ../unifast_accepted_request.php?error="<?php echo "Error updating record " . mysqli_error($db);?>"');
                
               }
            }
            else{
               header('location: ../unifast_accepted_request.php?error="Appointment for that date are already limited!"');
            }
         }  
      }
   }
?>
