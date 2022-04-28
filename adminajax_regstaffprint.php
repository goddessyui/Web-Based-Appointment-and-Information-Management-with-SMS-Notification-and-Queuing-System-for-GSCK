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
        <div class="row">
           
            <div class="regstaff_row"><b>S.N.</b></div>
            <div class="regstaff_row"><b>Last Name</b></div>
            <div class="regstaff_row"><b>First Name</b></div>
            <div class="regstaff_row"><b>Employee ID No.</b></div>
        
        </div>
           
    <?php
        while($rows=mysqli_fetch_assoc($staff_result)) {
?>
            <div class="row">
                    <div class="regstaff_row">
                        <?php   
                            echo $i++; 
                        ?>
                    </div>
                        
                    <div class="regstaff_row">
                        <?php echo $rows['last_name']; ?>
                    </div class="regstaff_row">

                    <div class="regstaff_row">
                        <?php echo $rows['first_name']; ?>
                    </div>
                    
                    <div class="regstaff_row">
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
    .row .regstaff_row{
        width: 25%;
    }
</style>