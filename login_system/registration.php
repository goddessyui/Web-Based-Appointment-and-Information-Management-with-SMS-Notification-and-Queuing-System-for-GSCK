<div class="form-group" id='m' style="display:none;">
		<h3 id="message_created" class=""></h3>
	</div>
<!-- VERIFICATION -->
<form id="verification_form" name="form1" method="post">
	

    <div class="form-group">
	<label class="col-sm-3 control-label">Your Student/Staff ID</label>
	<input type="text" name="s_id" id="s_id" placeholder="Your Student/Staff ID">

	</div>

    <div class="form-group">
	<label class="col-sm-3 control-label">Your First Name</label>
	<input type="text" name="first_name" id="first_name" placeholder="Your First Name" >
	</div>

    <div class="form-group">
	<label class="col-sm-3 control-label">Your Last Name</label>
	<input type="text" name="last_name" id="last_name" placeholder="Your Last Name" >
	</div>


    <div class="form-group">
    <input type="button" name="btn_verify" class="btn btn-success" value="Verify" id="btn_verify" />
	</div>
    

    <div class="form-group">
		<div id="message" class=""></div>
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
    Student ID: <input type="text" name="student_id" id="student_id" readonly>
    </div>

    <div>
    First Name: <input type="text" name="first_name1" id="first_name1" readonly>
    </div>
    
    <div>
    Last Name: <input type="text" name="last_name1" id="last_name1" readonly>
    </div>
    
    <div class="">
	Username: <input type="text" name="username" id="username" placeholder="enter a username" />
	</div>
    
    <div class="">
	Mobile Number: <input type="tel" name="number" id="number" placeholder="09683510254"  />
	</div>

    <div>Course: <select name="course" id="course">  
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

    <div>Year: <select name="year" id="year">  
    <option value="1">1st Year</option>
    <option value="2">2nd Year</option>
    <option value="3">3rd Year</option>
    <option value="4">4th Year</option>
    </select>
    </div>

	<div class>
	Password: <input type="password" name="passwd" id="passwd" placeholder="enter a password" autocomplete="off" />
	</div>

	<div class="">
		<p>password must be at least 8 characters and<br /> have a number character, e.g. 1234567890</p>
	</div>

	<div class="">
	Re-enter Password: <input type="password" name="confirm_password" id="confirm_password" placeholder="confirm your password" autocomplete="off" />
	</div>


	<div class="form-group">
    <input type="button" name="btn_student" class="btn btn-success" value="Create Account" id="btn_student" />
	</div>
    

    <div class="form-group">
		<div id="message2" class=""></div>
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
    Staff ID: <input type="text" name="staff_id" id="staff_id" readonly>
    </div>
    
    <div>
    First Name: <input type="text" name="first_name2" id="first_name2" readonly>
    </div>
    
    <div>
    Last Name: <input type="text" name="last_name2" id="last_name2" readonly>
    </div>

    <div class="">
	Username:	<input type="text" name="username2" id="username2" placeholder="enter a username" />
	</div>

    <div class="">
	Phone Number: <input type="tel" name="number2" id="number2" placeholder="09683510254"  />
	</div>

    <div>Position: <select name="position2" id="position2">  
    <option value="Teacher">Teacher</option>  
    <option value="Accounting Staff/Scholarship Coordinator">Accounting Staff/Scholarship Coordinator</option>  
    </select>  </div>

    <div> Appointment Type: </div>
    <div>
    <input type="checkbox" name="check_list[]" value="Request Documents From Registrar">
    <label> Request Documents From Registrar</label><br>
    <input type="checkbox" name="check_list[]" value="Evaluation of Grades">
    <label> Evaluation of Grades - Department Head</label><br>
    <input type="checkbox" name="check_list[]" value="Enrollment">
    <label> Enrollment</label><br>
    <input type="checkbox" name="check_list[]" value="Pre-Enrollment">
    <label> Pre-Enrollment</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Claim Chequet">
    <label> UniFAST - Claim Chequet</label><br>
    <input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents">
    <label> UniFAST - Submit Documents</label><br>
    <input type="checkbox" name="check_list[]" value="Meeting">
    <label> Meeting</label><br>
    <input type="checkbox" name="check_list[]" value="Module Claiming/Submission">
    <label> Module Claiming/Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Request for Grades">
    <label> Request for Grades</label><br>
    <input type="checkbox" name="check_list[]" value="Project Submission">
    <label> Project Submission</label><br>
    <input type="checkbox" name="check_list[]" value="Presentation">
    <label> Presentation</label><br>
    </div>

	<div class="">
    Password: <input type="password" name="passwd2" id="passwd2" placeholder="enter a password" autocomplete="off"  />
	</div>

    <div class="">
		<p>password must be at least 5 characters and<br /> have a number character, e.g. 1234567890</p>
	</div>	

	<div class="">
    Re Enter Password: <input type="password" name="confirm_password2" id="confirm_password2" placeholder="confirm your password" autocomplete="off"  />
	</div>

	<div class="form-group">
    <input type="button" name="btn_staff" class="btn btn-success" value="Create Account" id="btn_staff" />
	</div>
    

    <div class="form-group">
		<div id="message4" class=""></div>
	</div>

