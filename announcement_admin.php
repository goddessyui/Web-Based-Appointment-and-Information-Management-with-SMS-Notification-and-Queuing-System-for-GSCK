<!-- MAIN INDEX OF ANNOUNCEMENT FOR ADMIN -->
<?php
include("admin_header.php"); 
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
  <div class="container">
  <h2>Announcement</h2>
    <?php if (!isset($_GET['ann'])){ ?>
      <select onchange="location = this.value;">
        <option value="?"  <?php echo !isset($_GET['all'])?'selected':'';?>>All</option>
        <option value="?all=no"  <?php echo isset($_GET['all'])?'selected':'';?>>Your Post</option>
      </select>
    <?php } ?>
      
    <?php if (isset($_GET['ann'])){ ?>
      <a href="announcement_admin.php"><button type="button">View all</button></a>
    <?php } ?>   

      <button type="button" id="add_announcement">Add announcement</button>            
    
    <?php
      if (isset($_GET['ann'])){
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
        WHERE announcement_id = '".$_GET["ann"]."'
        ORDER BY date_created DESC"; }
     
      else if (isset($_GET['all'])){
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
        WHERE staff_id='".$staff_id."'
        ORDER BY date_created DESC
        LIMIT $offset, $no_of_records_per_page"; } 

      else {
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
        LIMIT $offset, $no_of_records_per_page"; }

          $res = mysqli_query($db, $sql);
          if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { ?>
              
              <div class="blog_img_box">
              <span class="fa fa-user"></span><small><?php echo $row['name'] ?></small>
                <div><small><?php echo date("F d, Y, g:i a", strtotime($row['date_created'])) ?></small></div>
                <div><h3><?php echo $row['announcement_title'] ?></h3></div>
                <div><pre><?php echo $row['caption'] ?></pre></div>
                    <div>
                      <?php echo !empty($row['image'])?'<img src="announcement_image/' . $row['image'] . '" alt="#">':''; ?>
                      <?php echo !empty($row['video_url'])?'<iframe src="'.$row['video_url'].'"  width="500" height="265" frameborder="0" allowfullscreen></iframe>':''; ?>             
                    </div> 

                  <div>  
                    <!-- check if post is made by staff remove delete and edit button if not -->
                    <?php if ($staff_id==$row['staff_id']){?>

                      <!-- display this check if posted with an image -->
                      <?php if (!empty($row['image'])){ ?>
                        <button onclick="update_image(this)" 
                        data-value="<?php echo $row['announcement_id']; ?>"
                        data-value2="<?php echo $row['announcement_title']; ?>" 
                        data-value3="<?php echo $row['image']; ?>"  
                        value="<?php echo $row['caption']; ?>" 
                        class="">Edit</button>

                      <!-- display this check if posted with video url -->
                      <?php } else if (!empty($row['video_url'])){ ?>
                        <button onclick="update_video(this)" 
                        data-value="<?php echo $row['announcement_id']; ?>"
                        data-value2="<?php echo $row['announcement_title']; ?>" 
                        data-value3="<?php echo $row['video_url']; ?>"  
                        value="<?php echo $row['caption']; ?>" 
                        class="">Edit</button>
                    
                        <!-- display this if post dont have both image and video -->
                      <?php } else { ?>
                        <button onclick="update(this)" 
                        data-value="<?php echo $row['announcement_id']; ?>"
                        data-value2="<?php echo $row['announcement_title']; ?>"   
                        value="<?php echo $row['caption']; ?>" 
                        class="">Edit</button>  
                      <?php } ?>

                        <button class="addModal" onclick="del(this);" value="<?php echo $row['announcement_id']; ?>" style="background-color: #f44336">Delete</button>
                    <?php } ?>
                    
                  </div> 

            <?php } ?>


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

          <?php } else { ?>
                <h1>NO ANNOUNCEMENT FOUND</h1>
                <h5><?php echo isset($_GET["ann"])?"UPLOADER MUST HAVE DELETED THE ANNOUNCEMENT":""; ?></h5>
          <?php } ?>                    
  </div>
</main>

    <!-- delete announcement modal -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <div>
          <div id="mess_delete" style="color:red;"></div>
        </div>
        <div> <p>Do you really want to delete?</p></div>
        <div>
          <form method="POST" id="form_delete">
          <button class="delete" type="submit" id= "delete" name="button_delete_announcement">DELETE</button>
          <button class="close1">CANCEL</button>
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
    main .container {
      background: pink;
      padding: 0 15px;
    }

    .modal,
    .addmodal,
    .editmodal  {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        margin-left: 5%;
        margin-right: 5%; 
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

 

    /* Delete Modal Content */ 
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
    }

    /* add and edit modal Content */
    .addmodal-content,
    .editmodal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
    }


    /* The Close Button */
    .close1 {
        color: #1E90FF;
        border: none;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    .delete {
        background-color: #FF0000;
        color: white;
        border: none;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .close1:hover,
    .close1:focus,
    .delete:hover,
    .delete:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
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