<!-- DISPLAY AFTER ACCOUNT CREATED -->
<div class="form-group" id='m' style="display:none;">
		<h3 id="message_created_account" class=""></h3>
</div>
<!-- DISPLAY AFTER ACCOUNT CREATED -->
	

<!-- VERIFICATION -->
<form id="verification_form" name="form1" method="post">
	<div class="form-group">
	<h1 class="">Verify</h1>
	</div>

    <div class="form-group">
	<label class="">Student/Staff ID</label>
	<input type="text" name="s_id" id="s_id" placeholder="Your Student/Staff ID">
	</div>

    <div class="form-group">
	<label class="">First Name</label>
	<input type="text" name="first_name" id="first_name" placeholder="Your First Name" >
	</div>

    <div class="form-group">
	<label class="">Last Name</label>
	<input type="text" name="last_name" id="last_name" placeholder="Your Last Name" >
	</div>


    <div class="form-group">
    <input type="button" name="btn_verify" class="btn btn-success" value="Verify" id="btn_verify" />
	</div>
    

    <div class="form-group">
		<small id="message" class="" style="color:red;"></small>
	</div>

	</form>
    <!-- VERIFICATION -->





<!-- STUDENT REGISTRATION -->
<form id="student_form" name="form2" method="post" style="display:none;">
<div class="form-group">
		<div id="message1" class=""></div>
	</div>

<h1>Sign Up</h1>
    <div>
	<label class="">Student ID: </label>
 	<input type="text" name="student_id" id="student_id" readonly>
    </div>

    <div>
	<label class="">First Name: </label>
    <input type="text" name="first_name1" id="first_name1" readonly>
    </div>
    
    <div>
	<label class="">Last Name: </label>
    <input type="text" name="last_name1" id="last_name1" readonly>
    </div>
    
    <div class="">
	<label class="">Username: </label>
	<input type="text" name="username" id="username" placeholder="enter a username" />
	</div>
    
    <div class="">
	<label class="">Mobile Number: </label>
	<input type="tel" name="number" id="number" placeholder="09683510254"  />
	</div>

    <div>
	<label class="">Course: </label>
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
    </select>  </div>

    <div>
	<label class="">Year: </label> 
	<select name="year" id="year">  
    <option value="1">1st Year</option>
    <option value="2">2nd Year</option>
    <option value="3">3rd Year</option>
    <option value="4">4th Year</option>
    </select>
    </div>

	<div class>
	<label class="">Password: </label>
	<input type="password" name="passwd" id="passwd" placeholder="enter a password" autocomplete="off" />
	</div>

	<div class="">
	<small class="">password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</small>
	</div>

	<div class="">
	<label class="">Re-enter Password:: </label>
	<input type="password" name="confirm_password" id="confirm_password" placeholder="confirm your password" autocomplete="off" />
	</div>


	<div class="form-group">
    <input type="button" name="btn_student" class="btn btn-success" value="Create Account" id="btn_student" disabled/>
	</div>
    

    <div class="form-group">
		<small id="message2" class="" style="color:red;"></small>
	</div>


</form>
<!-- STUDENT REGISTRATION -->




<!-- STAFF REGISTRATION -->
<form id="staff_form" name="form2" method="post" style="display:none;">
<div class="form-group">
		<div id="message3" class=""></div>
	</div>
<h1>Sign Up</h1>
    <div>
	<label class="">Staff ID: </label>
    <input type="text" name="staff_id" id="staff_id" readonly>
    </div>
    
    <div>
	<label class="">First Name: </label>
    <input type="text" name="first_name2" id="first_name2" readonly>
    </div>
    
    <div>
	<label class="">Last Name: </label>
    <input type="text" name="last_name2" id="last_name2" readonly>
    </div>

    <div class="">
	<label class="">Username: </label>
	<input type="text" name="username2" id="username2" placeholder="enter a username" />
	</div>

    <div class="">
	<label class="">Phone Number: </label>
	<input type="tel" name="number2" id="number2" placeholder="09683510254"  />
	</div>

    <div>
	<label class="">Position: </label>
	<select name="position2" id="position2">  
    <option value="Teacher">Teacher</option>  
    <option value="Accounting Staff/Scholarship Coordinator">Accounting Staff/Scholarship Coordinator</option>  
    </select>  </div>

    <div>
	<label class="">Appointment Type: </label>
	</div>
    <div>
    <input type="checkbox" name="check_list[]" value="Evaluation of Grades">
    <label> Evaluation of Grades - Department Head</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Claim Chequet">
    <label> UniFAST - Claim Chequet</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents">
    <label> UniFAST - Submit Documents</label><br>
    <input type="checkbox" name="check_list[]" value="Meeting">
    <label> Meeting</label><br>
    <input type="checkbox" name="check_list[]" value="Module Claiming/Submission">
    <label> Module Claiming/Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Project Submission">
    <label> Project Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Presentation">
    <label> Presentation</label><br>
    </div>

	<div class="">
	<label class="">Password: </label>
    <input type="password" name="passwd2" id="passwd2" placeholder="enter a password" autocomplete="off"  />
	</div>

    <div class="">
	<small class="">Password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</small>
	</div>	

	<div class="">
	<label class="">Re-enter Password: </label>
    <input type="password" name="confirm_password2" id="confirm_password2" placeholder="confirm your password" autocomplete="off"  />
	</div>

	<div class="form-group">
    <input type="button" name="btn_staff" class="btn btn-success" value="Create Account" id="btn_staff" disabled/>
	</div>
    

    <div class="form-group">
		<small id="message4" class="" style="color:red;"></small>
	</div>

