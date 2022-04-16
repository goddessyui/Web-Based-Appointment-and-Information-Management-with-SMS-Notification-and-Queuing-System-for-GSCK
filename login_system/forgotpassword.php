<?php
include_once("../dbconfig.php"); 
?>
<div class="form-group">
		<div id="m" class=""></div>
	</div>
<div class="form-group">
		<div id="message_fade" class=""></div>
	</div>

	<form id="username_verify" name="form" method="post">
  
    <div>
  <h1>FORGOT PASSWORD</h1>
</div>
  <div class="form-group">
		<div id="message" class=""></div>
	</div>
    <div class="">
	Enter Username: <input type="text" name="username" id="username" placeholder="Username"/>

    <input type="button" name="btn_verify" class="btn btn-success" value="Next" id="btn_verify" />
	</div>
    
 
	</form>



 
	<form id="otp_verify" name="form2" method="post" style="display:none;">
  <div class="form-group">
		<div id="number" class=""></div>
	</div>
    <label>Enter Verification Code</label>
    <input type="text" name="verification_code" id="verification_code" />
    <input type="button" name="btn_otp_erify" class="btn btn-success" value="Resend" id="btn_otp_resend" disabled/><small id="countdown"></small>
    <div>
    <input type="button" name="btn_otp_erify" class="btn btn-success" value="Verify" id="btn_otp_verify" disabled/>
	</div>
</form>

<input type="hidden" id="hidden_username" />
<input type="hidden" id="hidden_mobile_number" />
<input type="hidden" id="v_number" />
<input type="hidden" id="verify" />


	<form id="change_pass" name="form2" method="post" style="display:none;">
    <div>
  <h1>CHANGE PASSWORD</h1>
</div>
<div class="form-group">
		<div id="message2" class=""></div>
	</div>
    <label>New password</label>
    <div class="">
		<input type="password" name="newpass" id="newpass" placeholder="New password" autocomplete="off"/>
	  </div>
    <div class="">
		<label class="">Password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</label>
	  </div>
    <label>Re-enter new password</label>
    <div class="">
		<input type="password" name="newpass_verify" id="newpass_verify" placeholder="Re-enter new password"autocomplete="off"/>
    <div class="">
    <input type="button" name="btn_change_pass" value="Change Password" id="btn_change_pass" disabled/>
	</div>
</form>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	// VERIFICATION
$(document).ready(function() {

	$('#btn_verify').on('click', function() {
    $('#btn_verify').prop('disabled', true);
		var username = $('#username').val();
		if(username!=""){
			$.ajax({
				url: "forgotpasswordajax.php",
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
			$('#message').html('Please enteryour username !');
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
				url: "forgotpasswordajax.php",
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
						$("#message").html("An error occured while trying to resend, please refresh the page !");        
					}
					
				}
			});
		}
		else{
			$('#message').html('Not Authorized !');
		}
	});
	// RESEND



	// otp VERIFY
	$('#btn_otp_verify').on('click', function() {
    var verification_code = $('#verification_code').val();
		var username = $('#hidden_username').val();
		if(verification_code!=""){
			$.ajax({
				url: "forgotpasswordajax.php",
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
            var timeleft = 30;
						$("#message_fade").html("Verification Success !");
        		$("#message_fade").fadeIn();
						$("#change_pass").show();
            $('#username_verify').hide();
            $('#otp_verify').hide();
						$('#v_number').val(dataResult.verification_no);
            $('#btn_change_pass').prop('disabled', false);		
					}
        
					else if(dataResult.statusCode==202){
						$("#message_fade").html("Incorrect verification code !");
            $("#message_fade").fadeIn();					   			
					}
           
          
					
				}
			});
		}
		else{
			$('#message').html('Please enter the verification code !');
		}
	});
  // OTP verify  


// change pass
$('#btn_change_pass').on('click', function() {
    var verification_code = $('#v_number').val();
		var username = $('#hidden_username').val();
    var new_pass = $('#newpass').val();
    var new_pass_verify = $('#newpass_verify').val();
    var verify = $('#verify').val();
		if(new_pass!=""&&new_pass_verify!=""){
      if (verification_code==""){
        $("#message2").html("An error occured, please refresh the page !");

      }
      else if (username==""){
        $("#message2").html("An error occured, please refresh the page !");

      }
      else if (verify==""){
        $("#message2").html("An error occured, please refresh the page !");

      }
      else if (new_pass.length < 8) {
      $("#message2").html('Your password must be at least 8 characters !!');

        }
      else if (new_pass.length > 16) {
        $("#message2").html('Your password must not exceed 16 characters !!'); 

        }
        else if  (new_pass.search(/[a-z]/i) < 0) {
        $("#message2").html('Your password must contain at least one letter !!');
        }
        else if  (new_pass.search(/[0-9]/) < 0) {
        $("#message2").html('Your password must contain at least one digit !!'); 

        }
      else if (new_pass != new_pass_verify){
        $("#message2").html("Password did not match !");
      }
      else{
			$.ajax({
				url: "forgotpasswordajax.php",
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
          alert(dataResult);
					var dataResult = JSON.parse(dataResult);	
					if(dataResult.statusCode==201){
            var timeleft = 30;	
						$("#change_pass").hide();
						$('#m').html('Password Changed ! ');
						
   					//  setTimeout( function() { location.href = "../index.php" }, 2000 );	
					}
        
					else if(dataResult.statusCode==202){
						$("#message2").html("Incorrect verification code !");				   			
					}
          else if(dataResult.statusCode==203){
						$("#message2").html("'Not Authorized !'");				   			
					}
          
					
				}
			});
    }
		}
		else{
			$('#message2').html('Please fill all the field !');
		}
	});
  // change pass


});
</script>
	