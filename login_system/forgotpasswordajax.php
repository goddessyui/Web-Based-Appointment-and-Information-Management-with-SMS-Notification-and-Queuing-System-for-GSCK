
<?php
 include_once("../dbconfig.php");
 session_start();
   if ($_POST['type']==1) {
        $username = $_POST['username']; 
        $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username ='{$username}'");
        $query1 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username ='{$username}'");

        if (mysqli_num_rows($query) == 1){
            $row = $query->fetch_assoc();
            $m_number = $row["mobile_number"];
            $rand_no = rand(10000, 99999);
            include '../sms_test/smsAPIcon.php';
            $receiver = $m_number;
            $message = "Your One Time Password is " . $rand_no;
            $smsAPICode = "ST-GOLDE092678_7EKXN";
            $smsAPIPassword = "u5uf{xtl5e";
            $send = new smsfunction();
            $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
           
		      session_unset();
    	    session_destroy();
		      session_start();
            $_SESSION["verification_no"] = $rand_no;
            $_SESSION["verification_username"] = $username;
            echo json_encode(array("statusCode"=>201, "mobile_number"=>$m_number, "verify"=>"student", "username"=>$username));
            
        }
        
        else if (mysqli_num_rows($query1) == 1){
            $row = $query1->fetch_assoc();
            $m_number = $row["mobile_number"];   
            $rand_no = rand(10000, 99999);
            include '../sms_test/smsAPIcon.php';
            $receiver = $m_number;
            $message = "Your One Time Password is " . $rand_no;
            $smsAPICode = "ST-GOLDE092678_7EKXN";
            $smsAPIPassword = "u5uf{xtl5e";
            $send = new smsfunction();
            $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
           
		    session_unset();
    	    session_destroy();
		    session_start();
            $_SESSION["verification_no"] = $rand_no;
            $_SESSION["verification_username"] = $username;
            echo json_encode(array("statusCode"=>202, "mobile_number"=>$m_number, "verify"=>"staff", "username"=>$username));
        }
        else {
            echo json_encode(array("statusCode"=>203));
        }
    }
  


    // OTP
    if ($_POST['type']==2) {
        $verification = $_POST['verification_code'];
        $username = $_POST['username'];
        if ($verification == $_SESSION['verification_no'] && $username == $_SESSION["verification_username"]){
            echo json_encode(array("statusCode"=>201, "verification_no"=>$verification));
         }else{
            echo json_encode(array("statusCode"=>202));
         }
        }
      
        // resend
      if ($_POST['type']==3) {
            if(!empty($_POST["mobile_number"])&&!empty($_POST["username"])){
            $m_number = $_POST["mobile_number"];
            $rand_no = rand(10000, 99999);
            include '../sms_test/smsAPIcon.php';
            $receiver = $m_number;
            $message = "Your One Time Password is " . $rand_no;
            $smsAPICode = "ST-GOLDE092678_7EKXN";
            $smsAPIPassword = "u5uf{xtl5e";
            $send = new smsfunction();
            $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["verification_no"] = $rand_no;
            $_SESSION["verification_username"] = $_POST["username"];
            echo json_encode(array("statusCode"=>201));
            }
            else{
              echo json_encode(array("statusCode"=>202));
            }
            }


  //  change pass
    if ($_POST['type']==4) {
      $username = $_POST['username'];
      $verification_code = $_POST['verification_code'];
      $newpassword  = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
      $verify = $_POST['verify'];
      if($username==$_SESSION['verification_username'] && $verification_code==$_SESSION["verification_no"]){
        if($verify == "student"){
                $sql = "UPDATE tbl_student_registry SET `password` = '$newpassword' WHERE username = '$username'";
                if (mysqli_query($db, $sql)) {
                    session_unset();
                    session_destroy();
                    $db->close();
                    echo json_encode(array("statusCode"=>201));
                  } else {
                    echo json_encode(array("statusCode"=>202));
                  }
                
                } 
         
        
      
          else if($verify == "staff"){
              $sql = "UPDATE tbl_staff_registry SET `password` = '$newpassword' WHERE username = '$username'";
                if (mysqli_query($db, $sql)) {
                  session_unset();
                  session_destroy();
                  $db->close();
                  echo json_encode(array("statusCode"=>201));
                  } else {
                    echo json_encode(array("statusCode"=>202));
                  }               
    }
  }
  else{
    echo json_encode(array("statusCode"=>203));
  }
       
  }    
   
        

    ?>