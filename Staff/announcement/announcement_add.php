<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" || $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        window.onload = hideIt;
    function hideIt(){
 $("#videoObject").hide();
    $("#output").hide();
        }
</script>
  <h1>Add Announcement</h1>
            <!-- Modal content-->
           
                    <form class="user" method="POST" enctype="multipart/form-data" runat="server">
                        
                                <div>    <label>Title:</label>
                                    <input name="title" id="name" type="text" value="" required>
                                </div><div>
                        
                                    <label>Caption:</label>
                                    <textarea name="caption" id="price" type="text" value="" required></textarea>
                                </div>
                                <div>    
                                    <label>Video Link(can only accept youtube video link):</label>
                                    <input name="video_link" id="video_link" type="text" value="">
                                    <button id="check" type="button" onclick="myFunction()">Validate</button>           
                                </div>
                                
                                <div> <iframe id="videoObject" type="text/html" width="500" height="265" frameborder="0" allowfullscreen></iframe>
                                </div>
                               
                                <label>Photo:</label>
                                    <input type="file" name="image" accept="image/*" id="imgInp" onchange="loadFile(event)" >
                                </div>
                                <div><img id="output" src="#"/></div>
                                
                <div class="">
                    <button type="submit" id= "add" name="button_add_announcement">Submit</button>
                     <button formnovalidate formaction='cancel.php'>Cancel</button>
                    </form>
                </div>
            </div>
      
 

<script>
 
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        $("#output").show();
      URL.revokeObjectURL(output.src) // free memory
      document.getElementById("video_link").disabled = true;
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
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js">
</script>


<?php
if (isset($_POST['button_add_announcement'])) {
    $image = !empty($_FILES['image'])?$_FILES['image']['tmp_name']:'';
    $link = !empty($_POST['video_link'])?$_POST['video_link']:'';
    
    if(!empty($image) && empty($link)){
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");
    $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,image,date_created,staff_id) VALUES (?,?,?,?,?)');
    $stmt->bind_param("sssss", $title, $caption, $img, $datetime, $staff_id1);
    $img = basename($_FILES['image']['name']);
    $title = $_POST['title'];
    $caption = $_POST['caption'];
    $datetime = $date;
    $staff_id1 = $staff_id;
    $menu_photo = "../../announcement_image/" . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $menu_photo)) {
        $stmt->execute();
        echo '<script type="text/javascript">alert("Added Successfully!");window.location.href="announcement_test.php"</script>';
    } else {
        echo '<script type="text/javascript">alert("Added Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
    }
}

else if(empty($image) && !empty($link)){

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
        echo '<script type="text/javascript">alert("Added Unsuccessful! Enter valid video URL!");window.location.href="announcement_test.php"</script>';
    }
    
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");
    $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,date_created,staff_id, video_url) VALUES (?,?,?,?,?)');
    $stmt->bind_param("sssss", $title, $caption, $datetime, $staff_id1,$links);
    $title = $_POST['title'];
    $caption = $_POST['caption'];
    $datetime = $date;
    $staff_id1 = $staff_id;
    $links = $finalUrl;
    if ($stmt->execute()) {
        echo '<script type="text/javascript">alert("Added Successfully!");window.location.href="announcement_test.php"</script>';
    } else {
        echo '<script type="text/javascript">alert("Added Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
    }
}


    else if(empty($image) && empty($link)){
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");
    $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,date_created,staff_id) VALUES (?,?,?,?)');
    $stmt->bind_param("ssss", $title, $caption, $datetime, $staff_id1);
    $title = $_POST['title'];
    $caption = $_POST['caption'];
    $datetime = $date;
    $staff_id1 = $staff_id;
    if ($stmt->execute()) {
        echo '<script type="text/javascript">alert("Added Successfully!");window.location.href="announcement_test.php"</script>';
    } else {
        echo '<script type="text/javascript">alert("Added Unsuccessful! Photo file format!");window.location.href="announcement_test.php"</script>';
    }
}
}

?>




</body>
</html>