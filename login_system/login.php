<?php
include_once("dbconfig.php");
?>
<div class="sign_in_form" id="sign_in">
    <div class="form_container">
       <div class="title">
           <h3>ACCOUNT LOGIN</h3>
           <button onclick="btn_cancel()"><small>Cancel</small></button>
       </div>
        <small>
            Only registered students and staff of GSCK can login or register.
        </small>
        <br>

        <!-- error message -->
        <div class="">
		<small id="message" class="" style="color:red;"></small>
	    </div>
        <!-- error message -->

        <form class="login_form" method="POST">
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
                    <button>Forgot Password?</button>
                </div>
            </div>
            <div class="input_box">
                    <input type="button" name="button_login" class="login_button" value="LOGIN" id="btn_login" />
            </div>
 
    
        </form>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

<style>
    .sign_in_form {
        width: 420px;
        height: 60vh;
        position: fixed;
        top: 80px;
        right: 0;
        display: flex;
        transform: translateX(420px);
        opacity: 0;
        transition: all 0.5s ease-in-out;
        border-top: .5px solid lightgrey;
    }
    .form_container {
        width: 365px;
        height: 55vh;
        padding: 40px;
        background: #fff;
        margin-left: 10px;
    }
    .form_container .title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 34px;
        padding-right: 5px;
        padding-bottom: 10px;
        border-bottom: 1px solid lightgrey;
    }
    .title h3 {
        font-weight: 500;
        font-size: 14px;
    }
    .title button {
        cursor: pointer;
        border: none;
        background: none;
        font-size: 17px;
        color: #DA1212;
    }
    .title button:hover {
        color: red;
    }

    .login_form .input_box {
        height: 36px;
        width: 100%;
        position: relative;
        margin-top: 20px;
    }
    .input_box input {
        height: 100%;
        width: 100%;
        outline: none;
        font-size: 15px;
        padding-left: 45px;
        border: 1px solid lightgrey;
        transition: all .3s ease-in-out;
    }
    .input_box input:focus {
        border-color: #324e9e;
    }
    .input_box .icon {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        color: grey;
    }
    .login_form .option_div {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
    .option_div .check_box {
        display: flex;
        align-items: center;
        padding-left: 5px;
    }
    .option_div span {
        margin-left: 5px;
        font-size: 14px;
        color: #333;
    }
    .option_div .forget_div a{
        font-size: 14px;
        color: #324e9e;
        padding-right: 5px;

    }
    .login_button {
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        border: none;
        padding: 10px 20px;
        background: #324e9e;
        height: 36px;
        width: 100%;
        cursor: pointer;
        transition: all .3s ease-in-out;
        margin-top: 16px;
        letter-spacing: 1px;
    }
    .login_button:hover {
        background: #283E7E;
    }
</style>

<script>
    function btn_login() {
        document.getElementById('sign_in').style.transform = "translateX(0)";
        document.getElementById('sign_in').style.opacity = "1";
        menuBtn.classList.remove('open');
        menuOpen = false;
        document.getElementById('nav').style.transform = "translateX(420px)";
        document.getElementById('nav').style.opacity = "0";
        document.getElementById('regcontainer').style.transform = "translateX(420px)";
        document.getElementById('regcontainer').style.opacity = "0";
    }
    function btn_cancel() {
        document.getElementById('sign_in').style.transform = "translateX(420px)";
        document.getElementById('sign_in').style.opacity = "0";
    }
</script>