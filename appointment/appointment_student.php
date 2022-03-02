<?php
    include('../db_connection.php');
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
    <button>Set an Appointment</button>
    <br>
    <br>


    <form method="post">

        <input type="submit" value="Evaluation of Grades" name="evaluation"><br/><br/>
        <input type="submit" value="Meeting" name="meeting"><br/><br/>
        <input type="textarea" value=" " name="note">
        <input type="submit" value="submit" name="submit"><br/><br/>
        
        <?php
        $appointmenttype = "hello";
        
        if(isset($_POST["evaluation"]))
        {
            $appointmenttype = "evaluation";
            $staff_appointment = "SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
        tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id WHERE appointment_type = 'EVALUATION OF GRADES'";

        $result = mysqli_query($conn, $staff_appointment);
        if($result==TRUE) {
            $count = mysqli_num_rows($result);
            if($count > 0) {
                while($rows = mysqli_fetch_assoc($result)) {

                    ?>
                        <input type="radio" name="staff_name" id="registry" value="<?php echo $rows['first_name']." ". $rows['last_name']; ?>">
                        <label for="registry"><?php echo $rows['first_name']." ". $rows['last_name'];?></label>
                    <?php
                    }
                }
            }

        }
        if(isset($_POST["meeting"]))
        {
            $appointmenttype = "meeting";
            $staff_appointment = "SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON
        tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id WHERE appointment_type = 'MEETING'";

        $result = mysqli_query($conn, $staff_appointment);
        if($result==TRUE) {
            $count = mysqli_num_rows($result);
            if($count > 0) {
                while($rows = mysqli_fetch_assoc($result)) {

                    ?>
                        <input type="radio" name="staff_name" id="registry" value="<?php echo $rows['first_name']." ". $rows['last_name']; ?>">
                        <label for="registry"><?php echo $rows['first_name']." ". $rows['last_name']; ?></label>
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
            $staff = "SELECT staff_id FROM tbl_staff_registry WHERE first_name = '$first_name' AND last_name = '$last_name'";

            $staff_id= $staff;
    
            $note = $_POST['note'];  
            date_default_timezone_set('Asia/Manila');                           		
            $currentdate = date("Y-m-d");
    
            // Check connection
            if($conn === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
    }
     
            // Attempt insert query execution
            $studentappointment = "INSERT INTO tbl_appointment (`date_created`,`student_id`, `staff_id`, `appointment_type`, `note`, `status`) 
            VALUES ('$currentdate', '$student_id', 'IDNUMBER1', '$appointmenttype', '$note', 'pending')";
            if(mysqli_query($conn, $studentappointment)){
                echo "Records inserted successfully.";
            } else{
                echo "ERROR: Could not able to execute $studentappointment. " . mysqli_error($conn);
            }
    
    
    
    
            // Close connection
            mysqli_close($conn);


        }
        ?>

    </form>

  



</body>
</html>