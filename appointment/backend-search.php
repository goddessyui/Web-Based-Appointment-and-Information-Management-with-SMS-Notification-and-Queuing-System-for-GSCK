<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include_once("../dbconfig.php");
 

if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM tbl_staff_registry WHERE first_name LIKE ?";
    
    if($stmt = mysqli_prepare($db, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
        ?>
                <form action="" >
        <?php
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" .$row["first_name"] . " " . $row["last_name"] ."</p>";
                
               $first_name= $row["first_name"];
                $sql2 = "SELECT * FROM tbl_staff_registry INNER JOIN tbl_staff_appointment 
                     ON tbl_staff_registry.staff_id = tbl_staff_appointment.staff_id WHERE first_name = '$first_name'";
                     $aaa = mysqli_query($db, $sql2);
                     $count = mysqli_num_rows($aaa); 
                     if($count>0) //we have data in database
                    {
                        while($rows=mysqli_fetch_assoc($aaa)) {
                        echo "<p>" .$rows["appointment_type"]."</p>";
                        }
                    }
                }
        ?>
        
        
                </form>
        <?php
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($db);
?>