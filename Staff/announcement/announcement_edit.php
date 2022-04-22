<!-- EDIT ANNOUNCEMENT -->
<?php

$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';


if ($staff_id == "" || $staff_username == ""){
    echo '<script type="text/javascript">window.location.href="../../announcement_admin.php"</script>';
 }
?>


    <h1>Edit Announcement</h1>      
        <form class="user" method="POST" id="form">
            <div>
                <input name="edit_id" id="edit_id" type="hidden" class="form-control" value="">
                <label>Title:</label>
                <input name="edit_title" id="edit_title"  type="text" class="form-control"  required>
            </div>
                                        
            <div>
                <label>Caption:</label>
            </div>

            <div>
                <textarea name="edit_caption" id="edit_caption" type="text" class="form-control" required></textarea>
            </div>

            <div>    
                <label>Video Link(can only accept youtube video link):</label>
                <input name="video_link" id="edit_video_link" type="text" >
                <button id="edit_check" type="button" onclick="validate()">Validate</button>  
                <button id="edit_removeurl" type="button" onclick="remove_url()">Remove URL</button>           
            </div>

            <div>
                <small id="edit_mess" style="color:red;"></small>
            </div>

            <div> 
                <iframe id="edit_videoObject" type="text/html" <?php echo !empty($row['video_url'])?'src='.$row['video_url']:''?> width="500" height="265" frameborder="0" allowfullscreen></iframe>
            </div>

            <div>
                <label>Photo:</label>
                <input type="file" name="image" accept="image/*" id="edit_imgInp" onchange="loadFile_edit(event)"/>
                <button type="button" id='edit_remove_btn' onclick="Remove_image()" >Remove Image</button>   
            </div>

            <div>
                <input type="hidden" id= 'edit_imagevalidate' name="imagevalidator" value="<?php echo !empty($row['image'])?'valid':''?>">
                <img id="edit_output"/>
            </div>
                              
                          
             
            <div>
                <button type="submit" id= "edit" name="button_edit_announcement">Submit</button>
                <button formnovalidate formaction='announcement_admin.php'>Cancel</button>
            </div>
            
            <div>
                <div id="edit_mess1" style="color:red;"></div>
            </div>
        </form>   
           

<script>
    var loadFile_edit = function(event) {
        var edit_output = document.getElementById('edit_output');
        edit_output.src = URL.createObjectURL(event.target.files[0]);
        edit_output.onload = function() {
            $("#edit_remove_btn").show();
            $("#edit_output").show();
            URL.revokeObjectURL(edit_output.src) // free memory
            document.getElementById("edit_video_link").disabled = true;
            document.getElementById("edit_remove_btn").disabled = false;
            document.getElementById("edit_check").disabled = true;
        }
    };

    function validate() {
        var url = $('#edit_video_link').val();
        if (url == undefined || url == ''){
            $("#edit_videoObject").hide(); 
            $('#edit_mess').show();
            $('#edit_mess').html('URL Empty !');
            setInterval(function() { $("#edit_mess").fadeOut(); }, 2000);
            $("#edit_removeurl").hide();
            document.getElementById("edit_imgInp").disabled = false;
            document.getElementById("edit").disabled = false;
            // Do anything for Empty URL
        }

        else {        
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[2].length == 11) {
                // Do anything for being valid
                // if need to change the url to embed url then use below line
                $("#edit_removeurl").show(); 
                $("#edit_videoObject").show();           
                $('#edit_videoObject').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=1&enablejsapi=1');
                document.getElementById("edit_imgInp").disabled = true;
                document.getElementById("edit").disabled = false;
            } else {
                $("#edit_removeurl").show();
                $("#edit_videoObject").hide(); 
                $('#edit_mess').show();
                $('#edit_mess').html('URL not valid !');
                setInterval(function() { $("#edit_mess").fadeOut(); }, 2000);
                document.getElementById("edit_imgInp").disabled = true;
                document.getElementById("edit").disabled = true;
                // Do anything for not being valid
            }
        }
    } 

    function Remove_image() {
        $("#edit_remove_btn").hide();
        $("#edit_imagevalidate").val("");
        document.getElementById("edit_output").src = false;
        document.getElementById("edit_video_link").disabled = false;
        document.getElementById("edit_imgInp").value = null;
        document.getElementById("edit_remove_btn").disabled = true;
        $("#edit_output").hide();
        document.getElementById("edit_check").disabled = false;
    } 

    function remove_url() {
        $("#edit_removeurl").hide();
        $("#edit_video_link").val("");
        $('#edit_videoObject').attr('src', '');
        $('#edit_videoObject').hide();
        document.getElementById("edit_imgInp").disabled = false;
        document.getElementById("edit").disabled = false;
        $('#edit_mess').show();
        $('#edit_mess').html('URL removed !');
        setInterval(function() { $("#edit_mess").fadeOut(); }, 2000);
    }
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>


<?php

if (isset($_POST['button_edit_announcement'])) {
    $ann_id = $_POST['edit_id'];
    $query = mysqli_query($db, "SELECT * FROM tbl_announcement WHERE announcement_id='{$ann_id}'");
    $row = $query->fetch_assoc();
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
            $filename = "announcement_image/" . $row['image'];
            if (file_exists($filename)) {
                unlink($filename);
            } else {
                echo '<script>$("#edit_mess1").html("An Error occured, please reload the page!");</script>';
              }
        }
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "announcement_image/" . $newfilename)) {
            $stmt->execute();
            $edit = "true";
            include ('notification_announcement.php');
            echo '<script>$("#edit_mess1").html("Updated Successfully!");
            $("#form :input").prop("disabled", true); 
            setInterval(function() { window.location.href="announcement_admin.php"; }, 1000);
            </script>'; 
        } else {
            echo '<script>$("#edit_mess1").html("An Error occured, please reload the page!");</script>';
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
            include ('notification_announcement.php');
            echo '<script>$("#edit_mess1").html("Updated Successfully!");
            $("#form :input").prop("disabled", true); 
            setInterval(function() { window.location.href="announcement_admin.php"; }, 1000);
            </script>';
        } else {
            echo '<script>$("#edit_mess1").html("An Error occured, please reload the page!");</script>';
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
            } else if (strpos($url, 'youtu.be/') !== false){
                $videoId = explode("youtu.be/",$url)[1];
                if(strpos($videoId, '&') !== false){
                    $videoId = explode("&",$videoId)[0];
                }
                $finalUrl.='https://www.youtube.com/embed/'.$videoId;
            } else {
                echo "<script>$('#edit_mess1').html('Please enter valid video URL!');</script>";
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
                include ('notification_announcement.php');
                echo '<script>$("#edit_mess1").html("Updated Successfully!");
                $("#form :input").prop("disabled", true); 
                setInterval(function() { window.location.href="announcement_admin.php"; }, 1000);
                </script>';
            } else {
                echo '<script>$("#edit_mess1").html("An Error occured, please reload the page!");</script>';
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
        $filename = $row['image']?"announcement_image/" . $row['image']:'.jpg';
        file_exists($filename)?unlink($filename):'';
        if ($stmt->execute()) {
            $edit = "true";
            include ('notification_announcement.php');
            echo '<script>$("#edit_mess1").html("Updated Successfully!");
            $("#form :input").prop("disabled", true); 
            setInterval(function() { window.location.href="announcement_admin.php"; }, 1000);
            </script>';
        } else {
            echo '<script>$("#edit_mess1").html("An Error occured, please reload the page!");</script>';
           
        }
    }

}

?>

