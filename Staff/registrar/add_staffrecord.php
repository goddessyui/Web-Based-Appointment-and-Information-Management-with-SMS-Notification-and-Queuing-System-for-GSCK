<?php
include_once("../../dbconfig.php");
session_start(); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '../../../gmailsender/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '../../../gmailsender/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '../../../gmailsender/vendor/phpmailer/src/SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
//--------------------------If Add is Pressed---------------------------//
if (isset($_POST['add'])) {
   $staff_id = $_POST['staffid'];
   $first_name = $_POST['firstname'];
   $last_name = $_POST['lastname'];
   $email = $_POST['email'];
   $findstaff = "SELECT staff_id FROM tbl_staff_record WHERE staff_id = '$staff_id'";//check if staff already exists in database
   $findstaff_result = mysqli_query($db, $findstaff);

      $count = mysqli_num_rows($findstaff_result);  //function to get all the rows in database
      //check the num of rows                 
      if($count>0) //we have data in database
      { 
         header('location: ../../upload_unifast_grantee.php?error="Failed to add the staff into the system. Staff ID already exists in the database"');
      }
      else{
         $check1 = mysqli_query($db, "SELECT * FROM tbl_staff_record WHERE staff_id='{$staff_id}' AND first_name='{$first_name}' AND last_name='{$last_name}'");
         if (mysqli_num_rows($check1)!=1){
            
         $addstaff = "INSERT INTO tbl_staff_record (`staff_id`, `first_name`, `last_name`, `email`)
         VALUES ('$staff_id', '$first_name', '$last_name', '$email')";

         if(mysqli_query($db, $addstaff)){

            $check = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE staff_id='{$staff_id}' AND first_name='{$first_name}' AND last_name='{$last_name}'");
            if (mysqli_num_rows($check)!=1){

               $fname = $first_name.' '.$last_name;
               $username = $staff_id;
               $password = rand(100000, 999999);
               $passwd = password_hash($password, PASSWORD_DEFAULT);
               $sql ="INSERT INTO tbl_staff_registry (staff_id, first_name, last_name, username, `password`, register_status) VALUES ('$staff_id', '$first_name', '$last_name', '$username', '$passwd', '0')";
               mysqli_query($db, $sql);

            try {
               $mail->isSMTP();
               $mail->Host = 'smtp.gmail.com';
               $mail->SMTPAuth = true;
               $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
               $mail->Port = 587;

               $mail->Username = 'goldenstatecollege00@gmail.com'; // YOUR gmail email
               $mail->Password = 'goldenstate123'; // YOUR gmail password
               // Sender and recipient settings
               $mail->setFrom('goldenstatecollege00@gmail.com', 'Goldentstate College');
               $mail->addAddress($email, $fname);
               $mail->addReplyTo('goldenstatecollege00@gmail.com', 'Goldentstate College'); // to set the reply to

               // Setting the email content
               $mail->IsHTML(true);
               $mail->Subject = "Goldenstate College Appointment System First Time Login Account";
               $mail->Body = 'Dear '.$fname.'<br><br>Your temporary account for <a href="gsck.online">Goldenstate College Appointment System</a> is ready to use.
                               <br><br>Username: '.$username.'<br>Password: '.$password.
                               '<br><br>If you have any concerns dont hesitate to contact us in goldenstatecollege00@gmail.com<br><br>Do not share your temporary username and password to anyone';
               $mail->AltBody = 'Dear '.$fname.'\n\nYour temporary account for Goldenstate College Appointment System(gsck.online) is ready to use.
               \n\nUsername: '.$username.'\nPassword: '.$password.
               '\n\nIf you have any concerns dont hesitate to contact us in goldenstatecollege00@gmail.com\n\nDo not share your temporary username and password to anyone';

               $mail->send();
               echo "Email message sent.";
               } catch (Exception $e) {
                  echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
               }

            header('location: ../../upload_staff_records.php?success="Successfully Added Staff!"');
         } 
         else {
            header('location: ../../upload_staff_records.php?error="error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
         }
      }
   }
}
}
//--------------------------If Accept is Pressed---------------------------//
