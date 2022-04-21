<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include_once("../../dbconfig.php");
 

if(isset($_REQUEST["term"])) {
    // Prepare a select statement
    $sql = "SELECT * FROM tbl_student_record WHERE first_name LIKE ? OR last_name LIKE ?";
    
    if($stmt = mysqli_prepare($db, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_term, $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
        ?>
                <form action="">
        <?php
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    
                    echo "<p student_id='{$row["student_id"]}'>" .$row["last_name"] . ", " . $row["first_name"] . "</p>";?>
                    <?php
                                 
                }
        ?>
        
        
                </form>
        <?php
            } 
            else{
                echo "<p>No matches found.</p>";
            }
        } 
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
    }
    
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($db);
?>