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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
                                    <i class="fa fa-bell-o"><p class="count" id="count_red" style="text-decoration: none; color: #fff;"></p></i>
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
                   
                    <div class="form_div">
                        <div class="input_box">
                            <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" required/>
                            <div class="icon"><i class="fa fa-user"></i></div>
                        </div>

                        <div class="input_box">
                            <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required/>
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

            document.getElementById('dropdown_id').style.opacity = "0";
            document.getElementById('dropdown_id').style.transform = "translateX(55vh)";

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

            } 
            else {
                x.style.opacity = "1";
                x.style.transform = "translateX(0)";
                menuBtn.classList.remove('open');
                menuOpen = false;
                document.getElementById('open_nav_container').style.transform = "translateX(-380px)";

            }
    }
   

</script>




<script>
$(document).ready(function() {
    $('#btn_login').on('click', function() {
        var username = $('#username').val();
        var password = $('#password').val();
        if(username!="" && password!=""){
            $.ajax({
                url: "login_system/loginajax.php",
                type: "POST",
                data: {
                    type:1,	
                    username: username,	
                    password: password						
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        location.href = "index.php"; 
                    }
                    else if(dataResult.statusCode==201){
                        location.href = "admin.php"; 
                    }
                    else if(dataResult.statusCode==202){
                        $('#message').html('Username or Password Incorrect !'); 
                    
                    }
                    else if(dataResult.statusCode==203){
                        $('#message').html('Account not existing in Student record !');  
                    }
                    else if(dataResult.statusCode==204){
                        $('#message').html('Account not existing in Staff record !');
                    }

                    
                }
            });
        }
        else{
            
            $('#message').html('Please fill all the field !');
        }
    });
    // VERIFICATION

    
});
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
            $('.count').html(data.unseen_notification).css({backgroundColor: 'red'});
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
    load_unseen_notification();
    }, 5000);
    
    });
</script>
