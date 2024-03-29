<!-- ADDING ANNOUNCEMENT -->

<?php
include_once("dbconfig.php"); 
// session_start();
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';

if ($staff_id == "" || $staff_username == ""){
   echo '<script type="text/javascript">window.location.href="index.php"</script>';
}

$query = mysqli_query($db, "SELECT first_name, last_name FROM tbl_staff_registry WHERE staff_id='{$staff_id}'");
$row = $query->fetch_assoc();
$fullname = $row['first_name'].' '.$row['last_name'];
?>
    <script>
    window.onload = hideIt;
    function hideIt(){
    $("#videoObject").hide();
    $("#output").hide();
    $("#removeurl").hide();
    $("#remove_btn").hide();
    }
    </script>

    <h3 class="edit_announcement">Add Announcement</h3>
        <!-- Modal content-->

                    <form class="user" method="POST" id="form" enctype="multipart/form-data">
                        <div class="form_edit">
                            <p>Title:</p>
                            <input name="title" id="title" type="text" value="" required>
                        </div>

                        <div class="form_edit">
                            <p>Caption:</p>
                            <input name="caption" id="caption" type="text" value="" required></input>
                        </div>

                        <div class="validate_form">    
                            <p>Video Link(can only accept youtube video url):</p>
                            <input name="video_link" id="video_link" type="text" value="">
                            <button id="check" type="button" onclick="myFunction()">Validate URL</button>
                            <button id="removeurl" type="button" onclick="removeu()">Remove URL</button>                
                        </div>

                        <div>
                            <small id="mess"></small>
                        </div>

                        <div class="video_frame"> 
                            <iframe id="videoObject" type="text/html" width="500" height="265" frameborder="0" allowfullscreen></iframe>
                        </div>
                        
                        <div class="image_frame">
                            <label>Photo:</label>
                            <input type="file" name="image" accept="image/*" id="imgInp" onchange="loadFile(event)" >
                            <button type="button" id='remove_btn' onclick="Remove()" disabled>Remove Image</button>  
                        </div>

                        <div>
                            <img id="output" src="#"/>
                        </div>

                        <div>
                        <input type="checkbox" name="check_notify" id="check_notify" onclick="checknotify()" value="true">
                        <label>Notify students through SMS</label>
                        </div>
                        
                        <div hidden id="filter" class="filter">

                            <div class="filter_send">
                                <p>Course:</p>
                                <select name="course" id="course">
                                    <option value="ALL">ALL</option>  
                                    <option value="BSHM">BSHM</option>
                                    <option value="BSTM">BSTM</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSSW">BSSW</option>
                                    <option value="ABE">ABE</option>
                                    <option value="BECE">BECE</option>
                                    <option value="BTVED">BTVED</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="ACT">ACT</option>
                                    <option value="HM">HM</option>
                                    <option value="TESDA PROGRAM">TESDA PROGRAM</option>
                                </select>
                            </div>
                            <div class="filter_send">
                                <p>Year:</p>
                                <select name="year" id="year"> 
                                    <option value="ALL">ALL</option> 
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                        </div>

                        <div class="url_buttons">
                            <button type="submit" id= "add" name="button_add_announcement">Submit</button>
                            <button formnovalidate formaction='announcement_admin.php' class="cancel_edit">Cancel</button>
                        </div>

                        <div>
                            <div id="mess1"></div>
                        </div>
                    </form>

                
      
 <style>
     .filter {
         width: 100%;
     }
     .filter_send {
         height: 28px;
         display: flex;
         align-items: flex-end;
         margin-top: 10px;
     }
     .filter_send p {
         width: 80px;
     }
     .filter_send select {
         width: 100%;
         height: 28px;
     }
     #output {
        height: 20vh;
    }
     
 </style>

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

    function checknotify() {
        if ($('#check_notify').is(':checked')){
            $("#filter").show();
        } else {
            $("#filter").hide();
        }
    }

</script>
<script src="http://code.jquery.com/jquery-1.9.1.js">
</script>


