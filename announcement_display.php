<style>
.center {
  margin: auto;
  width: 50%;
  border: 1px solid #000000;
  padding: 10px;
  
}

</style>
<?php
                $sql = "SELECT
                tbl_announcement.announcement_id,
                tbl_announcement.staff_id,
                tbl_announcement.announcement_title,
                tbl_announcement.caption,
                tbl_announcement.image,
                tbl_announcement.date_created
                FROM
                tbl_announcement
                ORDER BY date_created DESC";

                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...

                ?>
                <div class="center">

                <div class="center_ann"><h3><?php echo $row['announcement_title'] ?></h3><?php echo $row['date_created'] ?></div>
                <div class="center_ann"><pre><?php echo $row['caption'] ?></pre></div>
                <div class="center_ann"><?php echo !empty($row['image'])?'<img class="imgs" src="announcement_image/' . $row['image'] . '" alt="#">':''; ?>            </div>
                        
                </div>
                                      
                                        

                <?php

                    }
                }

                ?>