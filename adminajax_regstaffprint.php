<?php

include("dbconfig.php");
session_start();

$alphabetical_ln_staff = $_POST['alphabetical_ln_staff'];
$staff_status = $_POST['staff_status'];


?>


<?php

$staff="SELECT * FROM tbl_staff_registry WHERE last_name LIKE $alphabetical_ln_staff AND `register_status`='1'
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
        
            <div class=" regstudent_row">S.N.</b></div>
            <div class=" regstudent_row">Status</b></div>
            <div class=" regstudent_row">Last Name</b></div>
            <div class=" regstudent_row">First Name</b></div>
            <div class=" regstudent_row">Employee ID No.</b></div>
        
        </div>
           
    <?php
        while($rows=mysqli_fetch_assoc($staff_result)) {

            $check = mysqli_query($db, "SELECT staff_id FROM tbl_staff_record WHERE staff_id='{$rows['staff_id']}'");
	        if (mysqli_num_rows($check) == 1){
                $stat = 'active';
            }
            else {
                $stat = 'inactive';
            }
            if ($staff_status=='all') { 
?>
            <div class="row_student_list">
                    <div class=" regstudent_row">
                        <?php   
                            echo $i++; 
                        ?>
                    </div>
                       
                    <div class=" regstudent_row">
                        <?php echo $stat; ?>
                    </div class=" regstudent_row">

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
            <?php } 

            else if ($staff_status=='active') {  
                if($staff_status==$stat){
                ?>

            <div class="row_student_list">
                    <div class=" regstudent_row">
                        <?php   
                            echo $i++; 
                        ?>
                    </div>
                       
                    <div class=" regstudent_row">
                        <?php echo $stat; ?>
                    </div class=" regstudent_row">

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

                    <?php } }

            else if ($staff_status=='inactive') {  
                if($staff_status==$stat){
                ?>

                <div class="row_student_list">
                    <div class=" regstudent_row">
                        <?php   
                            echo $i++; 
                        ?>
                    </div>
                       
                    <div class=" regstudent_row">
                        <?php echo $stat; ?>
                    </div class=" regstudent_row">

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
            <?php }} ?>
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