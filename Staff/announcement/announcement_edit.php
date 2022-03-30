<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" || $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
}

$ann_id = $_SESSION['announcement_id'];
$query = mysqli_query($db, "SELECT * FROM tbl_announcement WHERE announcement_id='{$ann_id}'");
$row = $query->fetch_assoc();

?>




<script>
        window.onload = hideIt;
    function hideIt(){
    var image = $('#output').attr('src')
    var links = $('#videoObject').attr('src')  
    if (links == undefined || links == ''){
     $("#videoObject").hide();
    }
    else{
        document.getElementById("imgInp").disabled = true;
    }
    if (image == undefined || image == ''){
    $("#output").hide();
    }
    else{
        document.getElementById("video_link").disabled = true;
    }
        }
</script>

    <h1>Edit Announcement</h1>
   
           
                    <form class="user" method="POST" enctype="multipart/form-data">
                        
                                <div>
                                    <input name="edit_id" id="edit_id" type="hidden" class="form-control" value="">

                                    <label>Title:</label>
                                    <input name="edit_title" type="text" class="form-control" value="<?php echo $row["announcement_title"]?>"  required>
                                </div>
                          
                        
                                <div>
                                    <label>Caption:</label>
                                    <textarea name="edit_caption" type="text" class="form-control" required><?php echo $row["caption"]?></textarea>
                                </div>
                                <div>    
                                    <label>Video Link(can only accept youtube video link):</label>
                                    <input name="video_link" id="video_link" type="text" value=<?php echo $row['video_url']?> >
                                    <button id="check" type="button" onclick="myFunction()">Validate</button>           
                                </div>
                                <div> 
                                    <iframe id="videoObject" type="text/html" <?php echo !empty($row['video_url'])?'src='.$row['video_url']:''?> width="500" height="265" frameborder="0" allowfullscreen></iframe>
                                </div>
                                <div>
                                    <label>Photo:</label>
                                    <input type="file" name="image" accept="image/*" id="imgInp" onchange="loadFile(event)"/>
                                    <button type="button" id='remove_btn' onclick="Remove()" <?php echo empty($row['image'])?'disabled':''?>>Remove Image</button>   
                                </div>

                                <div>
                                <input type="hidden" id= 'imagevalidate' name="imagevalidator" value="<?php echo !empty($row['image'])?'valid':''?>">
                                    <img id="output" src="<?php echo !empty($row['image'])?'../../announcement_image/'.$row['image']:''?>"/>
                                </div>
                              
                          
             
                <div>
                    <button type="submit" name="button_edit_announcement">Submit</button>
                    <button formnovalidate formaction='cancel.php'>Cancel</button>
                    </form>
                </div>
           

<script>
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        $("#output").show();
      URL.revokeObjectURL(output.src) // free memory
      document.getElementById("video_link").disabled = true;
      document.getElementById("remove_btn").disabled = true;
      $("#imagevalidate").val("valid");
    }
    };
    function myFunction() {
    var url = $('#video_link').val();
    if (url == undefined || url == ''){
    $("#videoObject").hide(); 
            alert('URL Empty');
            document.getElementById("imgInp").disabled = false;
            document.getElementById("add").disabled = false;
            // Do anything for Empty URL
}

    else {        
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[2].length == 11) {
            // Do anything for being valid
            // if need to change the url to embed url then use below line 
            $("#videoObject").show();           
            $('#videoObject').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=1&enablejsapi=1');
            document.getElementById("imgInp").disabled = true;
            document.getElementById("add").disabled = false;
        } else {
            $("#videoObject").hide(); 
            alert('not valid');
            document.getElementById("imgInp").disabled = true;
            document.getElementById("add").disabled = true;
            // Do anything for not being valid
        }

}
    } 
    function Remove() {
        $("#imagevalidate").val("");
        document.getElementById("output").src = false;
        document.getElementById("video_link").disabled = false;
    }  
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js">
</script>


<?php
if (isset($_POST['button_edit_announcement'])) {
    $image = !empty($_FILES['image'])?$_FILES['image']['tmp_name']:'';
    $link = !empty($_POST['video_link'])?$_POST['video_link']:'';
    $imagevalidate = $_POST['imagevalidator'];
    
    if(!empty($imagevalidate) && !empty($image) && empty($link)){

        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, image=?, video_url=? where announcement_id=?');
        $stmt->bind_param("sssss", $title, $caption, $img, $links, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $img = basename($_FILES['image']['name']);
        $links = null;  
        $menu_photo = "../../announcement_image/" . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $menu_photo)) {
            $stmt->execute();
            echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="announcement_test.php"</script>';
        } else {
            echo '<script type="text/javascript">alert("Updated Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
        }
    }



    else if(!empty($imagevalidate) && empty($image) && empty($link)){

        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, video_url=? where announcement_id=?');
        $stmt->bind_param("ssss", $title, $caption, $links, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $links = null;  
        if ($stmt->execute()) {
            echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="announcement_test.php"</script>';
        } else {
            echo '<script type="text/javascript">alert("Updated Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
        }
    }




    else if(empty($imagevalidate) && !empty($link)){

        $url = $link;
          $finalUrl = '';
          if(strpos($url, 'youtube.com/') !== false) {
              //it is Youtube video
              $videoId = explode("v=",$url)[1];
              if(strpos($videoId, '&') !== false){
                  $videoId = explode("&",$videoId)[0];
              }
              $finalUrl.='https://www.youtube.com/embed/'.$videoId;
          }else if(strpos($url, 'youtu.be/') !== false){
              //it is Youtube video
              $videoId = explode("youtu.be/",$url)[1];
              if(strpos($videoId, '&') !== false){
                  $videoId = explode("&",$videoId)[0];
              }
              $finalUrl.='https://www.youtube.com/embed/'.$videoId;
          }else{
              echo '<script type="text/javascript">alert("Updated Unsuccessful! Enter valid video URL!");window.location.href="announcement_test.php"</script>';
          }
          

          $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, video_url=?, image=? where announcement_id=?');
          $stmt->bind_param("sssss", $title, $caption,$links, $img, $ann_id);
          $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $img = null;
          $links = $finalUrl;   
          if ($stmt->execute()) {
              echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="announcement_test.php"</script>';
          } else {
              echo '<script type="text/javascript">alert("Updated Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
          }
      }


      else if(empty($imagevalidate) && empty($link)){
        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, image=?, video_url=? where announcement_id=?');
        $stmt->bind_param("sssss", $title, $caption, $links, $img, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $img = null;
        $links = null; 
        if ($stmt->execute()) {
            echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="announcement_test.php"</script>';
        } else {
            echo '<script type="text/javascript">alert("Updated Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
        }
    }

}

?>

