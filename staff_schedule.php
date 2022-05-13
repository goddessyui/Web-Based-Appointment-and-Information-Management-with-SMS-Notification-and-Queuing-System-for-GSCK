<?php
include("header.php");
?>
<style>
body {
      background: #EFF0F4;
    }

    main {
       background: #EFF0F4;
       padding: 15px;
    }
.pagination {
    display: flex;
    padding: 0 15px;
    margin-bottom: 40px;
  }
  .pagination li {
    padding: 5px;
    background: #444;
    margin-right: 5px;
  }

  .pagination a {
    color: #eee;
    font-family: 'Roboto';
    font-size: 12px;
    text-transform: uppercase;
  }
.sched_date {
    background-color: #fff;
    padding: 20px;
    color: #333;
    font-family: 'Roboto';
    margin: 0;
    margin-bottom: 5px;
    font-size: 15px;
}
.sched_name {
    background-color: #324E9E;
    padding: 20px;
    color: #fff;
    font-family: 'Roboto';
    margin: 0;
    margin-bottom: 10px;
    font-size: 15px;
}  

.parent-div{
        padding-top: 80px;
        margin-left: 10%;
        margin-right: 20%;
    }
</style>
<div class="parent-div">
<div><h2>Staff Schedules</h2> <select onchange="location = this.value;">
<option value="schedules.php">All</option>
<?php
                $sql = "SELECT
                tbl_staff_registry.first_name,
                tbl_staff_registry.last_name
                FROM
                tbl_staff_registry
                ";
                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...
                        $name = $row['first_name'].' '.$row['last_name'];
                ?>
                <option value="staff_schedule.php?name=<?php echo $row['first_name'],' ',$row['last_name'];?>" 
                <?php echo $_GET['name']==$name?'selected':'';?>><?php echo $row['first_name'],' ',$row['last_name'];?></option>
                                          
                <?php

                    }
                }

                ?>

</select>  </div>
<br>
<div class="sched_name">
<h2><?php echo $_GET['name']?></h2>
<h4>Present at School:</h4>
</div>
<?php
$fname = $_GET['name'];
//-----------For pagination-------------//
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 15;
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM tbl_schedule WHERE title='".$_GET['name']."' AND date>= CURDATE()";
$theresult = mysqli_query($db, $total_pages_sql);
$total_rows = mysqli_fetch_array($theresult)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
//-----------For pagination-------------//
$sql = "SELECT
                tbl_schedule.date
                FROM
                tbl_schedule 
                WHERE title='".$_GET['name']."' AND date>= CURDATE() ORDER BY date ASC LIMIT $offset, $no_of_records_per_page";
                $res = mysqli_query($db, $sql);
                
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...
                ?>
                
                <div class="sched_date"><?php echo date("l, F d, Y", strtotime($row['date'])); ?></div>
                                    
                <?php

                    }
                }

                ?>
<div class="row">
            <!--------Pagination---------------------------------------------->
            <ul class="pagination">
                <li><a href="?name=<?php echo $fname?>&&pageno=1">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?name=".$fname."&&pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?name=".$fname."&&pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <li><a href="?name=<?php echo $fname?>&&pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
            <!--------Pagination---------------------------------------------->

        </div>


</div>

