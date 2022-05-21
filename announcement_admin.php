<!-- MAIN INDEX OF ANNOUNCEMENT FOR ADMIN -->
<?php
include("new_header_admin.php"); 
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
if ($staff_id == "" || $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="index.php"</script>';
}


//-----------For pagination-------------//
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages_sql = isset($_GET['all'])?"SELECT COUNT(*) FROM tbl_announcement WHERE staff_id='".$staff_id."' ORDER BY date_created DESC":"SELECT COUNT(*) FROM tbl_announcement ORDER BY date_created DESC";
$theresult = mysqli_query($db, $total_pages_sql);
$total_rows = mysqli_fetch_array($theresult)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
//-----------For pagination-------------//
?>



<main>
  
<div class="announcement_header">

  <div class="flex_2">
    <h2>Announcement</h2>

    <div class="select_div">
      <?php 
        if (!isset($_GET['ann'])) { ?>
          <select onchange="location = this.value;">
            <option value="?"  <?php echo !isset($_GET['all'])?'selected':'';?>>All</option>
            <option value="?all=no"  <?php echo isset($_GET['all'])?'selected':'';?>>Your Post</option>
          </select>
          <?php 
        }
      ?>
    </div>
  </div>   

  <?php 
    if (isset($_GET['ann'])) { ?>
      <a href="announcement_admin.php"><button type="button">View all</button></a>
      <?php 
    }
  ?>

    <div class="add_announcement_btn">
        <button type="button" id="add_announcement">Add announcement</button>
    </div>            
</div>


      <?php
        if (isset($_GET['ann'])) {
          $ann = $_GET["ann"];
          $sql = "SELECT tbl_staff_registry.position, tbl_announcement.announcement_id, tbl_announcement.staff_id, tbl_announcement.announcement_title, 
            tbl_announcement.caption, tbl_announcement.image, tbl_announcement.date_created, tbl_announcement.video_url, tbl_announcement.name  
            FROM tbl_announcement INNER JOIN tbl_staff_registry ON tbl_announcement.staff_id = tbl_staff_registry.staff_id
            WHERE tbl_announcement.announcement_id = '$ann' ORDER BY tbl_announcement.date_created DESC"; 
        }

        else if (isset($_GET['all'])) {
          $sql = "SELECT tbl_staff_registry.position, tbl_announcement.announcement_id, tbl_announcement.staff_id, tbl_announcement.announcement_title,
            tbl_announcement.caption, tbl_announcement.image, tbl_announcement.date_created, tbl_announcement.video_url, tbl_announcement.name     
            FROM tbl_announcement INNER JOIN tbl_staff_registry ON tbl_announcement.staff_id = tbl_staff_registry.staff_id
            WHERE tbl_announcement.staff_id='$staff_id'
            ORDER BY tbl_announcement.date_created DESC LIMIT $offset, $no_of_records_per_page"; 
        } 

        else {
          $sql = "SELECT tbl_staff_registry.position, tbl_announcement.announcement_id, tbl_announcement.staff_id, tbl_announcement.announcement_title,
            tbl_announcement.caption, tbl_announcement.image, tbl_announcement.date_created, tbl_announcement.video_url, tbl_announcement.name    
            FROM tbl_announcement INNER JOIN tbl_staff_registry ON tbl_announcement.staff_id = tbl_staff_registry.staff_id 
            ORDER BY tbl_announcement.date_created DESC LIMIT $offset, $no_of_records_per_page"; }

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


            <div>  
              <!-- check if post is made by staff remove delete and edit button if not -->
              <?php 
              if ($staff_id==$row['staff_id']) { ?>

                <!-- display this check if posted with an image -->
                <?php if (!empty($row['image'])){ ?>
                  <button onclick="update_image(this)" 
                  data-value="<?php echo $row['announcement_id']; ?>"
                  data-value2="<?php echo $row['announcement_title']; ?>" 
                  data-value3="<?php echo $row['image']; ?>"  
                  value="<?php echo $row['caption']; ?>" 
                  class="editModal">Edit</button>

                <!-- display this check if posted with video url -->
                <?php } else if (!empty($row['video_url'])){ ?>
                  <button onclick="update_video(this)" 
                  data-value="<?php echo $row['announcement_id']; ?>"
                  data-value2="<?php echo $row['announcement_title']; ?>" 
                  data-value3="<?php echo $row['video_url']; ?>"  
                  value="<?php echo $row['caption']; ?>" 
                  class="editModal">Edit</button>
              
                  <!-- display this if post dont have both image and video -->
                <?php } else { ?>
                  <button onclick="update(this)" 
                  data-value="<?php echo $row['announcement_id']; ?>"
                  data-value2="<?php echo $row['announcement_title']; ?>"   
                  value="<?php echo $row['caption']; ?>" 
                  class="editModal">Edit</button>  
                <?php } ?>

                  <button class="addModal" onclick="del(this);" value="<?php echo $row['announcement_id']; ?>">Delete</button>
                <?php 
              } ?>
              
            </div> 

          </div>
          <?php 
        } 
        ?>
        </div>







                  <!--------Pagination---------------------------------------------->
        <ul class="pagination">
            <li><a href="<?php echo isset($_GET['all'])?"?all=no&pageno=1":"?pageno=1"; ?>">First</a></li>
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo isset($_GET['all'])?"?all=no&pageno=".($pageno - 1):"?pageno=".($pageno - 1); } ?>">Prev</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo isset($_GET['all'])?"?all=no&pageno=".($pageno + 1):"?pageno=".($pageno + 1); } ?>">Next</a>
            </li>
            <li><a href="<?php echo isset($_GET['all'])?"?all=no&pageno=".$total_pages:"?pageno=".$total_pages; ?>">Last</a></li>
        </ul>
        <!--------Pagination---------------------------------------------->    

        <?php 
      } 
      else { ?>
        <h1>NO ANNOUNCEMENT FOUND</h1>
        <h5>
          <?php 
            echo isset($_GET["ann"])?"UPLOADER MUST HAVE DELETED THE ANNOUNCEMENT":"";
          ?>
        </h5>
        <?php 
      } ?>                    
  
