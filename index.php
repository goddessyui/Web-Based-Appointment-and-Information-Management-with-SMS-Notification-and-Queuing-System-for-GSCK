<?php 
include('header.php');
?>

<div class="main_container">
    <div class="small_container">

        <div class="home_appointment">
            <div class="home_content">
                <h1>GSCK APPOINTMENT PORTAL</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores fuga 
                    similique laboriosam accusamus vel tenetur unde quam at tempora earum adipisci 
                    sint dolores consequatur sed, quod consequuntur doloribus voluptatum maxime!
                </p>
                <button><a href="student_appointment.php">Set an appointment</a></button>
            </div>
        </div>
        <div class="home_img"></div>
        <div class="home_sched">
            <div class="sched_container">
            <h3>Latest announcements</h3>
            <?php
                $announcement = "SELECT * FROM tbl_announcement INNER JOIN tbl_staff_registry ON 
                tbl_staff_registry.staff_id = tbl_announcement.staff_id ORDER BY tbl_announcement.date_created 
                DESC LIMIT 3";
      
                $announcement_query = mysqli_query($db, $announcement);
                if($announcement_query == TRUE) {
                    $count = mysqli_num_rows($announcement_query);
                    if($count > 0) {
                        while($rows = mysqli_fetch_assoc($announcement_query)) {
                            ?>
                                <div class="inline_box">
                            
                                <h3><?php echo $rows['announcement_title']; ?></h3>
                                <p><?php echo $rows['caption']; ?></p>
                                <img src="" alt=""><?php echo $rows['image']; ?>

                                </div>
                            <?php
                        }
                    }
                }
                ?>
    
            </div>
        </div>
    </div>

    <div class="small_container">
      
    </div>
</div>

    <?php
     include("backtotop.php");
    ?>

<style>
    .main_container {
        width: 100%;
        margin-top: 100px;
        height: 80vh;
       
    }
    .small_container {
        width: 90%;
        margin: 0 auto;
        height: 80vh;
        display: flex;
        align-items: center;
    }
    .home_appointment,
    .home_img,
    .home_sched {
        width: 33%;
        height: 80vh;
    }
    .home_content {
        background: #fff;
        position: relative;
        top: 50%;
        transform: translate(80px, -50%);
        padding: 100px 40px;

    }
    .home_content h1 {
        margin-bottom: 20px;
    }
    .home_content p {
        margin-bottom: 20px;
    }
    .home_content button {
        border: none;
        background: gold;
        padding: 10px 26px;
        font-size: 14px;
        text-transform: uppercase;
        color: #333;
    }
    .home_img {
        background-image: url('image/calendar.jpg');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .inline_box {
        width: 100%;
        height: 30%;
    }
    .sched_container {
        width: 90%;
        height: 100%;
        float: right;
    }
    .sched_container h3 {
        margin-top: 20px;
    }
    .inline_box {
        height: 27%;
        margin-top: 20px;
        background: #eee;
    }
</style>

</body>
</html>

