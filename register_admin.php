<?php
include_once("header.php");

session_start();

	if(!isset($_SESSION["st_id"]) || !empty($_SESSION["staff_id"]) || !empty($_SESSION["student_id"])){
		echo '<script type="text/javascript">window.location.href="index.php"</script>';
	}


$staff_id_registry = $_SESSION["st_id"];
$query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE staff_id='{$staff_id_registry}'");
$row = $query->fetch_assoc();

?>
<!-- STAFF REGISTRATION -->
<div class="center_container">
	<div class="registration_container">
<!-- DISPLAY AFTER ACCOUNT CREATED -->
<div>
    <h3 id="message_created_account1"></h3>
</div>
<!-- DISPLAY AFTER ACCOUNT CREATED -->


<form id="staff_form" name="form2" method="post">

	<div class="form_group">
		<div id="message3"></div>
	</div>

	<h3>First Time Login Fillup</h3>

	<div class="reg_form_group">
		<p>Student ID: </p>
		<input type="text" name="student_id" id="student_id" value="<?php echo $row["student_id"] ?>" disabled>
	</div>

	<div class="reg_form_group">
		<p>First Name: </p>
		<input type="text" name="first_name1" id="first_name1"  value="<?php echo $row["first_name"] ?>" disabled>
	</div>
	
	<div class="reg_form_group">
		<p>Last Name: </p>
		<input type="text" name="last_name1" id="last_name1"  value="<?php echo $row["last_name"] ?>" disabled>
	</div>
	
	<div class="reg_form_group">
		<p>Username: </p>
		<input type="text" name="username" id="username_reg" placeholder="enter your username" value="<?php echo $row["username"] ?>"/>
	</div>
	
	<div class="reg_form_group">
		<p>Mobile Number: </p>
		<input type="tel" name="number" id="number_reg" placeholder="09683510254"  />
	</div>

    <div class="reg_form_group">
		<p>Position: </p>
		<select name="position2" id="position2">  
    		<option value="Teacher">Teacher</option>  
    		<option value="Accounting Staff/Scholarship Coordinator">Accounting Staff/Scholarship Coordinator</option>  
    	</select>
	</div>

    <div class="reg_form_group">
		<p>Appointment Type: </p>
	</div>
    
	<div class="ap_type">
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

	<div class="reg_form_group">
		<p>Password: </p>
    	<input type="password" name="passwd2" id="passwd2" placeholder="enter a password" autocomplete="off"  />
	</div>

    <div class="form_char">
		<small>Password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</small>
	</div>	

	<div class="reg_form_group">
		<p>Re-enter Password: </p>
    	<input type="password" name="confirm_password2" id="confirm_password2" placeholder="confirm your password" autocomplete="off"  />
	</div>


	<small>By clicking Create Account, you agree to our <a href="PrivacyPolicy.php">Privacy Policy</a></small>


	<div class="reg_form_group right_btn">
		<!-- <input type="button" name="btn_staff" class="btn btn-success" value="Create Account" id="btn_staff"/> -->
    	<button type="button" name="btn_staff" class="btn btn-success" value="Create Account" id="btn_staff">Create Account</button>
	</div>
    
    <div class="form_group">
		<small id="message4" style="color:red;"></small>
	</div>

</form>
<!-- STAFF REGISTRATION -->
</div>
</div>

<style>
	.center_container {
		width: 100%;
		min-height: 100vh;
		background: #0005;
		padding-top: 80px;
		padding-bottom: 80px;
	}
	.registration_container {
		width: 50%;
		margin: 0 auto;
		background: #fff;
		padding: 30px;
	}
	.registration_container form h3 {
		margin-bottom: 40px;
	}
	.reg_form_group {
		height: 28px;
		display: flex;
		align-items: center;
		margin-bottom: 10px;
	}
	.reg_form_group p {
		width: 300px;
		margin-right: 20px;
	}
	.reg_form_group input,
	.reg_form_group select {
		height: 28px;
		width: 100%;
		padding: 5px;
	}
	.reg_form_group button {
		border: none;
		height: 28px;
		width: 120px;
		margin-top: 20px;
		color: #eee;
		background: #324E9E;
		cursor: pointer;
	}
	.form_char {
		margin-bottom: 20px;
		margin-left: 220px;
	}
	.right_btn {
		width: 100%;
		display: flex;
		justify-content: right;
	}
	.ap_type {
		margin-bottom: 20px;
	}
</style>

<script>
// STAFF REGISTRATION
$(document).ready(function() {
	$('#btn_staff').on('click', function() {
		$('#btn_staff').html('<i class="fa fa-spinner fa-spin"></i> Loading'); 
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
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
			$('#message4').html('Only letters and digit characters are allowed for Username!!');
		}
		else if (username.length < 3) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
	
			$('#message4').html('Username must be at least 3 characters!!'); 
    	}
		else if (username.length > 16) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
		
			$('#message4').html('Username must not exceed 16 characters!!'); 
    	}
		else if (!/^[0-9]+$/.test(number)) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
		
			$('#message4').html('Only numbers are allowed for phone numbers!!'); 
		}
		else if (number.length != 11) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
		
			$('#message4').html('Phone number must be at 11 digits!!'); 
		}
		else if (number.substring(0, 2)!='09') {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Incorrect phone number!!'); 
		}
		else if (type=="") {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Put at least one appointment type!!'); 
		}
		else if (password.length < 8) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
		
			$('#message4').html('Password must be at least 8 characters!!'); 
		}
		else if (password.length > 16) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Password must not exceed 16 characters!!'); 
		}
		else if (!/^(?!.* )/.test(password)) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Password must not contain space!!'); 
		}
		else if  (password.search(/[a-z]/i) < 0) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Password must contain at least one letter!!');
		}
		else if  (password.search(/[0-9]/) < 0) {
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);  
			
			$('#message4').html('Password must contain at least one digit!!'); 
		}
		else if (password!=confirm_password) {
			$('#btn_staff').html('Create Account'); 
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
					alert(dataResult);
					var dataResult = JSON.parse(dataResult);
					$('#btn_staff').html('Create Account'); 
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
			$('#btn_staff').html('Create Account'); 
            $("#staff_form :input").prop('disabled', false);    
			
			$('#message4').html('Please fill all the fields!!'); 
		}
	});
});


</script>