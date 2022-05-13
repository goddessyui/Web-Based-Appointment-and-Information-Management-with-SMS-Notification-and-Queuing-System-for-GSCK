<?php
include("header.php");

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
?>

<main>

<div class="announcement_header">
    <div class="flex_2">
        <h2>Announcement</h2>
    </div>
</div> 

<?php
    $sql = "SELECT
    tbl_announcement.announcement_id,
    tbl_announcement.staff_id,
    tbl_announcement.announcement_title,
    tbl_announcement.caption,
    tbl_announcement.image,
    tbl_announcement.date_created,
    tbl_announcement.video_url,
    `name`
    FROM tbl_announcement
    ORDER BY date_created DESC
    LIMIT $offset, $no_of_records_per_page";

    ?>
        <div class="announcement_container">
    <?php
    $res = mysqli_query($db, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { ?>

                <div class="blog_img_box">
                    <div class="announce_header">
                        <div class="title_caption">
                            <h3><?php echo $row['announcement_title'] ?></h3>
                            <p><?php echo $row['caption'] ?></p>
                        </div>

                        <div class="name_date">
                            <p><?php echo $row['name'] ?></p>
                            <p><?php echo date("F d, Y, g:i a", strtotime($row['date_created'])) ?></p>
                        </div>
                    </div>
                        <?php echo !empty($row['image'])?'<img class="imgs" src="announcement_image/' . $row['image'] . '" alt="#">':''; ?>
                        <?php echo !empty($row['video_url'])?'<iframe src="'.$row['video_url'].'"  width="500" height="265" frameborder="0" allowfullscreen></iframe>':''; ?> 
                </div>                
                                        
    <?php   
            }
        }       
    ?>
    </div>
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
               
</main>

<style>

    body {
      background: #EFF0F4;
    }

    main {
        background: #EFF0F4;
        width: 96%;
        margin: 0 auto;
        margin-top: 80px;
    }
    main .announcement_header {
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px;
    margin-bottom: 15px;
  }
  main .announcement_header .flex_2 h2{
    color: #333;
    margin-right: 20px;
    font-size: 20px;
    font-family: 'Roboto';
  }
  .announcement_container {
    background-color: #EFF0F4;
  }
  .announcement_container .blog_img_box {
    background: #fff;
    padding: 15px;
    margin-bottom: 15px;
  }
  .announcement_container .blog_img_box .announce_header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
  }
  .blog_img_box .announce_header .title_caption {
      background: none;
    }
          .title_caption h3 {
            color: #333;
            font-family: 'Roboto';
            margin: 0;
            margin-bottom: 5px;
            font-size: 20px;
          }
          .title_caption p {
            font-size: 14px;
            font-family: 'Roboto Serif';
            width: 500px;
            color: #333;
          }

    .blog_img_box .announce_header .name_date {
      background: none;
    }
          .name_date p:nth-child(1) {
            color: #444;
            margin-bottom: 5px;
            font-family: 'Roboto Serif';
          }
          .name_date p:nth-child(2) {
            color: #444;
            font-size: 13px;
            text-transform: uppercase;
            font-family: 'Roboto Serif';
          }

          .announcement_container .blog_img_box img,
  .announcement_container .blog_img_box iframe {
    width: 100%;
    margin-top: 15px;
    margin-bottom: 15px;
    min-height: 400px;
  }

  .blog_img_box .editModal {
    background: #444;
    color: #eee;
    border: none;
    width: 120px;
    height: 30px;
    text-transform: uppercase;
    font-family: 'Roboto';
  }
  .blog_img_box .addModal {
    background: #ec3237;
    color: #eee;
    border: none;
    width: 120px;
    height: 30px;
    text-transform: uppercase;
    font-family: 'Roboto';
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
    list-style: none;
  }

  .pagination a {
    color: #eee;
    font-family: 'Roboto';
    font-size: 12px;
    text-transform: uppercase;
    text-decoration: none;
  }


</style>