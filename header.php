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
    <link rel="stylesheet" type="text/css" href="css/home_style.css">
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
                <?php 
                    if(isset($_SESSION['student_id'])){
                    ?>
                    <a href="student_profile.php"><h4>Profile Setting</h4></a>
                    <a href="student_appointment_details.php"><button class="button_ma" >My Appointments</button></a>
                    <?php
                    }
		        ?>

                <a href="index.php" class="a_link_after"><li>Home</li></a>
                <a href="about.php" class="a_link_after"><li>About</li></a>
                
                <a href="announcements.php" class="a_link_after"><li>Announcements</li></a>
                <a href="schedules.php" class="a_link_after"><li>Staff Schedule</li></a>
                <a href="contact.php" class="a_link_after"><li>Contact</li></a>
                <?php 
                        if (isset($_SESSION['student_id'])) {
                ?>
                            <a href="student_appointment.php"><button class="button_saa">Set an appointment</button></a>
                <?php
                        }
                        else {
                ?>
                           <button class="button_saa" onclick="BtnLogin()">Set an appointment</button>
                <?php
                }
                ?>

            </ul>
        </nav>
    </div>






    <div class="login_sidebar" id="open_login">
        <div class="login_form_container">
            <div class="form_content">

                <div class="gsck_img"></div>

                <div class="form_container_div">

                    <button class="bg-outer" onclick="CloseLoginBtn()">
                        <div class="outer">
                            <div class="inner">
                                <label>EXIT</label>
                            </div>
                        </div>
                    </button>


                    <!----login form------------------->
                    <div class="login_form_div" id="login_form_div_id">
                        <form method="post">
                            <h2>Sign in account</h2>
                            <p>WELCOME STAFF AND STUDENTS of GOLDENSTATE COLLEGE OF KORONADAL</p>
                            <div class="input_box">
                                <div class="icon"><i class="fa fa-user"></i></div>
                                <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" />
                            </div>

                            <div class="input_box">
                                <div class="icon"><i class="fa fa-lock"></i></div>
                                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" />
                            </div>

                            <div class="input_button_div">
                                <input type="button" name="button_login" class="login_button" value="LOGIN" id="btn_login" />
                            </div>

                        </form>

                        <div class="option_div">
                            <button onclick="ForgotPassword()">Forgot Password?</button>
                        </div>

                        <p id="message"></p>
                    </div>







                     <!----forgotpass form---->
                    <div class="forgot_pass_div" id="forgot_pass_div_id">

                        <h2>forgotpass</h2>

                    <!-- MESSAGE AFTER CHANGGING NEW PASSWORD SUCCESSFULLY -->
                        <div class="form-group">
                            <div id="m"></div>
                        </div>


                    <!-- POP UP THATS FADES OUT MESSAGE AFTER VERIFYING -->
                        <div class="form-group">
                            <div id="message_fade"></div>
                        </div>


                    <!-- FORM FOR USERNAME VERIFICATION -->
                        <form id="username_verify" name="form" method="post">
                            <div class="go_back_pass">
                                <button onclick="BackToLogin()"><a href="#">Go Back</a></button>
                                <h3>FORGOT PASSWORD</h3>
                            </div>

                            <div class="input_n_button">
                                <span><i class="fa fa-user"></i></span>
                                <input type="text" name="forgot_username" id="forgot_username" placeholder="Enter your username"/>
                            </div>

                            <input type="button" name="btn_verify" class="btn_success" value="Next" id="btn_verify" />

                            <!-- message for errors -->
                            <div class="form-group">
                                <p id="message"></p>
                            </div>
                            <!-- message for errors -->
                        </form>
                    <!-- FORM FOR USERNAME VERIFICATION -->


                    <!-- FORM FOR VERIFYING CODE -->
                        <form id="otp_verify" name="form2" method="post" style="display:none;">
                            <div class="form-group">
                                <div id="number"></div>
                            </div>

                            <div>
                                <label>Enter Verification Code</label>
                                <input type="text" name="verification_code" id="verification_code" />
                                <input type="button" name="btn_otp_verify" class="btn btn-success" value="Resend" id="btn_otp_resend" disabled/><small id="countdown"></small>
                            </div>

                            <div>
                                <input type="button" name="btn_otp_verify" class="btn btn-success" value="Verify" id="btn_otp_verify" disabled/>
                            </div>

                            <!-- message for errors -->
                            <div class="form-group">
                                <small id="message1" style="color:red;"></small>
                            </div>
                        </form>
                    <!-- FORM FOR VERIFYING CODE -->


                    <!-- hidden data -->
                    <input type="hidden" id="hidden_username" />
                    <input type="hidden" id="hidden_mobile_number" />
                    <input type="hidden" id="v_number" />
                    <input type="hidden" id="verify" />
                    <!-- hidden data -->


                    <!-- FORM FOR CHANGE PASSWORD  -->
                        <form id="change_pass" name="form2" method="post" style="display:none;">
                            <div>
                                <h1>CHANGE PASSWORD</h1>
                            </div>	

                            <div>
                                <label>New password</label>
                                <input type="password" name="newpass" id="newpass" placeholder="New password" autocomplete="off"/>
                            </div>

                            <div>
                                <small class="">Password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</small>
                            </div>

                            <div>
                                <label>Re-enter new password</label>
                                <input type="password" name="newpass_verify" id="newpass_verify" placeholder="Re-enter new password"autocomplete="off"/>
                            </div>

                            <div>
                                <input type="button" name="btn_change_pass" value="Change Password" id="btn_change_pass" disabled/>
                            </div>

                            <!-- message for errors -->
                            <div class="form-group">
                                <small id="message2" style="color:red;"></small>
                            </div>
                            <!-- message for errors -->
                        </form>
                    <!-- FORM FOR CHANGE PASSWORD  -->

                    </div>
            
                </div>
            </div>
        </div>
    </div>




    <div class="register_sidebar"  id="open_register">
        <div class="register_container">
            <div class="form_content">

                <div class="gsck_img"></div>
                <div class="form_container_div">
                    <button class="bg-outer" onclick="CloseLoginBtn()">
                        <div class="outer">
                            <div class="inner">
                                <label>EXIT</label>
                            </div>
                        </div>
                    </button>


                        <!-- DISPLAY AFTER ACCOUNT CREATED -->
                        <div class="form_group" id='m' style="display:none;">
                            <h3 id="message_created_account"></h3>
                        </div>
                        <!-- DISPLAY AFTER ACCOUNT CREATED -->
                            

                        <!-- VERIFICATION -->
                        <form id="verification_form" name="form1" method="post">
                            <div class="form_group">
                                <h1>Verify</h1>
                            </div>

                            <div class="form_group">
                                <label>Student/Staff ID</label>
                                <input type="text" name="s_id" id="s_id" placeholder="Your Student/Staff ID">
                            </div>

                            <div class="form_group">
                                <label>First Name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="Your First Name" >
                            </div>

                            <div class="form_group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Your Last Name" >
                            </div>


                            <div class="form_group">
                                <input type="button" name="btn_verify" class="btn btn-success" value="Verify" id="btn_verify_reg" />
                            </div>
                            

                            <div class="form_group">
                                <small id="message_reg" style="color:red;"></small>
                            </div>

                        </form>
                            <!-- VERIFICATION -->





                        <!-- STUDENT REGISTRATION -->
                        <form id="student_form" name="form2" method="post" style="display:none;">
                            <div class="form_group">
                                <div id="message1"></div>
                            </div>

                            <h1>Sign Up</h1>
                            <div>
                                <label>Student ID: </label>
                                <input type="text" name="student_id" id="student_id" readonly>
                            </div>

                            <div>
                                <label>First Name: </label>
                                <input type="text" name="first_name1" id="first_name1" readonly>
                            </div>
                            
                            <div>
                                <label>Last Name: </label>
                                <input type="text" name="last_name1" id="last_name1" readonly>
                            </div>
                            
                            <div>
                                <label>Username: </label>
                                <input type="text" name="username" id="username_reg" placeholder="enter a username" />
                            </div>
                            
                            <div>
                                <label>Mobile Number: </label>
                                <input type="tel" name="number" id="number_reg" placeholder="09683510254"  />
                            </div>

                            <div>
                                <label>Course: </label>
                                <select name="course" id="course">  
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

                            <div>
                                <label>Year: </label> 
                                <select name="year" id="year">  
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>

                            <div class>
                                <label>Password: </label>
                                <input type="password" name="passwd" id="passwd" placeholder="enter a password" autocomplete="off" />
                            </div>

                            <div>
                                <small>password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</small>
                            </div>

                            <div>
                                <label>Re-enter Password: </label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="confirm your password" autocomplete="off" />
                            </div>


                            <div class="form_group">
                                <input type="button" name="btn_student" class="btn btn-success" value="Create Account" id="btn_student" disabled/>
                            </div>
                            

                            <div class="form_group">
                                <small id="message2" style="color:red;"></small>
                            </div>
                        </form>
                        <!-- STUDENT REGISTRATION -->




                        <!-- STAFF REGISTRATION -->
                        <form id="staff_form" name="form2" method="post" style="display:none;">
                            <div class="form_group">
                                <div id="message3"></div>
                            </div>

                            <h1>Sign Up</h1>
                            
                            <div>
                                <label for="staff_id">Staff ID: </label>
                                <input type="text" name="staff_id" id="staff_id" readonly>
                            </div>
                            
                            <div>
                                <label>First Name: </label>
                                <input type="text" name="first_name2" id="first_name2" readonly>
                            </div>
                            
                            <div>
                                <label>Last Name: </label>
                                <input type="text" name="last_name2" id="last_name2" readonly>
                            </div>

                            <div>
                                <label>Username: </label>
                                <input type="text" name="username2" id="username2" placeholder="enter a username" />
                            </div>

                            <div>
                                <label>Phone Number: </label>
                                <input type="tel" name="number2" id="number2" placeholder="09683510254"  />
                            </div>

                            <div>
                                <label>Position: </label>
                                <select name="position2" id="position2">  
                                    <option value="Teacher">Teacher</option>  
                                    <option value="Accounting Staff/Scholarship Coordinator">Accounting Staff/Scholarship Coordinator</option>  
                                </select>
                            </div>

                            <div>
                                <label>Appointment Type: </label>
                            </div>
                            
                            <div>
                                <input type="checkbox" name="check_list[]" value="Evaluation of Grades">
                                <span class="">Evaluation of Grades - Department Head</span><br>
                                <input type="checkbox" name="check_list[]" value="UniFAST - Claim Chequet">
                                <span>UniFAST - Claim Chequet</span><br>
                                <input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents">
                                <span> UniFAST - Submit Documents</span><br>
                                <input type="checkbox" name="check_list[]" value="Meeting">
                                <span> Meeting</span><br>
                                <input type="checkbox" name="check_list[]" value="Module Claiming/Submission">
                                <span> Module Claiming/Submission</span><br>
                                <input type="checkbox" name="check_list[]" value="Project Submission">
                                <span> Project Submission</span><br>
                                <input type="checkbox" name="check_list[]" value="Presentation">
                                <span> Presentation</span><br>
                            </div>

                            <div>
                                <label>Password: </label>
                                <input type="password" name="passwd2" id="passwd2" placeholder="enter a password" autocomplete="off"  />
                            </div>

                            <div>
                                <small>Password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</small>
                            </div>	

                            <div>
                                <label>Re-enter Password: </label>
                                <input type="password" name="confirm_password2" id="confirm_password2" placeholder="confirm your password" autocomplete="off"  />
                            </div>

                            <div class="form_group">
                                <input type="button" name="btn_staff" class="btn btn-success" value="Create Account" id="btn_staff" disabled/>
                            </div>
                            
                            <div class="form_group">
                                <small id="message4" style="color:red;"></small>
                            </div>

                        </form>
                        <!-- STAFF REGISTRATION -->

                </div>
                
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

        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

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

 
        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";

        document.getElementById('at_all').style.transform = "translateY(-90vh)";
        document.getElementById('at_all').style.opacity = "0";

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

        document.getElementById('at_meeting').style.transform = "translateY(-90vh)";
        document.getElementById('at_meeting').style.opacity = "0";

        document.getElementById('at_enrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_enrollment').style.opacity = "0";

        document.getElementById('at_evaluationofgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_evaluationofgrades').style.opacity = "0";

        document.getElementById('at_modulesubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_modulesubmission').style.opacity = "0";

        document.getElementById('at_preenrollment').style.transform = "translateY(-90vh)";
        document.getElementById('at_preenrollment').style.opacity = "0";

        document.getElementById('at_presentation').style.transform = "translateY(-90vh)";
        document.getElementById('at_presentation').style.opacity = "0";

        document.getElementById('at_projectsubmission').style.transform = "translateY(-90vh)";
        document.getElementById('at_projectsubmission').style.opacity = "0";

        document.getElementById('at_requestdocuments').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestdocuments').style.opacity = "0";

        document.getElementById('at_unifastcc').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastcc').style.opacity = "0";

        document.getElementById('at_unifastsd').style.transform = "translateY(-90vh)";
        document.getElementById('at_unifastsd').style.opacity = "0";

        document.getElementById('at_requestforgrades').style.transform = "translateY(-90vh)";
        document.getElementById('at_requestforgrades').style.opacity = "0";
        
        document.getElementById('at_appforgrad').style.transform = "translateY(-90vh)";
        document.getElementById('at_appforgrad').style.opacity = "0";
            }
    }
   
    function ForgotPassword() {
        document.getElementById('login_form_div_id').style.display = "none";
        document.getElementById('forgot_pass_div_id').style.display = "block"
    }
    function BackToLogin() {
        document.getElementById('login_form_div_id').style.display = "block";
        document.getElementById('forgot_pass_div_id').style.display = "none"
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
                        $('#message').html('Username or Password Incorrect!'); 
                    
                    }
                    else if(dataResult.statusCode==203){
                        $('#message').html('Account not existing in Student record!');  
                    }
                    else if(dataResult.statusCode==204){
                        $('#message').html('Account not existing in Staff record!');
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

<!-----------------Script for notification------------------------------->
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


<script>
$(document).ready(function() {
	$('#btn_login').on('click', function() {
        $('#btn_login').prop('disabled', true);
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
                        $('#btn_login').prop('disabled', false);
						$('#message').html('Username or Password Incorrect!'); 
					
					}
                    else if(dataResult.statusCode==203){
                        $('#btn_login').prop('disabled', false);
						$('#message').html('Account not existing in records!');  
					}
                    else if(dataResult.statusCode==204){
                        $('#btn_login').prop('disabled', false);
						$('#message').html('Account not existing in records!');
					}

					
				}
			});
		}
		else{
            $('#btn_login').prop('disabled', false);
			$('#message').html('Please fill all the field !');
		}
	});
	// VERIFICATION

	
});
</script>






