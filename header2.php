<?php
    include_once("dbconfig.php");
    session_start();
    $student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
    $student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
    $staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
    $position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
    $staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
    if ($staff_id != "" && $staff_username != ""){
        if ($position == "Registrar" OR "Accounting Staff/Scholarship Coordinator" OR "Teacher"){
            echo '<script type="text/javascript">window.location.href="admin.php"</script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Appointment System</title>
</head>
<body>
    <div class="header">
        <div class="menu_container">
            <div class="menu-btn">
                <div class="menu-btn-burger"></div>
            </div>

        </div>
        <div class="title_container">
            <h3>GOLDENSTATE COLLEGE OF KORONADAL</h3>
        </div>

        <div class="sign_in_container">
            <div class="sign_user">

                <?php
                    if(isset($_SESSION['student_id'])) {

                        $student_id = $_SESSION['student_id'];
                        $fnln="SELECT * FROM tbl_student_registry WHERE student_id = '$student_id'";
                        $name= mysqli_query($db, $fnln);
                        $rows=mysqli_fetch_assoc($name);

                        ?>
                            <button><p><?php echo $rows['student_id']; ?></p></button>
                            <button class="btn_logout_link"><a href="logout.php">Logout</a></button>
                            
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <button onclick="BtnDropdown()">
                                    <i class="fa fa-bell-o"><p class="count" id="count_red" style="color: #fff; text-decoration: none;"></p></i>
                                </button>
                                <div class="dropdown-menu" id="dropdown_id"></div>
                            </div>
                        <?php
                    }
            
                    else {
                        ?>
                        <button class="login" onclick="BtnLogin()"><p>Login</p></button>
                        <b>/</b>
                        <button class="register" onclick="BtnRegister()"><p>Register</p></button>
                        <?php
                    }
                ?>
                
            </div>
        </div>
    </div>




    <div class="nav_container" id="open_nav_container">
        <nav>
            <ul>
                <a href="#" class="a_link_after"><li>Home</li></a>
                <a href="#" class="a_link_after"><li>Profile Setting</li></a>
                <a href="#" class="a_link_after"><li>About</li></a>
                <a href="#" class="a_link_after"><li>My Appointments</li></a>
                <a href="#" class="a_link_after"><li>Announcements</li></a>
                <a href="#" class="a_link_after"><li>Staff Schedule</li></a>
                <a href="#" class="a_link_after"><li>Contact</li></a>
            </ul>
        </nav>
    </div>




    <div class="login_sidebar" id="open_login">
        <div class="login_form_container">
            <div class="form_content">
                <div class="gsck_img"></div>

                <form method="post">
                    <button class="bg-outer" onclick="CloseLoginBtn()">
                        <div class="outer">
                            <div class="inner">
                                <label>EXIT</label>
                            </div>
                        </div>
                    </button>
                   
                    <div class="input_box">
                        <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" />
                        <div class="icon"><i class="fa fa-user"></i></div>
                    </div>

                    <div class="input_box">
                        <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" />
                        <div class="icon"><i class="fa fa-lock"></i></div>
                    </div>

                    <div class="option_div">
                        <div class="check_box">
                            <input type="checkbox">
                            <span>Remember me?</span>
                        </div>
                        <div class="forget_div">
                            <a class="forget_password" href="login_system/forgotpassword_verify.php">Forget Password?</a>
                        </div>
                    </div>

                    <div class="input_box">
                            <input type="button" name="button_login" class="login_button" value="LOGIN" id="btn_login" />
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="register_sidebar"  id="open_register">
        <div class="register_container">
            <div class="form_content">

                <div class="gsck_img"></div>
                <form method="post">
                    <button class="bg-outer" onclick="CloseLoginBtn()">
                        <div class="outer">
                            <div class="inner">
                                <label>EXIT</label>
                            </div>
                        </div>
                    </button>
                </form>
                
            </div>
        </div>
    </div>

   

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        background: #F4F6F7;
    }
    .header {
        width: 100%;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2%;
        position: fixed;
        z-index: 999;
        top: 0;
        background: #fff;
    }
    .menu_container {
        display: flex;
        align-items: center;
    }
    .title_container {
        display: flex;
        align-items: center;
    }
    .title_container h3 {
        font-family: roboto;
        color: #333;
    }
    .sign_user {
        display: flex;
    }
    .sign_user p {
        color: #333;
        text-decoration: underline;
        transition: all .3s ease-in-out;
    }
    .sign_user p:hover {
        color: #324e9e;
        text-decoration: none;
        cursor: pointer;
    }
    .sign_user button{
        border: none;
        background: none;
        font-family: Poppins;
        color: #333;
        text-transform: uppercase;
        font-size: 13.5px;
    }

    .login {
        margin-right: 6px;
    }
    .register {
        margin-left: 6px;
    }



    /*-----.menu-bar-----*/
    
    .menu-btn {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        cursor: pointer;
        transition: all .5s ease-in-out;

    }
    .menu-btn-burger {
        width: 21px;
        height: 2.2px;
        background: #333;
        transition: all .5s ease-in-out;
    }
    .menu-btn-burger::before,
    .menu-btn-burger::after {
        content: '';
        position: absolute;
        width: 21px;
        height: 2.2px;
        background: #333;
        transition: all .5s ease-in-out;
    }
    .menu-btn-burger::before {
        transform: translateY(-6px);
    }
    .menu-btn-burger::after {
        transform: translateY(6px);
    }

    /*-----Animation-----*/

    .menu-btn.open .menu-btn-burger {
        background: transparent;
    }
    .menu-btn.open .menu-btn-burger::before {
        height: 1px;
        transform: rotate(45deg);
    }
    .menu-btn.open .menu-btn-burger::after {
        height: 1px;
        transform: rotate(-45deg);
    }

    /*-----Sidebar-----*/
    .nav_container {
        width: 380px;
        height: 90vh;
        background: #fff;
        position: fixed;
        top: 80px;
        transition: all .3s ease-in-out;
        transform: translateX(-380px);
        opacity: 0;

    }
        .nav_container nav {
            width: 100%;
            height: 100%;
        }
        .nav_container nav ul {
            margin-top: 80px;
            width: 100%;
            padding-left: 45px;
        }
        .nav_container nav ul a {
            text-decoration: none;
            font-family: roboto;
            color: #333;
            font-size: 15px;
            text-transform: uppercase;
            transition: all .1s ease-in;
        }
        .nav_container nav ul li {
            list-style-type: none;
            padding: 20px 0;
        }
        .nav_container nav ul .a_link_after::after {
            content: '';
            position: absolute;
            background: lightgrey;
            width: 80px;
            height: 1px;
            transform: translateY(-15px);
        }
        .nav_container nav ul .a_link_after:hover {
            font-size: 20px;
            font-weight: 600;
            color: #324e9e;
        }
  

    .login_sidebar {
        width: 100%;
        height: 90vh;
        background: #0008;
        position: fixed;
        top: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: translateY(-100vh);
        opacity: 0;
        transition: all .5s ease-in-out;
        z-index: 888;

    }
    .form_content {
        width: 760px;
        height: 60vh;
        display: flex;
    }
    .form_content .gsck_img,
    .form_content form {
        width: 50%;
        height: 60vh;
        background: #fff;
    }
    .form_content .gsck_img {
        background-image: url("image/school.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .cirle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        float: right;
        transform: translate(20px, -20px);
    }

    .register_sidebar {
        width: 100%;
        height: 90vh;
        background: #0008;
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 80px;
        transform: translateY(-100vh);
        opacity: 0;
        transition: all .5s ease-in-out;
        z-index: 888;
    }
    .register_container {
        width: 760px;
        height: 60vh;
        background: #fff;
    }





    .bg-outer {
        border: none;
        width: 40px;
        margin: 0 auto;
        height: 40px;
        background: #5463FF;
        display: flex;
        align-items: center;
        border-radius: 50%;
        float: right;
        transform: translate(20px, -20px);
    }
    .outer {
        position: relative;
        margin: auto;
        width: 28px;
        cursor: pointer;
    }

    .inner {
        width: inherit;
        text-align: center;
    }

    label { 
        font-size: 11px;
        line-height: 21px;
        text-transform: uppercase;
        color: #fff;
        font-family: Lato;
        transition: all .3s ease-in;
        opacity: 0;
        cursor: pointer;
    }

    .inner:before, .inner:after {
        position: absolute;
        content: '';
        height: 1px;
        width: 28px;
        background: #fff;
        left: 0;
        transition: all .3s ease-in;
    }

    .inner:before {
        top: 50%; 
        transform: rotate(45deg);  
    }

    .inner:after {  
        bottom: 50%;
        transform: rotate(-45deg);  
    }

    .outer:hover label {
        opacity: 1;
    }

    .outer:hover .inner:before,
    .outer:hover .inner:after {
        transform: rotate(0);
    }

    .outer:hover .inner:before {
        top: 0;
    }

    .outer:hover .inner:after {
        bottom: 0;
    }
    .btn_logout_link {
        margin-left: 15px;
        margin-right: 14px;
    }
    .btn_logout_link a{
        text-decoration: none;
        padding: 4px 12px;
        color: #fff;
        font-size: 12px;
        background: #444;
    }
    .fa.fa-bell-o {
        font-size: 18px;
        transform: translateY(2px);

    }
    .fa.fa-bell-o:hover {
        animation-name: bell_icon;
        animation-duration: .5s;
        animation-iteration-count: 3;
    }
    @keyframes bell_icon {
        0% {
            transform: rotate(-10deg) translateY(2px);
        }
        50% {
            transform: rotate(10deg) translateY(2px);
        }
        100% {
            transform: rotate(-10deg) translateY(2px);
        }
    }
 
    .dropdown-menu {
        width: 400px;
        height: 90vh;
        position: fixed;
        top: 80px;
        right: 0;
        list-style-type: none;
        box-sizing: border-box;
        padding: 20px 40px;
        padding-top: 30px;
        overflow: scroll;
        opacity: 0;
        transform: translateX(55vh);
        transition: all .5s ease-in-out;
        background: #fff;
    }
 
    /* width */
    ::-webkit-scrollbar {
    width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    background: #fff; 
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #eee; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: grey; 
    }

    .notif_container {
        padding: 10px;
        border-bottom: 1px solid lightgrey;
        transition: all .3s ease-in-out;
    }
  
    .notif_container:last-child {
        border: none;
    }

    .notif_container a {
        text-decoration: none;
        color: #333;
    }
    .notif_container a:visited {
        color: grey;
    }
    .notif_container .notif_title {
        font-family: roboto;
        margin-bottom: 5px;
        font-size: 13px;
    }
    .notif_container small {
        font-family: Lato;
        font-size: 12px;
    }
    .count {
        height: 14px;
        width: 14px;
        background: #DA1212;
        font-size: 9px;
        font-family: roboto;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: -4px;
        right: -5px;
    }






</style>


<script>
    const menuBtn = document.querySelector('.menu-btn');
    let menuOpen = false;

    menuBtn.addEventListener('click', () => {
        if(!menuOpen) {
            menuBtn.classList.add('open');
            menuOpen = true;
            document.getElementById('open_nav_container').style.transform = "translateX(0)";
            document.getElementById('open_nav_container').style.opacity = "1";
            

            document.getElementById('open_login').style.transform = "translateY(-100vh)";
            document.getElementById('open_login').style.opacity = "0";
            document.getElementById('open_register').style.transform = "translateY(-100vh)";
            document.getElementById('open_register').style.opacity = "0";
        }
        else {
            menuBtn.classList.remove('open');
            menuOpen = false;
            document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
            document.getElementById('open_nav_container').style.opacity = "0";
        }
    });

    function BtnLogin() {
        document.getElementById('open_login').style.transform = "translateY(0)";
        document.getElementById('open_login').style.opacity = "1";

        document.getElementById('open_register').style.transform = "translateY(-100vh)";
        document.getElementById('open_register').style.opacity = "0";

        menuBtn.classList.remove('open');
        menuOpen = false;
        document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
    }
    function CloseLoginBtn() {
        document.getElementById('open_login').style.transform = "translateY(-100vh)";
        document.getElementById('open_login').style.opacity = "0";
        document.getElementById('open_register').style.transform = "translateY(-100vh)";
        document.getElementById('open_register').style.opacity = "0";
    }
    function BtnRegister() {
        document.getElementById('open_register').style.transform = "translateY(0)";
        document.getElementById('open_register').style.opacity = "1";

        document.getElementById('open_login').style.transform = "translateY(-100vh)";
        document.getElementById('open_login').style.opacity = "0";

        menuBtn.classList.remove('open');
        menuOpen = false;
        document.getElementById('open_nav_container').style.transform = "translateX(-380px)";
    }
    function BtnDropdown() {

        var x = document.getElementById("dropdown_id");
            if (x.style.opacity === "1") {
                x.style.opacity = "0";
                x.style.transform = "translateX(55vh)";

            } else {
                x.style.opacity = "1";
                x.style.transform = "translateX(0)";
            }
    }
   

</script>



<script>
    $(document).ready(function() {
        var id = '<?php echo !empty($_SESSION["student_id"])?$_SESSION["student_id"]:''; ?>'

    function load_unseen_notification(view = '') {

        $.ajax({
        url:"fetch_notification.php",
        method:"POST",
        data:{view:view, id:id},
        dataType:"json",
        success:function(data)
        {
            $('.dropdown-menu').html(data.notification);
            if(data.unseen_notification > 0)
            {
            $('.count').html(data.unseen_notification);
            }
            else {
                document.getElementById('count_red').style.display = "none";
            }
        }
        });
        }
    
    load_unseen_notification();
    
    
    $(document).on('click', '.dropdown-toggle', function(){
    $('.count').html('');
    load_unseen_notification('yes');
    });
    
    setInterval(function(){ 
    load_unseen_notification();; 
    }, 5000);
    
    });
</script>
