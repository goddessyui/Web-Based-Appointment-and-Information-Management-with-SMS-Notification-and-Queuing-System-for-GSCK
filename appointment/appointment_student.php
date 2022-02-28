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
    <ul>
        <li>
            <button onclick="Evaluation()">Evaluation</button>
        </li>
        <li>
            <button onclick="Meeting()">Meeting</button>
        </li>
        <li>
            <button onclick="Enrollment()">Enrollment</button>
        </li>
        <li>
            <button onclick="Defense()">Defense</button>
        </li>
        <li>
            <button onclick="RequestForGrades()">Request for Grades</button>
        </li>
    </ul>

    <div id="test"></div>

    <script>
        function Evaluation() {
          document.getElementById('test').innerHTML = "<?php 
            $evaluation = "SELECT * FROM tbl_staff_appointment INNER JOIN tbl_staff_registry ON tbl_staff_appointment.staff_id = tbl_staff_registry.staff_id WHERE appointment_type = 'EVALUATION OF GRADES'";
            $result = mysqli_query($conn, $evaluation);
            if($result==TRUE) 
            {  $count = mysqli_num_rows($result); 
                if($count>0) //we have data in database
                {
            while ($rows=mysqli_fetch_assoc($result)) {
                echo $rows['first_name'];
            }}} ?>";
        }
    </script>

</body>
</html>