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
                <div class="form_container_div">
                    <button class="bg-outer" onclick="CloseLoginBtn()">
                        <div class="outer">
                            <div class="inner">
                                <label>EXIT</label>
                            </div>
                        </div>
                    </button>
                    <!----login form---->
                    <div class="login_form_div" id="login_form_div_id">
                        <form method="post">

                            <div class="input_box">
                                <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" />
                                <div class="icon"><i class="fa fa-user"></i></div>
                            </div>

                            <div class="input_box">
                                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" />
                                <div class="icon"><i class="fa fa-lock"></i></div>
                            </div>

                            <div class="input_box">
                                <input type="button" name="button_login" class="login_button" value="LOGIN" id="btn_login" />
                            </div>

                        </form>

                        <div class="option_div">
                            <button onclick="ForgotPassword()">Forgot Password?</button>
                        </div>

                        <small id="message"></small>
                    </div>
                     <!----forgotpass form---->
                    <div class="forgot_pass_div" id="forgot_pass_div_id">
                        <h1>forgotpass</h1>





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
                            <div>
                                <h1>FORGOT PASSWORD</h1>
                            </div>

                            <div>
                                <label>Enter Username: </label>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                                <input type="button" name="btn_verify" class="btn btn-success" value="Next" id="btn_verify" />
                            </div>

                            <!-- message for errors -->
                            <div class="form-group">
                                <small id="message" style="color:red;"></small>
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








                        <button onclick="BackToLogin()">
                            <img src="icon/back-arrow.png">
                        </button>
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
						$('#message').html('Username or Password Incorrect !'); 
					
					}
                    else if(dataResult.statusCode==203){
                        $('#btn_login').prop('disabled', false);
						$('#message').html('Account not existing in records !');  
					}
                    else if(dataResult.statusCode==204){
                        $('#btn_login').prop('disabled', false);
						$('#message').html('Account not existing in records !');
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









<script>
	// VERIFICATION
$(document).ready(function() {

	$('#btn_verify').on('click', function() {
    $('#btn_verify').prop('disabled', true);
		var username = $('#username').val();
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
						$('#message1').html("Incorrect verification code !");
            			$('#btn_otp_verify').prop('disabled', false);					   			
					}
           
          
					
				}
			});
		}
		else{
      		$('#btn_otp_verify').prop('disabled', false);		
			$('#message1').html('Please enter the verification code !');
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
					$("#message2").html("Incorrect verification code !");				   			
					}
          			else if(dataResult.statusCode==203){
            		$('#btn_change_pass').prop('disabled', false);
					$("#message2").html("'Not Authorized !'");				   			
					}	
				}
			});
    	}
		}
		else{
      		$('#btn_change_pass').prop('disabled', false);
			$('#message2').html('Please fill all the field !');
		}
	});
  // change pass


});
</script>
	