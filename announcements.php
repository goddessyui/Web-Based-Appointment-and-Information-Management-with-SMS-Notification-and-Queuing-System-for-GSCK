<!-- MAIN INDEX OF ANNOUNCEMENT FOR ADMIN -->
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
       tbl_staff_registry.position,
       tbl_announcement.announcement_id,
       tbl_announcement.staff_id,
       tbl_announcement.announcement_title,
       tbl_announcement.caption,
       tbl_announcement.image,
       tbl_announcement.date_created,
       tbl_announcement.video_url,
       tbl_announcement.name
       FROM tbl_announcement 
       INNER JOIN tbl_staff_registry ON tbl_announcement.staff_id = tbl_staff_registry.staff_id
       ORDER BY tbl_announcement.date_created DESC
       LIMIT $offset, $no_of_records_per_page";

      $res = mysqli_query($db, $sql);

      ?><div class="announcement_container"><?php

      if (mysqli_num_rows($res) > 0) {
       
        while ($row = mysqli_fetch_assoc($res)) 
        { 
          ?>
          
          <div class="blog_img_box">

          <div class="announce_header">

            
              <div class="name_date">
                <p>
                  <?php echo $row['name'].", <span class='admin_position'>". $row['position']; ?> </span>
                </p>

                <p>
                  <span class="posted_on">posted on</span>
                    <?php 
                      echo date("F d Y, g:i a", strtotime($row['date_created'])) 
                    ?>
                </p>
              </div>


            <div class="title_caption">
                <h3>
                  <?php 
                    echo $row['announcement_title']; 
                  ?>
                </h3>
      
                <p>
                  <?php 
                    echo $row['caption']; 
                  ?>
                </p>
              </div>

            </div>

            <?php 
              echo !empty($row['image'])?'<img src="announcement_image/' . $row['image'] . '" alt="#">':''; 
            ?>
            <?php 
              echo !empty($row['video_url'])?'<iframe src="'.$row['video_url'].'" frameborder="0" allowfullscreen></iframe>':''; 
            ?>             



          </div>
          <?php 
        } 
        ?>
        </div>

        <?php 
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
                          
  
</main>


    </div>
</div>

<div class="mobile_header"></div>

</body>
</html>


<?php
 
include("backtotop.php");
?>
<style>

    body {
      background: #EFF0F4;
    }

    main {
       background: #EFF0F4;
       padding: 15px;
    }
  

    .modal,
    .addmodal,
    .editmodal  {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 20vw;
        top: 10vh;
        width: 80vw; /* Full width */
        height: 100vh; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background: #0008;
    }
    .modal p {
      margin-bottom: 20px;
    }
 

    /* Delete Modal Content */ 
    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 30px;
        border: 1px solid #888;
        width: 30%;
        position: relative;
        top: 40%;
        transform: translateY(-40%);
    }

    /* add and edit modal Content */
    .addmodal-content,
    .editmodal-content {
        background-color: #fff;
        margin: auto;
        padding: 30px;
        border: 1px solid #888;
        max-width: 50%;
        position: relative;
        top: 40%;
        transform: translateY(-40%);
    }


    /* The Close Button */
    .close1 {
        color: #eee;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        height: 28px;
        width: 120px;
        background: #2D303A;
        text-transform: capitalize;
    }
    .delete {
        background-color: #EC3237;
        color: #eee;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        margin-right: 10px;
        height: 28px;
        width: 120px;
        text-transform: capitalize;
    }

    .delete:hover,
    .delete:focus {
        background: #FF0000;
    }
    .close1:hover,
    .close1:focus {
      background: #424F59;
    }






  main .announcement_header {
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px;
    margin-bottom: 15px;
  }

  main .announcement_header .add_announcement_btn button{
    padding: 0 20px;
    height: 28px;
    border: none;
    background: #2F729E;
    color: #eee;
    cursor: pointer;
  }

  main .announcement_header .flex_2 {
    display: flex;
    width: 50%;
    border: 1px solid white;
    align-items: center;
  }
  main .announcement_header .flex_2 h2{
    color: #333;
    margin-right: 20px;
    font-size: 16px;
  }
  main .announcement_header .flex_2 select {
    height: 28px;
    border: 1px solid lightgrey;
    padding: 0 5px;
  }


  .announcement_container {
    background-color: #EFF0F4;
  }
  .announcement_container .blog_img_box {
    background: #fff;
    padding: 15px;
    margin-bottom: 15px;
    border-bottom: 1px solid lightgrey;
  }


    .blog_img_box .announce_header .title_caption {
      background: none;
    }
          .title_caption h3 {
            color: #333;
            text-transform: capitalize;
            margin: 0;
            margin-bottom: 5px;
            font-size: 16px;
          }
          .title_caption p {
            font-size: 16px;
            width: 500px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 500;
          }

    .blog_img_box .announce_header .name_date {
      background: none;
      margin-bottom: 20px;
    }
          .name_date p:nth-child(1) {
            color: #444;
            margin-right: 10px;
            font-size: 16px;
            font-weight: bold;
          }
          .name_date p:nth-child(2) {
            color: #444;
            font-size: 14px;
          }
          .posted_on {
            text-transform: lowercase;
            margin-right: 10px;
            font-weight: 500;
            color: #333;
          }



          

  .announcement_container .blog_img_box img,
  .announcement_container .blog_img_box iframe {
    width: 100%;
    margin-top: 15px;
    margin-bottom: 15px;
    min-height: 400px;
  }

  .blog_img_box .editModal {
    background: #2F729E;
    color: #eee;
    border: none;
    width: 120px;
    height: 28px;
    cursor: pointer;
    margin-right: 10px;
  }
  .blog_img_box .addModal {
    background: #ec3237;
    color: #eee;
    border: none;
    width: 120px;
    height: 28px;
    cursor: pointer;
  }

  .pagination {
    display: flex;
    padding: 0 15px;
    margin-bottom: 40px;
  }
  .pagination li {
    padding: 2px 10px;
    padding-bottom: 5px;
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

  .admin_position {
    font-size: 14px;
    font-weight: 500;
  }

</style>

