<?php
    include('../db_connection.php');
    //session_start();
    //$student_id = $_SESSION["student_id"];
    //$username1 = $_SESSION["student_username"];
    //$query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
    //$row = $query->fetch_assoc();
   // if ($student_id == "" && $username1 == ""){
    //    echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
    //}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>
<body>
    <h1>Student User Interface</h1>
    
    <br>
    <br>


    <form method="post">

        <input type="submit" value="Evaluation of Grades" name="evaluation"><br/><br/>
        <input type="submit" value="Meeting" name="meeting"><br/><br/>

        
        <?php
        $appointmenttype = "hello";
        
        if(isset($_POST["evaluation"]))
        {
            $appointmenttype = "evaluation";
            $staff_appointment = "SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
        tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id WHERE appointment_type = 'EVALUATION OF GRADES'";

        $result = mysqli_query($db, $staff_appointment);
        if($result==TRUE) {
            $count = mysqli_num_rows($result);
            if($count > 0) {
                while($rows = mysqli_fetch_assoc($result)) {

                    ?>  <form name='evaluation' method="post">
                        <input type="radio" name="staff_name" id="registry" value="<?php echo $rows['first_name']." ". $rows['last_name']; ?>">
                        <label for="registry"><?php echo $rows['first_name']." ". $rows['last_name'];?></label>
                        </form>
                    <?php
                    }
                }
            }

        }


        if(isset($_POST["meeting"]))
        {
           
            $staff_appointment = "SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
        tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id WHERE appointment_type = 'MEETING'";

        $result = mysqli_query($db, $staff_appointment);
        if($result==TRUE) {
            $count = mysqli_num_rows($result);
            if($count > 0) {
                while($rows = mysqli_fetch_assoc($result)) {

                    ?>  <select>
                        <option type="op" name="staff_name" id="registry" value="<?php echo $rows['first_name']." ". $rows['last_name']; ?>">
                        <?php echo $rows['first_name']." ". $rows['last_name']; ?></option>
                        </select>
                    <?php
                    }
                }
            }

        }
    
        if(isset($_POST["submit"]))
        {
                    /* Attempt MySQL server connection. Assuming you are running MySQL
            server with default setting (user 'root' with no password) */
    
            

            $student_id = "STUDENTNO1";
            $first_name = "first_name";
            $last_name = "last_name";
            $find = "SELECT staff_id FROM tbl_staff_registry WHERE first_name = '$first_name' AND last_name = '$last_name'";
            $request_result = mysqli_query($db, $find);
            $rows=mysqli_fetch_assoc($request_result);
            $staff_id = $rows['staff_id'];
    
            $note = $_POST['note'];  
            date_default_timezone_set('Asia/Manila');                           		
            $currentdate = date("Y-m-d");
    
            // Check connection
            if($db === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
     
            // Attempt insert query execution
            $studentappointment = "INSERT INTO tbl_appointment (`date_created`,`student_id`, `staff_id`, `appointment_type`, `note`, `status`) 
            VALUES ('$currentdate', '$student_id', '$staff_id', '$appointmenttype', '$note', 'pending')";
            if(mysqli_query($db, $studentappointment)){
                echo "Records inserted successfully.";
            } else{
                echo "ERROR: Could not able to execute $studentappointment. " . mysqli_error($db);
            }
    
    
    
    
            // Close connection
            mysqli_close($db);


        }
        ?>
        <br/><br/>
        <input type="textarea" value=" " name="note"><br/><br/>
        <input type="submit" value="submit" name="submit"><br/><br/>
    </form>

  



</body>
</html>