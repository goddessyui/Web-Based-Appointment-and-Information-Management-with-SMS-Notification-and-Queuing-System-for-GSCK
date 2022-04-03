<?php
include_once("../dbconfig.php");
session_start();
//Reschedule Appointment

$l = "SELECT appointment_limit FROM tbl_appointment_limit WHERE limit_id = '1'";
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

            $noofappointments ="SELECT * FROM tbl_appointment_detail 
            WHERE appointment_date = '$newDate' AND `status` = 'Accepted'";
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
                      mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`) VALUES 
                     ('APPOINTMENT UPDATE', 
                     '$fullnames has RESCHEDULE your appointment for  $appointment_type', '0', 
                     '$student_id')");


                     header("refresh:2;url=../staff_appointment_details.php");
                     echo "Success";
                  }
                  else {
                     header("refresh:2;url=../staff_appointment_details.php");
                     echo "Error inserting record " . mysqli_error($db);
                  }
               } 

               else {
                  header("refresh:2;url=../staff_appointment_details.php");
                  echo "Error updating record " . mysqli_error($db);
               }
            }
            else{
               header("refresh:2;url=../staff_appointment_details.php");
               echo "Appointments for ". $newDate. " are limited to " . $limit;
            }
         }  
      }
   }
?>