<!-----------------Script for forgotpassword------------------------------->

<script>
	// VERIFICATION
$(document).ready(function() {

	$('#btn_verify').on('click', function() {
    $('#btn_verify').prop('disabled', true);
		var username = $('#forgot_username').val();
		if(username!=""){
			$.ajax({
				url: "login_system/forgotpasswordajax.php",
				type: "POST",
				data: {
					type: 1,
					username: username					
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);	
					if(dataResult.statusCode==201){
            			var timeleft = 30;
						$("#message_fade").html("Student Verified !");
        				setInterval(function() { $("#message_fade").fadeOut(); }, 1000);

                		var downloadTimer = setInterval(function() {
                  		if(timeleft <= 0){
                		clearInterval(downloadTimer);
                		$('#btn_otp_resend').prop('disabled', false);
                		document.getElementById("countdown").innerHTML = "";
                		} else {
                		document.getElementById("countdown").innerHTML = timeleft;
                		}timeleft -= 1; }, 1000);
						$("#otp_verify").show();
           			 	$('#btn_verify').hide();
						$('#message').hide();
            			$('#username').prop('disabled', true);
            			$('#btn_otp_verify').prop('disabled', false);
            			$('#number').html('<small>We send to your number 09****'+dataResult.mobile_number.slice(-2)+'</small>');  
						$('#hidden_username').val(dataResult.username);
            			$('#hidden_mobile_number').val(dataResult.mobile_number);
            			$('#verify').val(dataResult.verify);

					}
					else if(dataResult.statusCode==202){
            			var timeleft = 30;
						$("#message_fade").html("Staff Verified !");
            			setInterval(function() { $("#message_fade").fadeOut(); }, 1000);

                		var downloadTimer = setInterval(function() {
                  		if(timeleft <= 0){
                		clearInterval(downloadTimer);
                		$('#btn_otp_resend').prop('disabled', false);
                		document.getElementById("countdown").innerHTML = "";
                		} else {
                		document.getElementById("countdown").innerHTML = timeleft;
                		}timeleft -= 1;}, 1000);
						$("#otp_verify").show();
           		 		$('#btn_verify').hide();
						$('#message').hide();
            			$('#username').prop('disabled', true);
            			$('#btn_otp_verify').prop('disabled', false);						
            			$('#number').html('<small>We send to your number 09****'+dataResult.mobile_number.slice(-2)+'</small>');  
						$('#hidden_username').val(dataResult.username);
            			$('#hidden_mobile_number').val(dataResult.mobile_number);	
            			$('#verify').val(dataResult.verify);				
					}
                    else if(dataResult.statusCode==203){
                  		$('#btn_verify').prop('disabled', false);
						$('#message').html('Username not found !');  
					}
          
					
				}
			});
		}
		else{
      		$('#btn_verify').prop('disabled', false);
			$('#message').html('Please enter your username !');
		}
	});
	// VERIFICATION


  // resend
	$('#btn_otp_resend').on('click', function() {
    $('#btn_otp_resend').prop('disabled', true);
		var username1 = $('#hidden_username').val();
    	var mobile_number = $('#hidden_mobile_number').val();	
		if(username1!="" && mobile_number!=""){
			$.ajax({
				url: "login_system/forgotpasswordajax.php",
				type: "POST",
				data: {
					type: 3,
          			username: username1,
          			mobile_number: mobile_number	
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);	
					if(dataResult.statusCode==201){ 
            		var timeleft = 30;
                	var downloadTimer = setInterval(function() {
                  	if(timeleft <= 0){
                	clearInterval(downloadTimer);
                	$('#btn_otp_resend').prop('disabled', false);
                	document.getElementById("countdown").innerHTML = "";
                	} else {
                	document.getElementById("countdown").innerHTML = timeleft;
                	}timeleft -= 1; }, 1000);              
					}
					else if(dataResult.statusCode==202){ 
            			$('#btn_otp_resend').prop('disabled', false);
						$("#message1").html("An error occured while trying to resend, please refresh the page !");        
					}
					
				}
			});
		}
		else{
			$('#message1').html('Not Authorized !');
		}
	});
	// RESEND



	// otp VERIFY
	$('#btn_otp_verify').on('click', function() {
    $('#btn_otp_verify').prop('disabled', true);		
    var verification_code = $('#verification_code').val();
		var username = $('#hidden_username').val();
		if(verification_code!=""){
			$.ajax({
				url: "login_system/forgotpasswordajax.php",
				type: "POST",
				data: {
					type: 2,
					username: username,
          			verification_code: verification_code				
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);	
					if(dataResult.statusCode==201){
						$("#message_fade").html("Verification Success !");
        				$("#message_fade").fadeIn();
						$("#change_pass").show();
            			$('#username_verify').hide();
            			$('#otp_verify').hide();
						$('#v_number').val(dataResult.verification_no);
            			$('#btn_change_pass').prop('disabled', false);		
					}
        
					else if(dataResult.statusCode==202){
						$('#message1').html("Incorrect verification code!");
            			$('#btn_otp_verify').prop('disabled', false);					   			
					}
           
          
					
				}
			});
		}
		else{
      		$('#btn_otp_verify').prop('disabled', false);		
			$('#message1').html('Please enter the verification code!');
		}
	});
  // OTP verify  


