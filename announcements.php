<?php
include("header.php");
?>
<div class="parent-div">
<div><h1>Announcement</h1></div>
<?php
//-----------For pagination-------------//
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM tbl_announcement ORDER BY date_created DESC";
$theresult = mysqli_query($db, $total_pages_sql);
$total_rows = mysqli_fetch_array($theresult)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
//-----------For pagination-------------//


                $sql = "SELECT
                tbl_announcement.announcement_id,
                tbl_announcement.staff_id,
                tbl_announcement.announcement_title,
                tbl_announcement.caption,
                tbl_announcement.image,
                tbl_announcement.date_created,
                tbl_announcement.video_url,
                `name`
                FROM
                tbl_announcement
                ORDER BY date_created DESC
                LIMIT $offset, $no_of_records_per_page";

                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...

                ?>
                <div class="center">
                <span class="fa fa-user"></span><small><?php echo $row['name'] ?></small>
                <div><small><?php echo date("F d, Y", strtotime($row['date_created'])) ?></small></div>
                <div class="center_ann"><h3><?php echo $row['announcement_title'] ?></h3></div>
                <div class="center_ann"><pre><?php echo $row['caption'] ?></pre></div>
                <div class="center_ann"><?php echo !empty($row['image'])?'<img class="imgs" src="announcement_image/' . $row['image'] . '" alt="#">':''; ?>            </div>
                <div class="center_ann"><?php echo !empty($row['video_url'])?'<iframe src="'.$row['video_url'].'"  width="500" height="265" frameborder="0" allowfullscreen></iframe>':''; ?> </div>    
                </div>
                                      
                                        

                <?php

                    }
                }
                ?>
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
</body>
</html>
<style>
.center {
  margin: auto;
  width: 50%;
  border: 1px solid #000000;
  padding: 10px;
}
.parent-div{
        padding-top: 150px;
        margin-left: 15%;
        margin-right: 15%;
    }

</style>