</form>
<!-- STAFF REGISTRATION -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('#btn_verify').on('click', function() {
		var s_id = $('#s_id').val();
		var first_name 	 = $('#first_name').val();
		var last_name = $('#last_name').val();
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
						$('#message1').html('Student Verified ! ');
						$("#student_form").show();
						$("#verification_form").hide();
						$('#student_id').val(dataResult.student_id);
						$('#first_name1').val(dataResult.first_name);
						$('#last_name1').val(dataResult.last_name);

					}
					else if(dataResult.statusCode==202){
						$('#message3').html('Staff Verified ! ');
						$("#staff_form").show();
						$("#verification_form").hide();
						$('#staff_id').val(dataResult.staff_id);
						$('#first_name2').val(dataResult.first_name);
						$('#last_name2').val(dataResult.last_name);
					
					}
                    else if(dataResult.statusCode==203){
						$('#message').html('Student/Staff ID is already been singed up !');  
					}
                    else if(dataResult.statusCode==204){
						$('#message').html('Not on the list ! ');
					}
					
				}
			});
		}
		else{
			$('#message').html('Please fill all the field !');
		}
	});

	// STUDENT REGISTRATION
	$('#btn_student').on('click', function() {
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

		if(!/^[a-z A-Z]+$/.test(username)){
			$('#message2').html('username only capital and small letters are allowed !!');
		}
	else if (password.length < 8) {
	$('#message2').html('Your password must be at least 8 characters !!'); 
    }
	else if (password.length > 16) {
		$('#message2').html('Your password must not exceed 16 characters !!'); 
    }
    else if  (password.search(/[a-z]/i) < 0) {
		$('#message2').html('Your password must contain at least one letter !!');
    }
    else if  (password.search(/[0-9]/) < 0) {
		$('#message2').html('Your password must contain at least one digit !!'); 
    }
	else if (password!=confirm_password) {
		$('#message2').html('password did not match!!'); 
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
						$('#message_created').html('Account Created !');
   					 setTimeout( function() { location.href = "../index.php" }, 1500 );
										
					}
					else if(dataResult.statusCode==202){
						$('#message2').html('An error has been occured please try again !!'); 
					}
					else if(dataResult.statusCode==203){
						$('#message2').html(dataResult.username+' username is already been taken !!'); 
					}
					
				}
			});
		}
	}
		else{
			$('#message2').html('Please fill all the field !'); 
		}
	});

	// STAFF REGISTRATION
	$('#btn_staff').on('click', function() {
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
		if(student_id!="" && number!="" && course!="" && username!="" && year!="" && password!="" && confirm_password!="" && first_name!="" && last_name!="" && type!=""){

		if(!/^[a-z A-Z]+$/.test(username)){
			$('#message4').html('username only capital and small letters are allowed !!');
		}
	else if (password.length < 8) {
	$('#message4').html('Your password must be at least 8 characters !!'); 
    }
	else if (password.length > 16) {
		$('#message4').html('Your password must not exceed 16 characters !!'); 
    }
    else if  (password.search(/[a-z]/i) < 0) {
		$('#message4').html('Your password must contain at least one letter !!');
    }
    else if  (password.search(/[0-9]/) < 0) {
		$('#message4').html('Your password must contain at least one digit !!'); 
    }
	else if (password!=confirm_password) {
		$('#message4').html('password did not match!!'); 
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
						$('#message_created').html('Account Created !');
						
   					 setTimeout( function() { location.href = "../admin.php" }, 1500 );
											
					}
					else if(dataResult.statusCode==202){
						$('#message4').html('An error has been occured please try again !!'); 
					}
					else if(dataResult.statusCode==203){
						$('#message4').html(dataResult.username+' username is already been taken !!'); 
					}
					
				}
			});
		}
	}
		else{
			$('#message4').html('Please fill all the field !'); 
		}
	});


});
</script>
	
<!-- <script>
    $(document).ready(function() {
    $('#btn_verify').on('click', function(){
				
		var s_id = $('#s_id').val();
		var first_name 	 = $('#first_name').val();
		var last_name = $('#last_name').val();
						
		if(s_id == ''){ // check username not empty
			alert('please enter fill the form !!');
		}
		else{			
			$.ajax({
				url: 'process.php',
				type: 'post',
				data: 
					{
                        type: 'verify',
                    news_id:s_id, 
					 newfirst_name:first_name, 
					 newlast_name:last_name
					},
				success: function(response){
					$('#message').html(response);
				}
			});
				
			$('#verification_form"')[0].reset();
		}
	});
    });
</script> -->
 