</main>

    <!-- delete announcement modal -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">

        <div>
          <div id="mess_delete"></div>
        </div>
        
        <div>
          <p>
            Do you really want to delete?
          </p>
        </div>

        <div>
          <form method="POST" id="form_delete">
            <button class="delete" type="submit" id= "delete" name="button_delete_announcement">Confirm</button>
            <button class="close1">Cancel</button>
          </form>
        </div>

      </div>
    </div>

    <!-- add announcement modal -->
    <div id="modal_add" class="addmodal">
      <!-- Modal content -->
      <div class="addmodal-content">
        <div>
          <?php include("announcement_add.php"); ?>    
        </div>
      </div>
    </div>

    <!-- edit announcement modal -->
    <div id="modal_edit" class="editmodal">
      <!-- Modal content -->

      <div class="editmodal-content">
        
        <div>
          <?php include("Staff/announcement/announcement_edit.php"); ?>  
        </div>
      </div>
    </div>


    </div>
</div>

<div class="mobile_header"></div>

</body>
</html>


<?php
    if (isset($_POST['button_delete_announcement'])) {
      $id = $_POST['button_delete_announcement'];
      $query = mysqli_query($db, "SELECT tbl_announcement.image FROM tbl_announcement WHERE announcement_id='{$id}' AND staff_id = '{$staff_id}'");
        if (mysqli_num_rows($query) == 1){
          $row = $query->fetch_assoc();
          $filename = "announcement_image/" . $row['image'];
            if (file_exists($filename)) {
              unlink($filename);
	            $stmt = $db->prepare("DELETE FROM tbl_announcement WHERE announcement_id = '{$id}'");
	              if ($stmt->execute()) {
	                echo 
                  //  not finish
                  '<script>$("#mess_delete").html("Deleted Successfully!");
                    $("#form_delete :input").prop("disabled", true);  
                    setInterval(function() { window.location.href="announcement_admin.php"; }, 500);
                    </script>';
                } 
                else {
                  echo '<script>$("#mess_delete"").html("An Error occured, please reload the page!");</script>';
                }
            }
            else {
              echo '<script>$("#mess_delete"").html("Delete Unsuccessful!");</script>';
            }
        }
        else {
          echo '<script>$("#mess_delete"").html("Delete Unsuccessful!");</script>';
        }   
    }

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




<script>
 
//  get modal edit
var editmodal = document.getElementById("modal_edit");


  // if user click the edit button that have image, open the modal 
  function update_image(data) {
    document.getElementById("edit_video_link").disabled = true;
    document.getElementById("edit_check").disabled = true;
    document.getElementById("edit_id").value = data.getAttribute('data-value');
    document.getElementById("edit_title").value = data.getAttribute('data-value2');
    document.getElementById("edit_caption").value = data.value;
    $("#edit_videoObject").hide();
    $("#edit_removeurl").hide();
    $('#edit_output').attr('src', 'announcement_image/'+data.getAttribute('data-value3'));
    editmodal.style.display = "block";
  }

  // if user click the edit button that have video, open the modal 
  function update_video(data) {
    document.getElementById("edit_imgInp").disabled = true;
    document.getElementById("edit_id").value = data.getAttribute('data-value');
    document.getElementById("edit_title").value = data.getAttribute('data-value2');
    document.getElementById("edit_caption").value = data.value;
    document.getElementById("edit_video_link").value = data.getAttribute('data-value3');
    $('#edit_videoObject').attr('src', data.getAttribute('data-value3'));
    $("#edit_output").hide();
    $("#edit_remove_btn").hide();
    editmodal.style.display = "block";
  }

  // if user click the edit button that dont have both image and video, open the modal 
  function update(data) {
    $("#edit_output").hide();
    $("#edit_remove_btn").hide();
    $("#edit_videoObject").hide();
    $("#edit_removeurl").hide();
    document.getElementById("edit_id").value = data.getAttribute('data-value');
    document.getElementById("edit_title").value = data.getAttribute('data-value2');
    document.getElementById("edit_caption").value = data.value;
    editmodal.style.display = "block";
  }



// Get the modal
var addmodal = document.getElementById("modal_add");
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var add = document.getElementById("add_announcement");

// Get the <span> element that closes the modal
var close = document.getElementsByClassName("close1")[0];

// When the user clicks the delete button, open the modal 
function del(id) {
    $('#href').attr('href', 'Staff/announcement/announcement_delete.php?del='+id.value);
    $('#delete').attr('value', id.value);
    modal.style.display = "block";
}

// When the user clicks the add announcement button, open the modal 
add.onclick = function() {
    addmodal.style.display = "block";
}

// When the user clicks on cancel button, close the modal
close.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == addmodal) {
    location.href = "announcement_admin.php"; 
  }
  if (event.target == editmodal) {
    location.href = "announcement_admin.php"; 
  }
}
</script>