</form>
<!-- STAFF REGISTRATION -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	// VERIFICATION
$(document).ready(function() {
	$('#btn_verify').on('click', function() {
		$('#btn_verify').prop('disabled', true);
		var s_id = $('#s_id').val();
		var first_name 	 = $('#first_name').val().toLowerCase();
		var last_name = $('#last_name').val().toLowerCase();
		if(s_id!="" && first_name!="" && last_name!=""){
			$.ajax({
				url: "registrationajax.php",
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
						$('#btn_verify').prop('disabled', false);
						$('#message').html('Student/Staff ID is already been singed up !');  
					}
                    else if(dataResult.statusCode==204){
						$('#btn_verify').prop('disabled', false);
						$('#message').html('Not on the list ! ');
					}
					
				}
			});
		}
		else{
			$('#btn_verify').prop('disabled', false);
			$('#message').html('Please fill all the field !');
		}
	});
	// VERIFICATION

	// STUDENT REGISTRATION
	$('#btn_student').on('click', function() {
		$('#btn_student').prop('disabled', true);
		var student_id = $('#student_id').val();
		var number = $('#number').val();
		var course = $('#course').val();
		var username = $('#username').val();
		var year = $('#year').val();
		var password = $('#passwd').val();
		var confirm_password = $('#confirm_password').val();
		var first_name1 	 = $('#first_name1').val();
		var last_name1 = $('#last_name1').val();

		if(student_id!="" && number!="" && course!="" && username!="" && year!="" && password!="" && confirm_password!="" && first_name!="" && last_name!=""){

		if(!/^[a-z A-Z 0-9]+$/.test(username)){
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Username only letter and digit characters are allowed !!');
		}
		else if (username.length < 3) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Username must be at least 3 characters !!'); 
    	}
		else if (username.length > 16) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Username must not exceed 16 characters !!'); 
    	}
		else if (!/^[0-9]+$/.test(number)) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Phone number only a number character !!'); 
    	}
		else if (number.length != 11) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Phone number must be at 11 characters !!'); 
		}
		else if (number.substring(0, 2)!='09') {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Incorrect phone number !!'); 
		}
		else if (password.length < 8) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must be at least 8 characters !!'); 
		}
		else if (password.length > 16) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must not exceed 16 characters !!'); 
		}
		else if (!/^(?!.* )/.test(password)) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must not contain space !!'); 
		}
		else if  (password.search(/[a-z]/i) < 0) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must contain at least one letter !!');
		}
		else if  (password.search(/[0-9]/) < 0) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password must contain at least one digit !!'); 
		}
		else if (password!=confirm_password) {
			$('#btn_student').prop('disabled', false);
			$('#message2').html('Password did not match!!'); 
		}
		else{
			$.ajax({
				url: "registrationajax.php",
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
   					 setTimeout( function() { location.href = "../index.php" }, 1500 );
										
					}
					else if(dataResult.statusCode==202){
						$('#btn_student').prop('disabled', false);
						$('#message2').html('An error has been occured please try again !!'); 
					}
					else if(dataResult.statusCode==203){
						$('#btn_student').prop('disabled', false);
						$('#message2').html('Username '+dataResult.username+' is already been taken !!'); 
					}
					else if(dataResult.statusCode==204){
						$('#btn_student').prop('disabled', false);
						$('#message2').html('Mobile number you enter is already been used !!'); 
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
			$('#message4').html('Username only letter and digit characters are allowed !!');
		}
		else if (username.length < 3) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Username must be at least 3 characters !!'); 
    	}
		else if (username.length > 16) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Username must not exceed 16 characters !!'); 
    	}
		else if (!/^[0-9]+$/.test(number)) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Phone number only a number character'); 
		}
		else if (number.length != 11) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Phone number must be at 11 characters'); 
		}
		else if (number.substring(0, 2)!='09') {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Incorrect phone number !!'); 
		}
		else if (type=="") {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Put at least one appointment type'); 
		}
		else if (password.length < 8) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must be at least 8 characters !!'); 
		}
		else if (password.length > 16) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must not exceed 16 characters !!'); 
		}
		else if (!/^(?!.* )/.test(password)) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must not contain space !!'); 
		}
		else if  (password.search(/[a-z]/i) < 0) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must contain at least one letter !!');
		}
		else if  (password.search(/[0-9]/) < 0) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password must contain at least one digit !!'); 
		}
		else if (password!=confirm_password) {
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Password did not match!!'); 
		}
		else{
			$.ajax({
				url: "registrationajax.php",
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
						$('#message_created_account').html('Account Created ! ');
						
   					 setTimeout( function() { location.href = "../admin.php" }, 1500 );
											
					}
					else if(dataResult.statusCode==202){
						$('#btn_staff').prop('disabled', false);
						$('#message4').html('An error has been occured please try again !!'); 
					}
					else if(dataResult.statusCode==203){
						$('#btn_staff').prop('disabled', false);
						$('#message4').html('Username '+dataResult.username+' is already been taken !!'); 
					}
					else if(dataResult.statusCode==204){
						$('#btn_staff').prop('disabled', false);
						$('#message4').html('Mobile number you enter is already been used !!'); 
					}
					
				}
			});
		}
	}
		else{
			$('#btn_staff').prop('disabled', false);
			$('#message4').html('Please fill all the field !'); 
		}
	});


});
</script>
	
 


