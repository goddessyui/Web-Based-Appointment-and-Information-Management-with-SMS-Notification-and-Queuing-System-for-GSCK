<?php

include("dbconfig.php");
session_start();

$alphabetical_ln_ug = $_POST['alphabetical_ln_ug'];
$batchstatus_ug = $_POST['batchstatus_ug'];



?>


<?php

$unifast_grantee="SELECT * FROM tbl_unifast_grantee WHERE last_name LIKE $alphabetical_ln_ug 
AND batch_status = $batchstatus_ug 
ORDER BY last_name ASC, first_name ASC";
$ug_result = mysqli_query($db, $unifast_grantee);

//check whether the query is executed or not
if($ug_result==TRUE) { // count rows to check whether we have data in database or not
    $count = mysqli_num_rows($ug_result);
    //check the num of rows                 
    if($count>0) { //we have data in database
        $i = 1;
        ?>
        <div class="row_container">
            <div class="row_student">
               
                <div class="regstudent_row"><b>S.N.</b></div>
                <div class="regstudent_row"><b>Last Name</b></div>
                <div class="regstudent_row"><b>First Name</b></div>
                <div class="regstudent_row"><b>Student ID No.</b></div>
                <div class="regstudent_row"><b>Batch Status</b></div>
                
            </div>
            
               
        <?php
        while($rows=mysqli_fetch_assoc($ug_result)) {
?>
            <div class="row_student_list">
                    <div class="regstudent_row">
                        <?php   
                                echo $i++; 
                        ?>
                    </div>
                        
                    <div class="regstudent_row">
                        <?php echo $rows['last_name']; ?>
                    </div class="ug_row">

                    <div class="regstudent_row">
                        <?php echo $rows['first_name']; ?>
                    </div>
                    
                    <div class="regstudent_row">
                        <?php echo $rows['student_id']; ?>
                    </div>

                    <div class="regstudent_row">
                        <?php echo $rows['batch_status'];?>
                    </div>
            </div>
<?php 
        }
    } 
    else{
        echo "No result.";
    }
}  
?>
    </div>

</div>
<style>
    .row_container {
        margin-top: 40px;
        width: 100%;
    }
    .row_container .row_student,
    .row_container .row_student_list {
        display: flex;
        width: 100%;
        padding: 5px;
    }
    .row_student {
        font-family: 'Roboto';
        font-weight: 500;
        margin-bottom: 15px;
    }
    .regstudent_row {
        width: 25%;
    }
    .row_student_list .regstudent_row {
        font-family: 'Roboto';
        font-size: 13px;
        padding: 5px 0;
        color: #333;
    }
    .row_student_list:nth-child(even) {
        background: #0001;
    }

</style>