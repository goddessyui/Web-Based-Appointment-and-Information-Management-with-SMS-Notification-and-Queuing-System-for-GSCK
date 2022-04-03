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
         $appointment_id = $_GET['appointment_id'];
         $comment = $_POST['comment'];
         $appointment_date = $_POST['appointment_date'];
         $student_id = $_POST['student_id'];
         $staff_id = $_SESSION["staff_id"];
         $appointment_type = $_POST['appointment_type'];
         
         if (empty($_POST['appointment_date'])) {//if appointment date is not filled
            header("refresh:1;url=../staff_appointment_details.php");
            echo "Appointment date should be filled";
         } 
         else { //if appointment date is filled 
            $noofappointments ="SELECT * FROM tbl_appointment_detail 
            WHERE appointment_date = '$appointment_date' AND `status` = 'Accepted'";
            $appnumber = mysqli_query($db, $noofappointments);
            $countapp = mysqli_num_rows( $appnumber);
            
            if($countapp<=($limit-1)){
               $acceptappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                                 VALUES ('$appointment_id', '$currentdate', '$appointment_date', '$comment', 'Accepted')";

               if(mysqli_query($db, $acceptappointment)){

                  // insert data into tbl_notification if staff accept a request
                  $querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
                   $rows = $querys->fetch_assoc();
                   $fullnames = $rows['first_name'].' '.$rows['last_name'];
                   mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`) VALUES 
                   ('REQUEST UPDATE', 
                  '$fullnames has ACCEPTED your request for  $appointment_type', '0', 
                  '$student_id')");

                  header("refresh:2;url=../staff_appointment_details.php");
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
                  header("refresh:10;url=../staff_appointment_details.php");
                  echo "ERROR: Not able to execute. " . mysqli_error($db);
               }
            }
            else {
               header("refresh:10;url=../staff_appointment_details.php");
               echo "Appointments for ". $appointment_date . " are limited to " . $limit;
            }
         }
      }
      //--------------------------End of If Accept is Pressed---------------------------//

      //--------------------------Start of If Decline is Pressed--------------------------// 
      else if (isset($_POST['decline'])) {
         date_default_timezone_set('Asia/Manila');                           		
         $currentdate = date("Y-m-d");
         $appointment_id = $_GET['appointment_id'];
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
            mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`) VALUES 
            ('REQUEST UPDATE', 
            '$fullnames has DECLINED your request for  $appointment_type', '0', 
            '$student_id')");

            header("refresh:2;url=../staff_appointment_details.php");
            echo "Appointment Request Declined.";
         } 
         else{
            header("refresh:2;url=../staff_appointment_details.php");
            echo "ERROR: Not able to execute. " . mysqli_error($db);
         }
      }
      //--------------------------End of If Decline is Pressed--------------------------// 

      }
   }
?>

