<?php
include("header.php");
$student_id = $_SESSION["student_id"];
$username1 = $_SESSION["student_username"];
$query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
$row = $query->fetch_assoc();
if ($student_id == "" || $username1 == ""){
    echo '<script type="text/javascript">window.location.href="login_system/login.php"</script>';
}
?>



<div class="parent_div">

    <div class="profile_settings">
        <img src="icon/settings.png" width="24">
        <h1>Profile Settings</h1>
    </div>

    <div class="profile_div">

        <div class="head_account">
            <div class="current_profile">
                <div><h2><?php echo $row["first_name"]," ", $row["last_name"]?></h2></div>
                <div><span>Username:</span><p><?php echo $row["username"]?></p></div>
                <div><span>Course and Year:</span><p> <?php echo $row["course"]," ", $row["year"]?></p></div>
                <div><span>Mobile number:</span><p><?php echo $row["mobile_number"]?></p></div>
            </div>
        </div>

        <div class="head_account">

            <div class="profile_input">
                <p>Student ID</p><input type="text" name="student_id" value="<?php echo $row["student_id"]?>" disabled />
            </div>

            <div class="profile_input">
                <p>Username</p>
                <input type="text" name="username" value="<?php echo $row["username"]?>" disabled />
            </div>

            <div class="profile_input">
                <p>First Name</p>
                <input type="text" name="first_name" value=<?php echo $row["first_name"]?> disabled />
            </div>
            
            <div class="profile_input">
                <p>Last Name</p><input type="text" name="last_name" value=<?php echo $row["last_name"]?> disabled />
            </div>

            <form method="post" id="dis">
                <div class="form_input_div">
                    <p>Mobile Number: </p>
                    <input type="tel" name="number" id="profile_number" value="<?php echo $row["mobile_number"]?>" maxlength="11" />
                </div>

                <div class="form_input_div">
                    <p>Course:</p>
                    <select name="course" id="profile_course">  
                        <option value="BSHM" <?php echo $row["course"]=='BSHM'?'selected':"";?>>BSHM</option>
                        <option value="BSTM" <?php echo $row["course"]=='BSTM'?'selected':"";?>>BSTM</option>
                        <option value="BSIT" <?php echo $row["course"]=='BSIT'?"selected":"";?>>BSIT</option>
                        <option value="BSSW" <?php echo $row["course"]=='BSSW'?'selected':"";?>>BSSW</option>
                        <option value="ABE" <?php echo $row["course"]=='ABE'?'selected':"";?>>ABE</option>
                        <option value="BECE" <?php echo $row["course"]=='BECE'?'selected':"";?>>BECE</option>
                        <option value="BTVED" <?php echo $row["course"]=='BTVED'?'selected':"";?>>BTVED</option>
                        <option value="BSBA" <?php echo $row["course"]=='BSBA'?'selected':"";?>>BSBA</option>
                        <option value="ACT" <?php echo $row["course"]=='ACT'?'selected':"";?>>ACT</option>
                        <option value="HM" <?php echo $row["course"]=='HM'?'selected':"";?>>HM</option>
                        <option value="TESDA PROGRAM" <?php echo $row["course"]=='TESDA PROGRAM'?'selected':"";?>>TESDA PROGRAM</option>
                    </select>  
                </div>


                <div class="form_input_div">
                    <p>Year</p> 
                    <select name="year" id="profile_year">  
                        <option value="1" <?php echo $row["year"]=='1'?'selected':'';?>>1st Year</option>
                        <option value="2" <?php echo $row["year"]=='2'?'selected':'';?>>2nd Year</option>
                        <option value="3" <?php echo $row["year"]=='3'?'selected':'';?>>3rd Year</option>
                        <option value="4" <?php echo $row["year"]=='4'?'selected':'';?>>4th Year</option>
                    </select>
                </div>
            
                <div class="right_btn">
                    <input type="button" name="button_edit_profile" value="Save Changes" id="button_edit_profile" />
                </div>

                <div class="form-group">
                    <small id="message3" class="" style="color:red;"></small>
                </div>
            </form>
      

        </div>

        <div class="head_account">
            <div class="c_p">
                <h2>Change Password</h2>
            </div>

            <form method="post" id="dat">
                
                <div class="profile_input">
                    <p>Current password</p><input type="password" name="currentpass" id="profile_currentpass" placeholder="Current password" autocomplete="off" />
                </div>
                
                <div class="profile_input">
                    <p>New Password</p><input type="password" name="newpass" id="profile_newpass" placeholder="New password" autocomplete="off" />
                </div>
                
                <div class="pass_note">
                    <small>password must be at least 5 characters and have a number character,<br> e.g. 1234567890</small>
                </div>

                <div class="profile_input">
                    <p>Re-enter New Password</p><input type="password" name="newpass_verify" id="profile_newpass_verify" placeholder="Re-enter new password" autocomplete="off" />
                </div>

                <div class="right_btn">
                    <input type="button" name="button_change_pass" value="Save Changes" id="button_change_pass" />
                </div>

                <div class="form-group">
                    <small id="changepass_message1" class="" style="color:red;"></small>
                </div>
            </form>
        </div>

    </div>

 

    
    









    
