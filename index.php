<?php 
include('header.php');
?>

<div class="main_container">
    <div class="small_container">

        <div class="home_appointment">
            <div class="home_content">
                <h1>GSCK APPOINTMENT SYSTEM</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores fuga 
                    similique laboriosam accusamus vel tenetur unde quam at tempora earum adipisci 
                    sint dolores consequatur sed, quod consequuntur doloribus voluptatum maxime!
                </p>
                <button>Set an appointment</button>
            </div>
        </div>
        <div class="home_img"></div>
        <div class="home_sched"></div>
    </div>
</div>

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
   
  
</style>

</body>
</html>

