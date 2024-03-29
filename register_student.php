<?php
include_once("header.php");

session_start();
if(!isset($_SESSION["stu_id"]) || !empty($_SESSION["staff_id"]) || !empty($_SESSION["student_id"])){
    echo '<script type="text/javascript">window.location.href="index.php"</script>';
}

$student_id_registry = $_SESSION["stu_id"];
$query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id_registry}'");
$row = $query->fetch_assoc();
?>


<!-- STUDENT REGISTRATION -->
<div class="center_container">
	<div class="registration_container">
                <!-- DISPLAY AFTER ACCOUNT CREATED -->
                <div>
                <h3 id="message_created_account1"></h3>
                </div>
                <!-- DISPLAY AFTER ACCOUNT CREATED -->


                    <form id="student_form" name="form2" method="post">

                            <div class="form_group">
                                <div id="message1"></div>
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
								<p>Course: </p>
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

                            <div class="reg_form_group">
								<p>Year: </p>
                                <select name="year" id="year">
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>

                            <div class="reg_form_group">
								<p>Password: </p>
                                <input type="password" name="passwd" id="passwd" placeholder="enter a password" autocomplete="off" />
                            </div>

                            <div class="form_char">
                                <small>password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</small>
                            </div>

                            <div class="reg_form_group">
								<p>Re-enter Password: </p>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="confirm your password" autocomplete="off" />
                            </div>

							<small>By clicking Create Account, you agree to our <a href="PrivacyPolicy.php">Privacy Policy</a></small>


                            <div class="reg_form_group right_btn">
                                <!-- <input type="button" name="btn_student" class="btn btn-success" value="Create Account" id="btn_student" /> -->
								<button type="button" name="btn_student" class="btn btn-success" value="Create Account" id="btn_student">Create Account</button>
                            </div>
                            

                            <div class="reg_form_group">
                                <small id="message_mes" style="color:red;"></small>
                            </div>
                        </form>
</div>
</div>
                        <!-- STUDENT REGISTRATION -->




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
</style>







<script>

$(document).ready(function() {
    // STUDENT REGISTRATION
	$('#btn_student').on('click', function() {
		$('#btn_student').html('<i class="fa fa-spinner fa-spin"></i> Loading'); 
        $("#student_form :input").prop('disabled', true);  
		var student_id = $('#student_id').val();
		var number = $('#number_reg').val();
		var course = $('#course').val();
		var username = $('#username_reg').val();
		var year = $('#year').val();
		var password = $('#passwd').val();
		var confirm_password = $('#confirm_password').val();
		var first_name1 = $('#first_name1').val();
		var last_name1 = $('#last_name1').val();

		if(student_id!="" && number!="" && course!="" && username!="" && year!="" && password!="" && confirm_password!="" && first_name1!="" && last_name1!=""){

		if(!/^[a-z A-Z 0-9]+$/.test(username)){
			$('#btn_student').html('Create Account'); 
            $("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Username only letter and digit characters are allowed!!');
		}
		else if (username.length < 3) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Username must be at least 3 characters!!'); 
    	}
		else if (username.length > 16) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Username must not exceed 16 characters!!'); 
    	}
		else if (!/^[0-9]+$/.test(number)) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Phone number only a number character!!'); 
    	}
		else if (number.length != 11) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Phone number must be at 11 digits!!'); 
		}
		else if (number.substring(0, 2)!='09') {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Incorrect format for phone number!!'); 
		}
		else if (password.length < 8) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Password must be at least 8 characters!!'); 
		}
		else if (password.length > 16) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Password must not exceed 16 characters!!'); 
		}
		else if (!/^(?!.* )/.test(password)) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Password must not contain space!!'); 
		}
		else if  (password.search(/[a-z]/i) < 0) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Password must contain at least one letter!!');
		}
		else if  (password.search(/[0-9]/) < 0) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Password must contain at least one digit!!'); 
		}
		else if (password!=confirm_password) {
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Password did not match!!'); 
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
					alert(dataResult);
					var dataResult = JSON.parse(dataResult);
					$('#btn_student').html('Create Account'); 
					if(dataResult.statusCode==201){	
						$("#student_form").hide();
						$('#message_created_account1').html('Account Created !');
   					 setTimeout( function() { location.href = "index.php" }, 500 );
										
					}
					else if(dataResult.statusCode==202){
						$("#student_form :input").prop('disabled', false);  
						$('#message_mes').html('An error has occured please try again !!'); 
					}
					else if(dataResult.statusCode==203){
						$("#student_form :input").prop('disabled', false);  
						$('#message_mes').html('Username '+dataResult.username+' has already been taken !!'); 
					}
					else if(dataResult.statusCode==204){
						$("#student_form :input").prop('disabled', false);  
						$('#message_mes').html('Another account is already using the mobile number you entered!!'); 
					}
					
				}
			});
		}
	}
		else{
			$('#btn_student').html('Create Account'); 
			$("#student_form :input").prop('disabled', false);  
			$('#message_mes').html('Please fill all the field !'); 
		}
	});

});
</script>