</div>

<?php include("backtotop.php"); ?>


<style>
    .parent_div {
        background: #EFF0F4;
        padding: 15px;
        margin-top: 80px;
    }
    .parent_div .profile_settings {
        display: flex;
        align-items: flex-end;
        margin-left: 15px;
    }
    .parent_div .profile_settings img {
        margin-right: 8px;
    }
    .parent_div .profile_settings h1 {
        font-family: 'Roboto';
        text-transform: uppercase;
        font-size: 20px;
        color: #333;
    }
    .parent_div .profile_div {
        background: #EFF0F4;
        padding: 15px;
    }
    .parent_div .profile_div .head_account {
        background: #fff;
        padding: 15px 30px;
    }
   
    .parent_div .profile_div .head_account:nth-child(1) {
        background: #324E9E;
    }

    .parent_div .profile_div .head_account:nth-child(2) {
        margin-bottom: 15px;
        padding-top: 35px;
    }
    .head_account .current_profile {
        display: flex;
        align-items: center;
    }
    .head_account .current_profile div {
        margin-right: 20px;
        display: flex;
        align-items: center;
        color: #fff;
        font-family: 'Roboto';
    }
    .head_account .current_profile div h2 {
        font-weight: 500;
        font-size: 20px;
    }
    .head_account .current_profile div span {
        margin-right: 8px;
        color: #eee;
        font-size: 13px;
        text-transform: uppercase;
    }
    .head_account .current_profile div p {
        font-family: 'Roboto Serif';
    }
    .profile_div .head_account:nth-child(2) {
        padding-top: 25px;
    }
    .profile_div .head_account:nth-child(2) .profile_input{
        width: 100%;
        height: 30px;
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    .profile_div .head_account:nth-child(2) .profile_input p {
        font-family: 'Roboto';
        font-size: 13px;
        text-transform: uppercase;
        width: 150px;
        color: #444;
    }
    .profile_div .head_account:nth-child(2) .profile_input input {
        background: #EFF0F4;
        border: 1px solid lightgrey;
        padding: 5px;
        padding-left: 8px;
        font-size: 13px;
        width: 220px;
    }
                 .head_account form {
                     margin-top: 30px;
                 }
                 .head_account form .form_input_div {
                    width: 100%;
                    height: 30px;
                    display: flex;
                    align-items: center;
                    margin-bottom: 8px;
                 }
                 .head_account form .form_input_div p {
                    font-family: 'Roboto';
                    font-size: 13px;
                    text-transform: uppercase;
                    width: 150px;
                    color: #444;
                 }
                 .head_account form .form_input_div input,
                 .head_account form .form_input_div select {
                    background: none;
                    border: 1px solid lightgrey;
                    padding: 5px;
                    padding-left: 8px;
                    font-size: 13px;
                    width: 220px;
                 }
      
.appointment_form {
    margin-top: 45px;
}
.appointment_form .apptn_type p {
    font-family: 'Roboto';
    font-size: 13px;
    text-transform: uppercase;
    color: #444;
    margin-bottom: 15px;
}
.appointment_form .pick_appt_type {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
}
.pick_appt_type .form_group_input {
    height: 30px;
    font-family: 'Roboto Serif';
    font-size: 13px;
    background: #fff;
    margin: 8px;
    width: 280px;
    display: flex;
    align-items: stretch;
    transform: translateX(-10px);
}
.pick_appt_type .form_group_input label{
    border: 1px solid #324E9E;
    color: #333;
    width: 100%;
    line-height: 30px;
    text-align: center;
    cursor: pointer;
}
.pick_appt_type .form_group_input input[type=checkbox]:checked ~ label {
    background: #324E9E;
    color: #eee;
    border: none;
}
.right_btn {
    width: 100%;
    margin-top: 30px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: end;
}
.right_btn input[type=button] {
    background: #444;
    border: none;
    color: #eee;
    font-family: 'Roboto';
    font-size: 13px;
    width: 150px;
    height: 32px;
    cursor: pointer;
    text-transform: uppercase;
}

.profile_div .head_account:nth-child(3) {
        padding-top: 25px;
    }
.profile_div .head_account:nth-child(3) .profile_input{
    width: 100%;
    height: 30px;
    display: flex;
    align-items: center;
    margin-bottom: 8px;
}
.profile_div .head_account:nth-child(3) .profile_input p {
    font-family: 'Roboto';
    font-size: 13px;
    text-transform: uppercase;
    width: 150px;
    color: #444;
}
.profile_div .head_account:nth-child(3) .profile_input input {
    background: none;
    border: 1px solid gray;
    padding: 5px;
    padding-left: 8px;
    font-size: 13px;
    width: 220px;
}
.head_account:nth-child(3) .c_p {
    margin-bottom: 25px;
}
.head_account:nth-child(3) .c_p h2 {
    font-family: 'Roboto';
    font-size: 20px;
}
.head_account:nth-child(3) .pass_note {
    margin-bottom: 12px;
    margin-left: 150px;
    font-family: 'Roboto Serif';
    font-size: 13px;
    width: 220px;
    color: gray;
}
     
</style>







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // UPDATE PROFILE
	$('#button_edit_profile').on('click', function() {
        $("#dis :input").prop('disabled', true);    
		var new_mobilenumber = $('#profile_number').val();
		var new_course = $('#profile_course').val();
        var new_year = $('#profile_year').val();;
        $(':checkbox:checked').each(function(i){
          type[i] = $(this).val();
        });
        if(new_mobilenumber!=""&&new_course!=""&&new_year!=""){
        if (!/^[0-9]+$/.test(new_mobilenumber)) {
            $("#dis :input").prop('disabled', false);   
			$('#message3').html('Phone number only a number character'); 
		}
		else if (new_mobilenumber.length != 11) {
            $("#dis :input").prop('disabled', false);   
			$('#message3').html('Phone number must be at 11 characters'); 
		}
		else if (new_mobilenumber.substring(0, 2)!='09') {
            $("#dis :input").prop('disabled', false);   
			$('#message3').html('Incorrect phone number !!'); 
		}
        else{
			$.ajax({
				url: "student_profileajax.php",
				type: "POST",
				data: {
					type:1,	
					number: new_mobilenumber,
                    course: new_course,
                    year:new_year						
				},
                cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){  
                        $("#dis :input").prop('disabled', false); 
                        $('#message3').html('Updated profile settings sucessfully !!'); 
					}
                    else if(dataResult.statusCode==201){
                        $("#dis :input").prop('disabled', false);   
						$('#message3').html('An Error occured, please refresh the page !!'); 
					}
                    else if(dataResult.statusCode==202){
                        $("#dis :input").prop('disabled', false);   
						$('#message3').html('Mobile number already in used, please try another !!'); 
					}
					
				}
			});
        }
    }
    else{
        $("#dis :input").prop('disabled', false);   
		$('#message3').html('Please fill all the field !!'); 
    }
		
	});
	// UPDATE PROFILE


    // CHANGE PASS
    $('#button_change_pass').on('click', function() {
        $("#dat :input").prop('disabled', true);  
        var currentpass = $('#profile_currentpass').val();
		var newpass = $('#profile_newpass').val();
		var newpass_verify = $('#profile_newpass_verify').val();
        if(currentpass!=""&&newpass!=""&&newpass_verify!=""){
        if (newpass.length < 8) {
            $("#dat :input").prop('disabled', false); 
      	$("#changepass_message1").html('Password must be at least 8 characters !!');
        }
      	else if (newpass.length > 16) {
            $("#dat :input").prop('disabled', false);
        $("#changepass_message1").html('Password must not exceed 16 characters !!'); 
        }
		else if (!/^(?!.* )/.test(newpass)) {
            $("#dat :input").prop('disabled', false);
		$('#changepass_message1').html('Password must not contain space !!'); 
		}
        else if  (newpass.search(/[a-z]/i) < 0) {
            $("#dat :input").prop('disabled', false);
        $("#changepass_message1").html('Password must contain at least one letter !!');
        }
        else if  (newpass.search(/[0-9]/) < 0) {
            $("#dat :input").prop('disabled', false);
        $("#changepass_message1").html('Password must contain at least one digit !!'); 
        }
      	else if (newpass != newpass_verify){
            $("#dat :input").prop('disabled', false);
            $('#changepass_message1').html('New Password did not match !!'); 
      	}
            else{
			$.ajax({
				url: "student_profileajax.php",
				type: "POST",
				data: {
					type:2,	
					currentpass: currentpass,	
					newpass: newpass					
				},
                cache: false,
				success: function(dataResult){
                  
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
                        $("#dat :input").prop('disabled', false);
                        $('#profile_currentpass').val('');
                        $('#profile_newpass').val('');
                        $('#profile_newpass_verify').val('');
                        $('#changepass_message1').html('Password updated successfully !!'); 
					}
                    else if(dataResult.statusCode==201){
                        $("#dat :input").prop('disabled', false);
						$('#changepass_message1').html('An Error occured while changing password, please refresh the page !!'); 
					}
                    else if(dataResult.statusCode==202){
                        $$("#dat :input").prop('disabled', false);
						$('#changepass_message1').html('Current password did not match !!'); 
					}
                    
					
				}
			});
        }
        }
        else{
            $("#dat :input").prop('disabled', false);
            $('#changepass_message1').html('Please fill all the field !!'); 
        }
		
	});
	// CHANGE PASS


});
</script>


