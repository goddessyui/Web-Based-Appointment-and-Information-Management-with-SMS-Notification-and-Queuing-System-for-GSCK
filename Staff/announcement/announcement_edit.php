<!-- EDIT ANNOUNCEMENT -->
<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';


$ann_id = $_GET['edit'];
$query = mysqli_query($db, "SELECT * FROM tbl_announcement WHERE announcement_id='{$ann_id}'");
$row = $query->fetch_assoc();


if ($staff_id == "" || $staff_username == "" || $row['staff_id'] != $staff_id){
    echo '<script type="text/javascript">window.location.href="../../announcement_admin.php"</script>';
 }
?>

<script>
        window.onload = hideIt;
    function hideIt(){
    var image = $('#output').attr('src')
    var links = $('#videoObject').attr('src')  
    if (links == undefined || links == ''){
     $("#videoObject").hide();
     $("#removeurl").hide();
    }
    else{
        document.getElementById("imgInp").disabled = true;
        
    }
    if (image == undefined || image == ''){
    $("#output").hide();
    $("#remove_btn").hide();
    }
    else{
        document.getElementById("video_link").disabled = true;
        document.getElementById("check").disabled = true;
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
                                </div><div>
                                    <textarea name="edit_caption" type="text" class="form-control" required><?php echo $row["caption"]?></textarea>
                                </div>
                                <div>    
                                    <label>Video Link(can only accept youtube video link):</label>
                                    <input name="video_link" id="video_link" type="text" value=<?php echo $row['video_url']?> >
                                    <button id="check" type="button" onclick="myFunction()">Validate</button>  
                                    <button id="removeurl" type="button" onclick="removeu()">Remove URL</button>           
                                </div>

                                <div>
                                    <small id="mess" style="color:red;"></small>
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
                    <button type="submit" id= "add" name="button_edit_announcement">Submit</button>
                    <button formnovalidate formaction='../../announcement_admin.php'>Cancel</button>
                    </form>
                </div>
                <div>
                <div id="mess1" style="color:red;"></div>
                </div>
           

<script>
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        $("#remove_btn").show();
        $("#output").show();
      URL.revokeObjectURL(output.src) // free memory
      document.getElementById("video_link").disabled = true;
      document.getElementById("remove_btn").disabled = false;
      document.getElementById("check").disabled = true;
    }
    };
    function myFunction() {
    var url = $('#video_link').val();
    if (url == undefined || url == ''){
            $("#videoObject").hide(); 
            $('#mess').show();
            $('#mess').html('URL Empty !');
            setInterval(function() { $("#mess").fadeOut(); }, 2000);
            $("#removeurl").hide();
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
            $("#removeurl").show(); 
            $("#videoObject").show();           
            $('#videoObject').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=1&enablejsapi=1');
            document.getElementById("imgInp").disabled = true;
            document.getElementById("add").disabled = false;
        } else {
            $("#removeurl").show();
            $("#videoObject").hide(); 
            $('#mess').show();
            $('#mess').html('URL not valid !');
            setInterval(function() { $("#mess").fadeOut(); }, 2000);
            document.getElementById("imgInp").disabled = true;
            document.getElementById("add").disabled = true;
            // Do anything for not being valid
        }

}
    } 
    function Remove() {
        $("#remove_btn").hide();
        $("#imagevalidate").val("");
        document.getElementById("output").src = false;
        document.getElementById("video_link").disabled = false;
        document.getElementById("imgInp").value = null;
        document.getElementById("remove_btn").disabled = true;
        $("#output").hide();
        document.getElementById("check").disabled = false;
    }  
    function removeu() {
        $("#removeurl").hide();
        $("#video_link").val("");
        $('#videoObject').attr('src', '');
        $('#videoObject').hide();
        document.getElementById("imgInp").disabled = false;
        document.getElementById("add").disabled = false;
        $('#mess').show();
        $('#mess').html('URL removed !');
        setInterval(function() { $("#mess").fadeOut(); }, 2000);
    }
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js">
</script>


