<?php

include("dbconfig.php");
session_start();

$alphabetical_ln_staff = $_POST['alphabetical_ln_staff'];


?>


<?php

$staff="SELECT * FROM tbl_staff_registry WHERE last_name LIKE $alphabetical_ln_staff 
ORDER BY last_name ASC, first_name ASC"; //LIMIT $offset, $no_of_records_per_page is for pagination
$staff_result = mysqli_query($db, $staff);

//check whether the query is executed or not
if($staff_result==TRUE) { // count rows to check whether we have data in database or not
    $count = mysqli_num_rows($staff_result);
    //check the num of rows                 
    if($count>0) { //we have data in database
        $i = 1;
        ?>

        <div class="row_container">
        <div class="row_student">
        
            <div class=" regstudent_row"><b>S.N.</b></div>
            <div class=" regstudent_row"><b>Last Name</b></div>
            <div class=" regstudent_row"><b>First Name</b></div>
            <div class=" regstudent_row"><b>Employee ID No.</b></div>
        
        </div>
           
    <?php
        while($rows=mysqli_fetch_assoc($staff_result)) {
?>
            <div class="row_student_list">
                    <div class=" regstudent_row">
                        <?php   
                            echo $i++; 
                        ?>
                    </div>
                        
                    <div class=" regstudent_row">
                        <?php echo $rows['last_name']; ?>
                    </div class=" regstudent_row">

                    <div class=" regstudent_row">
                        <?php echo $rows['first_name']; ?>
                    </div>
                    
                    <div class=" regstudent_row">
                        <?php echo $rows['staff_id']; ?>
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
        font-family: 'Roboto Serif';
        font-weight: 500;
        margin-bottom: 15px;
    }
    .regstudent_row {
        width: 25%;
    }
    .row_student_list .regstudent_row {
        font-family: 'Roboto Serif';
        font-size: 13px;
        padding: 5px 0;
        color: #333;
    }
    .row_student_list:nth-child(even) {
        background: #0001;
    }

</style>