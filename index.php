<?php
    include("header.php");
?>

<div class="main_container">
   <div class="homepage">
       <img src="image/logo.png" width="80">
       <p>GSCK APPOINTMENT PORTAL</p>
       <h1>Set an appointment without the hassle of queueing</h1>

        <?php 
        if (isset($_SESSION['student_id'])) {?>
            <a href="student_appointment.php"><button>BOOK NOW</button></a>
        <?php
        }
        else {?>
            <button onclick="BtnLogin()">BOOK NOW</button>
        <?php
        }
        ?>

   </div>
</div>


<div class="announcement_container">
    <h2>Latest Announcements</h2>
    <div class="announcement">
        <div class="img_announcement"></div>
        <div class="fetch_content">
        <?php
            $announcement = "SELECT * FROM tbl_announcement ORDER BY announcement_id DESC LIMIT 3";
            $announcement_query = mysqli_query($db, $announcement);

            if(mysqli_num_rows($announcement_query) > 0) {
                while($row_announcement = mysqli_fetch_assoc($announcement_query)) {

                    ?><div class="announcement_div"><?php

                    $date_created = $row_announcement['date_created'];
                    $str_date = strtotime($date_created);

                    ?><div class="date_title">
                        <h1><?php echo $row_announcement['announcement_title']; ?></h1>
                    <?php

                    ?>
                        <h3><?php echo date("m-d-Y", $str_date); ?></h3>
                    </div>
                    <?php
                    
                    ?><p><?php echo $row_announcement['caption']; ?></p><?php

                    ?></div><?php
                }
            }
        ?>
        <a href="announcements.php"><button>Go to Announcement Page</button></a>
        </div>
    </div>
</div>

<?php
    include("backtotop.php");
?>



</body>
</html>