<?php
if (isset($_POST['button_edit_announcement'])) {
    $image = !empty($_FILES['image'])?$_FILES['image']['tmp_name']:'';
    $link = !empty($_POST['video_link'])?$_POST['video_link']:'';
    $imagevalidate = $_POST['imagevalidator'];
    
    if(!empty($image) && empty($link)){

        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, image=?, video_url=? where announcement_id=?');
        $stmt->bind_param("sssss", $title, $caption, $img, $links, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $temp = explode(".", $_FILES["image"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $img = $newfilename;
        $links = null;  
        if (!empty($imagevalidate)){
            $filename = "../../announcement_image/" . $row['image'];
            if (file_exists($filename)) {
            unlink($filename);
            }else {
                echo '<script>$("#mess1").html("An Error occured, please reload the page!");</script>';
              }
            }
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "../../announcement_image/" . $newfilename)) {
            $stmt->execute();
            $edit = "true";
            include ('../../notification_announcement.php');
            echo '<script>$("#mess1").html("Updated Successfully!");
        setInterval(function() { window.location.href="../../announcement_admin.php"; }, 1000);
            </script>';
           
        } else {
            echo '<script>$("#mess1").html("An Error occured, please reload the page!");</script>';
        }

    
    }



    else if(!empty($imagevalidate) && empty($image) && empty($link)){

        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, video_url=? where announcement_id=?');
        $stmt->bind_param("ssss", $title, $caption, $links, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $links = null;  
        if ($stmt->execute()) {
            $edit = "true";
            include ('../../notification_announcement.php');
            echo '<script>$("#mess1").html("Updated Successfully!");
        setInterval(function() { window.location.href="../../announcement_admin.php"; }, 1000);
            </script>';
           
        } else {
            echo '<script>$("#mess1").html("An Error occured, please reload the page!");</script>';
        }
    }




    else if(empty($image) && !empty($link)){

        $url = $link;
          $finalUrl = '';
          if(strpos($url, 'youtube.com/embed') !== false) {
            $finalUrl = $url;
        }
          else if(strpos($url, 'youtube.com/watch') !== false) {
              $videoId = explode("v=",$url)[1];
              if(strpos($videoId, '&') !== false){
                  $videoId = explode("&",$videoId)[0];
              }
              $finalUrl.='https://www.youtube.com/embed/'.$videoId;
          }else if(strpos($url, 'youtu.be/') !== false){
              $videoId = explode("youtu.be/",$url)[1];
              if(strpos($videoId, '&') !== false){
                  $videoId = explode("&",$videoId)[0];
              }
              $finalUrl.='https://www.youtube.com/embed/'.$videoId;
          }else{
            echo '<script>$("#mess1").html("Please enter valid video URL!");</script>';
          }
          
          if($finalUrl!=""){
          $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, video_url=?, image=? where announcement_id=?');
          $stmt->bind_param("sssss", $title, $caption,$links, $img, $ann_id);
          $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $img = null;
          $links = $finalUrl;   
          if ($stmt->execute()) {
            $edit = "true";
            include ('../../notification_announcement.php');
            echo '<script>$("#mess1").html("Updated Successfully!");
            setInterval(function() { window.location.href="../../announcement_admin.php"; }, 1000);
                </script>';
          } else {
            echo '<script>$("#mess1").html("An Error occured, please reload the page!");</script>';
          }
        }
      }


      else if(empty($image) && empty($link)){
        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, image=?, video_url=? where announcement_id=?');
        $stmt->bind_param("sssss", $title, $caption, $links, $img, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $img = null;
        $links = null; 
        $filename = $row['image']?"../../announcement_image/" . $row['image']:'.jpg';
        file_exists($filename)?unlink($filename):'';
        if ($stmt->execute()) {
            
            $edit = "true";
            include ('../../notification_announcement.php');
            echo '<script>$("#mess1").html("Updated Successfully!");
        setInterval(function() { window.location.href="../../announcement_admin.php"; }, 1000);
            </script>';
        } else {
            echo '<script>$("#mess1").html("An Error occured, please reload the page!");</script>';
           
        }
    }

}

?>