// change pass
$('#btn_change_pass').on('click', function() {
  $('#btn_change_pass').prop('disabled', true);	
    var verification_code = $('#v_number').val();
	var username = $('#hidden_username').val();
    var new_pass = $('#newpass').val();
    var new_pass_verify = $('#newpass_verify').val();
    var verify = $('#verify').val();
	if(new_pass!=""&&new_pass_verify!=""){
      if (verification_code==""){
        $('#btn_change_pass').prop('disabled', false);
        $("#message2").html("An error occured, please refresh the page !");
      	}
      	else if (username==""){
        $('#btn_change_pass').prop('disabled', false);
        $("#message2").html("An error occured, please refresh the page !");
      	}
      	else if (verify==""){
        $('#btn_change_pass').prop('disabled', false);
        $("#message2").html("An error occured, please refresh the page !");
      	}
      	else if (new_pass.length < 8) {
        $('#btn_change_pass').prop('disabled', false);
      	$("#message2").html('Password must be at least 8 characters !!');
        }
      	else if (new_pass.length > 16) {
        $('#btn_change_pass').prop('disabled', false);
        $("#message2").html('Password must not exceed 16 characters !!'); 
        }
		else if (!/^(?!.* )/.test(new_pass)) {
		$('#btn_change_pass').prop('disabled', false);
		$('#message2').html('Password must not contain space !!'); 
		}
        else if  (new_pass.search(/[a-z]/i) < 0) {
        $('#btn_change_pass').prop('disabled', false);
        $("#message2").html('Password must contain at least one letter !!');
        }
        else if  (new_pass.search(/[0-9]/) < 0) {
        $('#btn_change_pass').prop('disabled', false);
        $("#message2").html('Password must contain at least one digit !!'); 
        }
      	else if (new_pass != new_pass_verify){
        $('#btn_change_pass').prop('disabled', false);
        $("#message2").html("Password did not match !");
      	}
      	else{
			$.ajax({
				url: "login_system/forgotpasswordajax.php",
				type: "POST",
				data: {
					type: 4,
					username: username,
          			verification_code: verification_code,
          			new_pass: new_pass,
          			verify:verify			
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);	
					if(dataResult.statusCode==201){
            		var timeleft = 30;	
					$("#change_pass").hide();
					$('#m').html('Password Changed ! Redirecting to Index . . .');
   					setTimeout( function() { location.href = "../index.php" }, 2000 );	
					}
					else if(dataResult.statusCode==202){
            		$('#btn_change_pass').prop('disabled', false);
					$("#message2").html("Incorrect verification code!");				   			
					}
          			else if(dataResult.statusCode==203){
            		$('#btn_change_pass').prop('disabled', false);
					$("#message2").html("'Not Authorized!'");				   			
					}	
				}
			});
    	}
		}
		else{
      		$('#btn_change_pass').prop('disabled', false);
			$('#message2').html('Please fill all the field!');
		}
	});
  // change pass


});
</script>


