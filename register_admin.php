<?php
include_once("header.php");
session_start();
if(!isset($_SESSION["s_id"]) || !isset($_SESSION["first_name"]) || !isset($_SESSION["last_name"]) || !empty($_SESSION["staff_id"]) || !empty($_SESSION["student_id"])){
    echo '<script type="text/javascript">window.location.href="index.php"</script>';
}


?>
<!-- STAFF REGISTRATION -->

<!-- DISPLAY AFTER ACCOUNT CREATED -->
<div>
    <h3 id="message_created_account1"></h3>
</div>
<!-- DISPLAY AFTER ACCOUNT CREATED -->


<form id="staff_form" name="form2" method="post">
	<div class="form_group">
		<div id="message3"></div>
	</div>

	<h1>Sign Up</h1>
    
	<div>
		<label>Staff ID: </label>
    	<input type="text" name="staff_id" id="staff_id" value="<?php echo $_SESSION["s_id"] ?>" readonly>
    </div>
    
    <div>
		<label>First Name: </label>
    	<input type="text" name="first_name2" id="first_name2" value="<?php echo $_SESSION["first_name"] ?>" readonly>
    </div>
    
    <div>
		<label>Last Name: </label>
    	<input type="text" name="last_name2" id="last_name2" value="<?php echo $_SESSION["last_name"] ?>" readonly>
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
		<input type="checkbox" name="check_list[]" value="Meeting">
		<label> Meeting</label><br>
		<input type="checkbox" name="check_list[]" value="Presentation">
		<label> Presentation</label><br>
		<input type="checkbox" name="check_list[]" value="Module Claiming or Submission">
		<label> Module Claiming or Submission</label><br>
		<input type="checkbox" name="check_list[]" value="Project Submission">
		<label> Project Submission</label><br>
		<input type="checkbox" name="check_list[]" value="Evaluation of Grades">
		<label> Evaluation of Grades - Department Head</label><br>
		<input type="checkbox" name="check_list[]" value="UniFAST - Claim Chequet">
		<label> UniFAST - Claim Chequet</label><br>
		<input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents">
		<label> UniFAST - Submit Documents</label><br>
		<input type="checkbox" name="check_list[]" value="Application for Graduation">
		<label> Application for Graduation</label><br>
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


	<small>By clicking Create Account, you agree to our <a href="PrivacyPolicy.php">Privacy Policy</a></small>


	<div class="form_group">
    	<input type="button" name="btn_staff" class="btn btn-success" value="Create Account" id="btn_staff"/>
	</div>
    
    <div class="form_group">
		<small id="message4" style="color:red;"></small>
	</div>

</form>
<!-- STAFF REGISTRATION -->



<script>
// STAFF REGISTRATION
$(document).ready(function() {
	$('#btn_staff').on('click', function() {
        $("#staff_form :input").prop('disabled', true);  
		var staff_id = $('#staff_id').val(); 
		var number = $('#number2').val();
		var position = $('#position2').val();
		var username = $('#username2').val();
		var password = $('#passwd2').val();
		var confirm_password = $('#confirm_password2').val();
		var first_name1 = $('#first_name2').val();
		var last_name1 = $('#last_name2').val();
		var type = [];
        $(':checkbox:checked').each(function(i){
          type[i] = $(this).val();
        });
		if(staff_id!="" && number!="" && position!="" && username!="" && password!="" && confirm_password!="" && first_name1!="" && last_name1!=""){

		if(!/^[a-z A-Z 0-9]+$/.test(username)){
            $("#staff_form :input").prop('disabled', false);  
			$('#message4').html('Only letters and digit characters are allowed for Username!!');
		}
		else if (username.length < 3) {
            $("#staff_form :input").prop('disabled', false);  
	
			$('#message4').html('Username must be at least 3 characters!!'); 
    	}
		else if (username.length > 16) {
            $("#staff_form :input").prop('disabled', false);  
		
			$('#message4').html('Username must not exceed 16 characters!!'); 
    	}
		else if (!/^[0-9]+$/.test(number)) {
            $("#staff_form :input").prop('disabled', false);  
		
			$('#message4').html('Only numbers are allowed for phone numbers!!'); 
		}
		else if (number.length != 11) {
            $("#staff_form :input").prop('disabled', false);  
		
			$('#message4').html('Phone number must be at 11 digits!!'); 
		}
		else if (number.substring(0, 2)!='09') {
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Incorrect phone number!!'); 
		}
		else if (type=="") {
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Put at least one appointment type!!'); 
		}
		else if (password.length < 8) {
            $("#staff_form :input").prop('disabled', false);  
		
			$('#message4').html('Password must be at least 8 characters!!'); 
		}
		else if (password.length > 16) {
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Password must not exceed 16 characters!!'); 
		}
		else if (!/^(?!.* )/.test(password)) {
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Password must not contain space!!'); 
		}
		else if  (password.search(/[a-z]/i) < 0) {
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Password must contain at least one letter!!');
		}
		else if  (password.search(/[0-9]/) < 0) {
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Password must contain at least one digit!!'); 
		}
		else if (password!=confirm_password) {
            $("#staff_form :input").prop('disabled', false);  
			
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
						$("#staff_form").hide();
						$('#message_created_account1').html('Account Created!! ');
						
   					 setTimeout( function() { location.href = "admin.php" }, 500 );
											
					}
					else if(dataResult.statusCode==202){
                        $("#staff_form :input").prop('disabled', false);  
						
						$('#message4').html('An error has occured. Please try again!!'); 
					}
					else if(dataResult.statusCode==203){
                        $("#staff_form :input").prop('disabled', false);  
						
						$('#message4').html('Username '+dataResult.username+' has already been taken!!'); 
					}
					else if(dataResult.statusCode==204){
                        $("#staff_form :input").prop('disabled', false);  
						
						$('#message4').html('Another account is already using the mobile number you entered!!'); 
					}
					
				}
			});
		}
	}
		else{
            $("#staff_form :input").prop('disabled', false);    
			
			$('#message4').html('Please fill all the fields!!'); 
		}
	});
});


</script>