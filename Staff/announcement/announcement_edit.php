<!-- EDIT ANNOUNCEMENT -->
<?php

$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';


if ($staff_id == "" || $staff_username == ""){
    echo '<script type="text/javascript">window.location.href="../../announcement_admin.php"</script>';
 }
?>


    <h3 class="edit_announcement">Edit Announcement</h3>      
        <form class="user" method="POST" id="form" enctype="multipart/form-data">

            <div class="form_edit">
                <input name="edit_id" id="edit_id" type="hidden" class="form-control" value="" >
                <p>Title:</p>
                <input name="edit_title" id="edit_title"  type="text" class="form-control"  required>
            </div>
                                        
            <div class="form_edit">
                <p>Caption:</p>
                <input name="edit_caption" id="edit_caption" type="text" class="form-control" required></input>
            </div>

            <div class="validate_form">    
                <p>Video Link(can only accept youtube video link):</p>
                <input name="edit_video_link" id="edit_video_link" type="text" >
                <button id="edit_check" type="button" onclick="validate()">Validate</button>  
                <button id="edit_removeurl" type="button" onclick="remove_url()">Remove URL</button>           
            </div>

            <div>
                <small id="edit_mess"></small>
            </div>

            <div class="video_frame"> 
                <iframe id="edit_videoObject" type="text/html" <?php echo !empty($row['video_url'])?'src='.$row['video_url']:''?> width="500" height="265" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="image_frame">
                <label>Photo:</label>
                <input type="file" name="edit_image" accept="image/*" id="edit_imgInp" onchange="loadFile_edit(event)"/>
                <button type="button" id='edit_remove_btn' onclick="Remove_image()" >Remove Image</button>   
            </div>

            <div>
                <input type="hidden" id= 'edit_imagevalidate' name="edit_imagevalidator" value="<?php echo !empty($row['image'])?'valid':''?>">
                <img id="edit_output"/>
            </div>
                              
                          
             
            <div class="url_buttons">
                <button type="submit" id="edit" name="button_edit_announcement">Submit</button>
                <button formnovalidate formaction='announcement_admin.php' class="cancel_edit">Cancel</button>
            </div>
            
            <div>
                <div id="edit_mess1"></div>
            </div>
        </form>   








        <style>
            .edit_announcement {
                margin-bottom: 20px;
                font-weight: 500;
                font-weight: 16px;
            }
            form {
                width: 100%;
            }
            .form_edit {
                height: 28px;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
            }
            .form_edit p {
                width: 100px;
            }
            .form_edit input[type=text] {
                height: 28px;
                padding-left: 10px;
                width: 100%;
            }
            .validate_form {
                margin-bottom: 10px;
                width: 100%;
                background: lightgrey;
                padding: 10px;
                margin-top: 20px;
            }
            .validate_form p {
                margin-bottom: 10px;
                font-size: 14px;
            }
            .validate_form input[type=text] {
                height: 28px;
                background: #eee;
                border: 1px solid grey;
            }
            .validate_form button {
                height: 28px;
                width: 100px;
                border: none;
                background: #2F729E;
                color: #eee;
                cursor: pointer;
                margin-left: 10px;
            }
            .validate_form #edit_removeurl {
                background: #EC3237;
                color: #eee;
                margin-left: 10px;
            }
            .video_frame {
                width: 100%;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .video_frame iframe {
                width: 100%;
                max-height: 20vh;
            }
            .image_frame {
                width: 100%;
                margin-bottom: 10px;
                background: lightgrey;
                padding: 10px;
            }
            .image_frame input {
                margin-right: 10;
                border: 1px solid grey;
                height: 28px;
                background: #eee;
            }
            .image_frame button {
                height: 28px;
                padding: 0 12px;
                border: none;
                background: #EC3237;
                color: #eee;
                cursor: pointer;
            }
            input[type=file]::file-selector-button {
                color: #eee;
                height: 28px;
                border: 1px solid lightgrey;
                background: #2D303A;
            }

            .url_buttons {
                margin-top: 20px;
            }
            .url_buttons button{
                height: 28px;
                border: none;
                padding: 0 12px;
                color: #eee;
                background: #2F729E;
                cursor: pointer;
            }
            .url_buttons .cancel_edit {
                background: #EC3237;
                margin-left: 10px;
            }
            #edit_output {
                width: 100%;
                max-height: 20vh;
                background-size: cover;
            }
        </style>
           

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
    $image = !empty($_FILES['edit_image'])?$_FILES['edit_image']['tmp_name']:'';
    $link = !empty($_POST['edit_video_link'])?$_POST['edit_video_link']:'';
    $imagevalidate = $_POST['edit_imagevalidator'];
    
    if(!empty($image) && empty($link)){
        $stmt = $db->prepare('UPDATE tbl_announcement set announcement_title=?, caption=?, image=?, video_url=? where announcement_id=?');
        $stmt->bind_param("sssss", $title, $caption, $img, $links, $ann_id);
        $title = $_POST['edit_title'];
        $caption = $_POST['edit_caption'];
        $temp = explode(".", $_FILES["edit_image"]["name"]);
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
        if (move_uploaded_file($_FILES["edit_image"]["tmp_name"], "announcement_image/" . $newfilename)) {
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

