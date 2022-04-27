<?php

include("dbconfig.php");
session_start();

$alphabetical_ln_staff = $_POST['alphabetical_ln_staff'];



?>


<?php

//-----------For pagination-------------//
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM tbl_staff_registry";
$theresult = mysqli_query($db, $total_pages_sql);
$total_rows = mysqli_fetch_array($theresult)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
//-----------For pagination-------------//
$staff="SELECT * FROM tbl_staff_registry WHERE last_name LIKE $alphabetical_ln_staff 
ORDER BY last_name ASC, first_name ASC 
LIMIT $offset, $no_of_records_per_page"; //LIMIT $offset, $no_of_records_per_page is for pagination
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
                                echo $offset + $i++; 
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

<div class="row">
    <!--------Pagination---------------------------------------------->
    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
    <!--------Pagination---------------------------------------------->
</div>


<style>
    .row .regstaff_row{
        width: 25%;
    }
</style>