<?php
if (isset($_POST['button_add_announcement'])) {
    $image = !empty($_FILES['image'])?$_FILES['image']['tmp_name']:'';
    $link = !empty($_POST['video_link'])?$_POST['video_link']:'';
    $title = $_POST['title'];
    $caption = $_POST['caption'];
    if(!empty($image) && empty($link)){
        date_default_timezone_set("Asia/Manila");
        $date = date("Y-m-d H:i:s");
        $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,image,date_created,staff_id,`name`) VALUES (?,?,?,?,?,?)');
        $stmt->bind_param("ssssss", $title, $caption, $img, $datetime, $staff_id1,$name);
        $temp = explode(".", $_FILES["image"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $img = $newfilename;
        $title = $_POST['title'];
        $caption = $_POST['caption'];
        $datetime = $date;
        $staff_id1 = $staff_id;
        $name = $fullname;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], "announcement_image/" . $newfilename)) {
            $stmt->execute();
            $add_id = $db->insert_id;
            if (!empty($_POST['check_notify'])) {
                $check = $_POST['check_notify'];
                $course = $_POST['course'];
                $year = $_POST['year'];
                include ('announcement_sms.php');
                }
            $add = "true";
            include ('notification_announcement.php');
            echo '<script>$("#mess1").html("Added Successfully!");
            $("#form :input").prop("disabled", true);  
            window.location.href="announcement_admin.php";
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
            echo "<script>$('#mess1').html('Please enter valid video URL!');
            var title =   '$title';
            var caption =  '$caption';
            $('#title').val(title);
            $('#caption').val(caption);
            </script>";
        }

        if($finalUrl!=""){
            date_default_timezone_set("Asia/Manila");
            $date = date("Y-m-d H:i:s");
            $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,date_created,staff_id, video_url,`name`) VALUES (?,?,?,?,?,?)');
            $stmt->bind_param("ssssss", $title, $caption, $datetime, $staff_id1,$links,$name);
            $title = $_POST['title'];
            $caption = $_POST['caption'];
            $datetime = $date;
            $staff_id1 = $staff_id;
            $links = $finalUrl;
            $name = $fullname;
            if ($stmt->execute()) {
                $add_id = $db->insert_id;
                if (!empty($_POST['check_notify'])) {
                    $check = $_POST['check_notify'];
                    $course = $_POST['course'];
                    $year = $_POST['year'];
                    include ('announcement_sms.php');
                    }
                $add = "true";
                include ('notification_announcement.php');
                echo '<script>$("#mess1").html("Added Successfully!");
                $("#form :input").prop("disabled", true); 
                window.location.href="announcement_admin.php";
                    </script>';
            } else {
                echo '<script>$("#mess1").html("An Error occured, please reload the page!");</script>';
            }
        }
    }


    else if(empty($image) && empty($link)){
        date_default_timezone_set("Asia/Manila");
        $date = date("Y-m-d H:i:s");
        $stmt = $db->prepare('INSERT INTO tbl_announcement (announcement_title,caption,date_created,staff_id,`name`) VALUES (?,?,?,?,?)');
        $stmt->bind_param("sssss", $title, $caption, $datetime, $staff_id1,$name);
        $title = $_POST['title'];
        $caption = $_POST['caption'];
        $datetime = $date;
        $staff_id1 = $staff_id;
        $name = $fullname;
        if ($stmt->execute()) {
            $add_id = $db->insert_id;
            if (!empty($_POST['check_notify'])) {
            $check = $_POST['check_notify'];
            $course = $_POST['course'];
            $year = $_POST['year'];
            include ('announcement_sms.php');
            }
            $add = "true";
            include ('notification_announcement.php');
            echo '<script>$("#mess1").html("Added Successfully!");
            $("#form :input").prop("disabled", true); 
            window.location.href="announcement_admin.php";
            </script>';
        } else {
            echo '<script>$("#mess1").html("An Error occured, please reload the page!");</script>';     
        }
    }
}

?>



