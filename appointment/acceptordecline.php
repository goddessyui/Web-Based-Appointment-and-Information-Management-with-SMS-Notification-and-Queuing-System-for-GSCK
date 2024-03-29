<?php
include_once("../dbconfig.php");
session_start(); 


   $l = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
   $limitvalue= mysqli_query($db, $l);
   
   if($limitvalue==TRUE){
      while($al=mysqli_fetch_assoc($limitvalue)){   
         $limit = $al['appointment_limit'];
      //--------------------------Start of If Accept is Pressed---------------------------//
      if (isset($_POST['accept'])) {
         date_default_timezone_set('Asia/Manila');                           		
         $currentdate = date("Y-m-d");
         $appointment_id = $_POST['appointment_id'];
         $comment = $_POST['comment'];
         $appointment_date = $_POST['appointment_date'];
         $student_id = $_POST['student_id'];
         $staff_id = $_SESSION["staff_id"];
         $appointment_type = $_POST['appointment_type'];
         $appointment_time_open = $_POST['app_time'];
         $appointment_time_close = '';
         switch ($appointment_time_open) {
            case "08:00":
              $appointment_time_close = '09:00';
              break;
            case "09:00":
               $appointment_time_close = '10:00';
              break;
            case "10:00":
               $appointment_time_close = '11:00';
              break;
            case "11:00":
               $appointment_time_close = '12:00';
                break;
            case "13:00":
               $appointment_time_close = '14:00';
               break;
            case "14:00":
               $appointment_time_close = '15:00';
               break;
            case "15:00":
               $appointment_time_close = '16:00';
               break;
            case "16:00":
               $appointment_time_close = '17:00';
               break;
            default:
          }
         
         if (empty($_POST['appointment_date'])) {//if appointment date is not filled
            header('location: ../staff_pending_requests.php?error="Appointment date should be filled."');
           
         } 
         else { //if appointment date is filled 
            $noofappointments ="SELECT * FROM tbl_appointment_detail 
            WHERE appointment_date = '$appointment_date' AND `status` = 'Accepted' AND `appointment_time_open`='$appointment_time_open'";
            $appnumber = mysqli_query($db, $noofappointments);
            $countapp = mysqli_num_rows( $appnumber);
            
            if($countapp<=($limit-1)){
               $acceptappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`, `appointment_time_open`, `appointment_time_close`)
                                 VALUES ('$appointment_id', '$currentdate', '$appointment_date', '$comment', 'Accepted', '$appointment_time_open', '$appointment_time_close')";

               if(mysqli_query($db, $acceptappointment)){

                  // insert data into tbl_notification if staff accept a request
                  $querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
                   $rows = $querys->fetch_assoc();
                   $fullnames = $rows['first_name'].' '.$rows['last_name'];
                   mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`, `link`) VALUES 
                   ('REQUEST ACCEPTED', 
                  '$fullnames has ACCEPTED your request for $appointment_type', '0', 
                  '$student_id', 'student_appointment_details.php?status=accepted&apde=$appointment_id')");

                  // delete older notif if exced 10 rows
                  $result = mysqli_query($db, "SELECT notification_id FROM tbl_notification WHERE id='$student_id' ORDER BY notification_id DESC LIMIT 10,1");
                  $fetch = mysqli_fetch_assoc($result);
                  mysqli_query($db, "DELETE FROM `tbl_notification` WHERE `notification_id` < '".$fetch['notification_id']."' AND `id`='$student_id'");

                     //Add Queueing and SMS function here???-----------------------------------------
                     $q="SELECT queuenum FROM (SELECT *, ROW_NUMBER() OVER(ORDER BY appointment_detail_id) AS queuenum 
                        FROM tbl_appointment_detail WHERE (`status` = 'Accepted' OR `status` = 'Cancelled') 
                        AND appointment_date = '$appointment_date') T2 
                        WHERE appointment_id = '$appointment_id'";
                     $qnum = mysqli_query($db, $q); 
                     $queue = mysqli_fetch_assoc($qnum);
                     //Queue Number---------------------------------------------------------------------------------------//
                     $queuenumber = $queue['queuenum'];
                     echo "<br><br>Queue Number:" . $queuenumber;
                     //Queue Number---------------------------------------------------------------------------------------// 
                     
                     // send sms to student if accepted
                     $student_fullname = $_POST['student_fullname'];
                     $m_number = $_POST['number'];
                     $accept='true';
                     include ('sms_appointment.php');

                     header('location: ../staff_pending_requests.php?success="Appointment request accepted."');
               } 
               else {
                  header('location: ../staff_pending_requests.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
               }
            }
            else {
               header('location: ../staff_pending_requests.php?error="Appointments for that date and time are already full."');
            }
         }
      }
      //--------------------------End of If Accept is Pressed---------------------------//

      //--------------------------Start of If Decline is Pressed--------------------------// 
      else if (isset($_POST['decline'])) {
         date_default_timezone_set('Asia/Manila');                           		
         $currentdate = date("Y-m-d");
         $appointment_id = $_POST['appointment_id'];
         $comment = $_POST['comment'];
         $appointment_type = $_POST['appointment_type'];
         $student_id = $_POST['student_id'];
         $staff_id = $_SESSION["staff_id"];
         
         $declineappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                              VALUES ('$appointment_id', '$currentdate', '$currentdate', '$comment', 'Declined')";
         
         if(mysqli_query($db, $declineappointment)){

            // insert data into tbl_notification if staff decline a request
            $querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
            $rows = $querys->fetch_assoc();
            $fullnames = $rows['first_name'].' '.$rows['last_name'];
            mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`, `link`) VALUES 
            ('REQUEST DECLINED', 
            '$fullnames has DECLINED your request for $appointment_type', '0', 
            '$student_id', 'student_appointment_details.php?status=declined&apde=$appointment_id')");

            // delete older notif if exced 10 rows
            $result = mysqli_query($db, "SELECT notification_id FROM tbl_notification WHERE id='$student_id' ORDER BY notification_id DESC LIMIT 10,1");
            $fetch = mysqli_fetch_assoc($result);
            mysqli_query($db, "DELETE FROM `tbl_notification` WHERE `notification_id` < '".$fetch['notification_id']."' AND `id`='$student_id'");

            // send sms to student if apppointment declined
            $student_fullname = $_POST['student_fullname'];
            $m_number = $_POST['number'];
            $decline='true';
            include ('sms_appointment.php');

            header('location: ../staff_pending_requests.php?success="Appointment Request Declined"'); 
         } 
         else {
            header('location: ../staff_pending_requests.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');   
         }
      }
      //--------------------------End of If Decline is Pressed--------------------------// 
      }
   }
?>