<!-----------------Script for registration------------------------------->

<script>
	// VERIFICATION
$(document).ready(function() {
	$('#btn_verify_reg').on('click', function() {
		$('#btn_verify_reg').prop('disabled', true);
		var s_id = $('#s_id').val();
		var first_name 	 = $('#first_name').val().toLowerCase();
		var last_name = $('#last_name').val().toLowerCase();
		if(s_id!="" && first_name!="" && last_name!=""){
			$.ajax({
				url: "login_system/registrationajax.php",
				type: "POST",
				data: {
					type: 1,
					s_id: s_id,
					first_name: first_name,
					last_name: last_name					
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);	
					if(dataResult.statusCode==201){
						$("#message1").html("Student Verified !");
        				setInterval(function() { $("#message1").fadeOut(); }, 1000);
						$('#btn_student').prop('disabled', false);
						$("#student_form").show();
						$("#verification_form").hide();
						$('#student_id').val(dataResult.student_id);
						$('#first_name1').val(dataResult.first_name);
						$('#last_name1').val(dataResult.last_name);

					}
					else if(dataResult.statusCode==202){
						$("#message3").html("Staff Verified !");
        				setInterval(function() { $("#message3").fadeOut(); }, 1000);
						$('#btn_staff').prop('disabled', false);
						$("#staff_form").show();
						$("#verification_form").hide();
						$('#staff_id').val(dataResult.staff_id);
						$('#first_name2').val(dataResult.first_name);
						$('#last_name2').val(dataResult.last_name);
					
					}
                    else if(dataResult.statusCode==203){
						$('#btn_verify_reg').prop('disabled', false);
						$('#message_reg').html('Student/Staff ID is already been singed up !');  
					}
                    else if(dataResult.statusCode==204){
						$('#btn_verify_reg').prop('disabled', false);
						$('#message_reg').html('Not on the list ! ');
					}
					
				}
			});
		}
		else{
			$('#btn_verify_reg').prop('disabled', false);
			$('#message_reg').html('Please fill all the field !');
		}
	});
	// VERIFICATION

	// STUDENT REGISTRATION
	$('#btn_student').on('click', function() {
		$('#btn_student').prop('disabled', true);
		var student_id = $('#student_id').val();
		var number = $('#number_reg').val();
		var course = $('#course').val();
		var username = $('#username_reg').val();
		var year = $('#year').val();
		var password = $('#passwd').val();
		var confirm_password = $('#confirm_password').val();
		var first_name1 	 = $('#first_name1').val();
		var last_name1 = $('#last_name1').val();

		if(student_id!="" && number!="" && course!="" && username!="" && year!="" && password!="" && confirm_password!="" && first_name!="" && last_name!=""){

		if(!/^[a-z A-Z 0-9]+$/.test(username)){
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Username only letter and digit characters are allowed!!');
		}
		else if (username.length < 3) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Username must be at least 3 characters!!'); 
    	}
		else if (username.length > 16) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Username must not exceed 16 characters!!'); 
    	}
		else if (!/^[0-9]+$/.test(number)) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Phone number only a number character!!'); 
    	}
		else if (number.length != 11) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Phone number must be at 11 characters!!'); 
		}
		else if (number.substring(0, 2)!='09') {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Incorrect phone number!!'); 
		}
		else if (password.length < 8) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must be at least 8 characters!!'); 
		}
		else if (password.length > 16) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must not exceed 16 characters!!'); 
		}
		else if (!/^(?!.* )/.test(password)) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must not contain space!!'); 
		}
		else if  (password.search(/[a-z]/i) < 0) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must contain at least one letter!!');
		}
		else if  (password.search(/[0-9]/) < 0) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must contain at least one digit!!'); 
		}
		else if (password!=confirm_password) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password did not match!!'); 
		}
		else{
			$.ajax({
				url: "login_system/registrationajax.php",
				type: "POST",
				data: {
					type:2,
					student_id:student_id,
					number: number,
					first_name: first_name1,
					last_name: last_name1,	
					course: course,	
					username: username,	
					year: year,	
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==201){
						$("#m").show();
						$("#student_form").hide();
						$('#message_created_account').html('Account Created !');
   					 setTimeout( function() { location.href = "index.php" }, 1500 );
										
					}
					else if(dataResult.statusCode==202){
						$('#btn_student').prop('disabled', false);
						$('#message2').html('An error has occured please try again !!'); 
					}
					else if(dataResult.statusCode==203){
						$('#btn_student').prop('disabled', false);
						$('#message2').html('Username '+dataResult.username+' has already been taken !!'); 
					}
					else if(dataResult.statusCode==204){
						$('#btn_student').prop('disabled', false);
						$('#message2').html('Another account is already using the mobile number you entered!!'); 
					}
					
				}
			});
		}
	}
		else{
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Please fill all the field !'); 
		}
	});

	// STAFF REGISTRATION
	$('#btn_staff').on('click', function() {
		$('#btn_staff').prop('disabled', true);
		var staff_id = $('#staff_id').val(); 
		var number = $('#number2').val();
		var position = $('#position2').val();
		var username = $('#username2').val();
		var password = $('#passwd2').val();
		var confirm_password = $('#confirm_password2').val();
		var first_name1 	 = $('#first_name2').val();
		var last_name1 = $('#last_name2').val();
		var type = [];
        $(':checkbox:checked').each(function(i){
          type[i] = $(this).val();
        });
		if(student_id!="" && number!="" && course!="" && username!="" && year!="" && password!="" && confirm_password!="" && first_name!="" && last_name!=""){

		if(!/^[a-z A-Z 0-9]+$/.test(username)){
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Only letters and digit characters are allowed for Username!!');
		}
		else if (username.length < 3) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Username must be at least 3 characters!!'); 
    	}
		else if (username.length > 16) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Username must not exceed 16 characters!!'); 
    	}
		else if (!/^[0-9]+$/.test(number)) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Only numbers are allowed for phone numbers!!'); 
		}
		else if (number.length != 11) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Phone number must be at 11 digits!!'); 
		}
		else if (number.substring(0, 2)!='09') {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Incorrect phone number!!'); 
		}
		else if (type=="") {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Put at least one appointment type!!'); 
		}
		else if (password.length < 8) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must be at least 8 characters!!'); 
		}
		else if (password.length > 16) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must not exceed 16 characters!!'); 
		}
		else if (!/^(?!.* )/.test(password)) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must not contain space!!'); 
		}
		else if  (password.search(/[a-z]/i) < 0) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must contain at least one letter!!');
		}
		else if  (password.search(/[0-9]/) < 0) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must contain at least one digit!!'); 
		}
		else if (password!=confirm_password) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password did not match!!'); 
		}
		else{
			$.ajax({
				url: "login_system/registrationajax.php",
				type: "POST",
				data: {
					type:3,
					staff_id:staff_id,
					number: number,
					first_name: first_name1,
					last_name: last_name1,	
					position: position,	
					username: username,	
					types: type,	
					password: password						
				},
				cache: false,
				success: function(dataResult){
					$('#message4').html(dataResult); 
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==201){
						$("#m").show();
						$("#staff_form").hide();
						$('#message_created_account').html('Account Created!! ');
						
   					 setTimeout( function() { location.href = "admin.php" }, 1500 );
											
					}
					else if(dataResult.statusCode==202){
						$('#btn_staff').prop('disabled', false);
						$('#message4').html('An error has occured. Please try again!!'); 
					}
					else if(dataResult.statusCode==203){
						$('#btn_staff').prop('disabled', false);
						$('#message4').html('Username '+dataResult.username+' has already been taken!!'); 
					}
					else if(dataResult.statusCode==204){
						$('#btn_staff').prop('disabled', false);
						$('#message4').html('Another account is already using the mobile number you entered!!'); 
					}
					
				}
			});
		}
	}
		else{
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Please fill all the fields!!'); 
		}
	});


});
</script>
	