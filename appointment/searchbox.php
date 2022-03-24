<?php 
    include_once("../dbconfig.php");
    // Student Session
    session_start();
    $student_id = $_SESSION["student_id"];
    $username1 = $_SESSION["student_username"];
    $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
    $row = $query->fetch_assoc();
    if ($student_id == "" && $username1 == ""){
        echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());

        $(this).parent(".result").empty();

    });
});

</script>


<body>
    
    <form name="form1" method="get" action=" ">
    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search name..." name="search" value="" required>
        <div class="result"></div>
    </div>
    <div>
        <input type="submit" value="Find" name="submit">
    </div>
    </form>


<?php

 if(isset($_GET['submit'])){
    $button = $_GET['submit'];
    $name = explode(" ", $_GET['search']);
    $search = $name[0];
    $search2 = end($name);

    $sql="SELECT * FROM tbl_staff_registry INNER JOIN tbl_staff_appointment 
    ON tbl_staff_registry.staff_id = tbl_staff_appointment.staff_id 
    WHERE tbl_staff_registry.last_name = '$search2' AND tbl_staff_registry.first_name LIKE '".$search."%'";
    $run= mysqli_query($db, $sql);
    
    if($run==TRUE) {
        $foundnum = mysqli_num_rows($run);
        if($foundnum > 0) { 
    ?>
                <form action="student_insert_appointment.php" method="post">
    <?php
            while($rows = mysqli_fetch_assoc($run)) { 
                
    ?>  
                <input type="submit" name="appointment_type" required value="<?php echo $rows['appointment_type'];?>">
                <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">  
                
    <?php     
            }

        }

    }
    ?>
                        <br><br>
                        <h4>Note to Staff (Optional):</h4>
                        <small>You can specify an appointment or add additional appointment requests for the same staff here. <br>
                        Please keep your message brief and relevant. <br> (For example: "Verification of Grades", "Request for TOR.")</small><br><br>
                        <textarea name="note"></textarea>
                        <input type="hidden" name="at" value="<?php echo $appointment_type;?>">
                        <br><br>
                        <input type="submit" name="request" value="Request Appointment">
                       
                    </form><br><br>

    <?php        
    mysqli_close($db);
 }

?>

















</body>
</html>
