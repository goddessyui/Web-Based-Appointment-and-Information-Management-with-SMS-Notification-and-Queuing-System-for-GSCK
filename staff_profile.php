<?php
include("admin_header.php");
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
$query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE staff_id='{$staff_id}'");
$row = $query->fetch_assoc();
$appointment_type = "";
                $sql = "SELECT
                tbl_staff_appointment.staff_id,
                tbl_staff_appointment.appointment_type
                FROM
                tbl_staff_appointment
                WHERE staff_id = '{$staff_id}'";
                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row1 = mysqli_fetch_assoc($res)) {
                        # code...
                        $appointment_type .= $row1["appointment_type"].","; 

                    }
                }
$array_type = explode( ',', $appointment_type );

               
if ($staff_id == "" && $username == ""){
    echo '<script type="text/javascript">window.location.href="login_system/login.php"</script>';
}
?>


<main>
    <div class="profile_settings">
        <img src="icon/settings.png" width="24">
        <h1>Profile Settings</h1>
    </div>

    <div class="profile_div">
        
        <div class="head_account">
            <div class="current_profile">
                <div><h2> <?php echo $row["first_name"]," ", $row["last_name"]?></h2></div>
                <div><span>Username:</span><p><?php echo $row["username"]?></p></div>
                <div><span>Mobile number:</span><p><?php echo $row["mobile_number"]?></p></div>
            </div>
        </div>
        
        <div class="head_account">

            <div class="profile_input">
                <p>Staff ID</p><input type="text" name="staff_id" value="<?php echo $row["staff_id"]?>" disabled />
            </div>

            <div class="profile_input">
                <p>Username</p><input type="text" name="username" value="<?php echo $row["username"]?>" disabled />
            </div>

            <div class="profile_input">
                <p>First name</p><input type="text" name="first_name" value=<?php echo $row["first_name"]?> disabled />
            </div>

            <div class="profile_input">
                <p>Last name</p><input type="text" name="last_name" value=<?php echo $row["last_name"]?> disabled />
            </div>

            <form method="POST" action="#" id="dis_staff">
                <div class="form_input_div">
                    <p>Mobile number</p><input type="tel" name="number" id="number" value="<?php echo $row["mobile_number"]?>" maxlength="11" autocomplete="off" />
                </div>

                <?php 
                if ($position == 'Registrar') {?>

                    <div class="form_input_div form_space">
                        <p>Position</p>
                        <input type="text" name="position" id="position" value="Registrar" disabled>
                    </div>


                    <div class="appointment_form">
                        
                        <div class="apptn_type">
                            <p>Appointment Type: </p>
                        </div>

                        <div class="pick_appt_type">
                            
                            <div class="form_group_input">
                                <input hidden id="reg_meeting" type="checkbox" name="check_list[]" 
                                value="Meeting" <?php echo in_array("Meeting", $array_type)?'checked':'';?>>
                                <label for="reg_meeting">Meeting</label>
                            </div>

                            <div class="form_group_input">
                                <input hidden id="reg_presentation" type="checkbox" name="check_list[]" 
                                value="Presentation" <?php echo in_array("Presentation", $array_type)?'checked':'';?>>
                                <label for="reg_presentation">Presentation</label>
                            </div>

                            <div class="form_group_input">
                                <input hidden id="reg_request" type="checkbox" name="check_list[]" 
                                value="Request Documents From Registrar" <?php echo in_array("Request Documents From Registrar", $array_type)?'checked':'';?>>
                                <label for="reg_request">Request Documents</label>
                            </div>

                            <div class="form_group_input">
                                <input hidden hidden id="reg_pre-enrollment" type="checkbox" name="check_list[]" 
                                value="Pre-Enrollment" <?php echo in_array("Pre-Enrollment", $array_type)?'checked':'';?>>
                                <label for="reg_pre-enrollment">Pre-Enrollment</label>
                            </div>

                            <div class="form_group_input">
                                <input hidden id="reg_enrollment" type="checkbox" name="check_list[]" 
                                value="Enrollment" <?php echo in_array("Enrollment", $array_type)?'checked':'';?>>
                                <label for="reg_enrollment">Enrollment</label>
                            </div>

                            <div class="form_group_input">
                                <input hidden id="reg_grades" type="checkbox" name="check_list[]" 
                                value="Request for Grades" <?php echo in_array("Request for Grades", $array_type)?'checked':'';?>>
                                <label for="reg_grades">Request for Grades</label>
                            </div>

                            <div class="form_group_input">
                                <input hidden id="reg_graduation" type="checkbox" name="check_list[]" 
                                value="Application for Graduation" <?php echo in_array("Application for Graduation", $array_type)?'checked':'';?>>
                                <label for="reg_graduation"> Application for Graduation</label> 
                            </div>
                        </div>
                    </div>

                    <?php 
                }
                else {?>

                    <div class="form_input_div form_space">
                    <p>Position:</p> 
                        <select name="position" id="position">  
                            <option value="Teacher" <?php echo $row["position"]=='Teacher'?'selected':''?>>Teacher</option>  
                            <option value="Accounting Staff/Scholarship Coordinator" <?php echo $row["position"]=='Accounting Staff/Scholarship Coordinator'?'selected':''?>>Accounting Staff/Scholarship Coordinator</option>  
                        </select>  
                    </div>
                
                    <div class="appointment_form">
                        <div class="apptn_type">
                            <p>Appointment Type: </p>
                        </div>

                        <div class="pick_appt_type">

                            <div class="form_group_input">
                                <input hidden id="reg_meeting" type="checkbox" name="check_list[]" 
                                value="Meeting" <?php echo in_array("Meeting", $array_type)?'checked':'';?>>
                                <label for="reg_meeting">Meeting</label>
                            </div>

                            <div class="form_group_input">
                                <input hidden id="reg_presentation" type="checkbox" name="check_list[]" 
                                value="Presentation" <?php echo in_array("Presentation", $array_type)?'checked':'';?>>
                                <label for="reg_presentation">Presentation</label>
                            </div>
                            <div class="form_group_input">
                                <input hidden id="reg_module" type="checkbox" name="check_list[]" 
                                value="Module Claiming or Submission" <?php echo in_array("Module Claiming or Submission", $array_type)?'checked':'';?>>
                                <label for="reg_module">Module Claiming or Submission</label>
                            </div>
                            <div class="form_group_input">
                                <input hidden id="reg_projectsubmission" type="checkbox" name="check_list[]" 
                                value="Project Submission" <?php echo in_array("Project Submission", $array_type)?'checked':'';?>>
                                <label for="reg_projectsubmission">Project Submission</label>
                            </div>
                            <div class="form_group_input">
                                <input hidden id="reg_evaluationofgrades" type="checkbox" name="check_list[]" 
                                value="Evaluation of Grades" <?php echo in_array("Evaluation of Grades", $array_type)?'checked':'';?>>
                                <label for="reg_evaluationofgrades">Evaluation of Grades - Department Head</label>
                            </div>
                            <div class="form_group_input">
                                <input hidden id="reg_claimcheque" type="checkbox" name="check_list[]" 
                                value="UniFAST - Claim Cheque" <?php echo in_array("UniFAST - Claim Cheque", $array_type)?'checked':'';?>>
                                <label for="reg_claimcheque">UniFAST - Claim Cheque</label>
                            </div>
                            <div class="form_group_input">
                                <input hidden id="reg_submitdocu" type="checkbox" name="check_list[]" 
                                value="UniFAST - Submit Documents" <?php echo in_array("UniFAST - Submit Documents", $array_type)?'checked':'';?>>
                                <label for="reg_submitdocu">UniFAST - Submit Documents</label>
                            </div>
                            <div class="form_group_input">
                                <input hidden id="reg_graduation" type="checkbox" name="check_list[]" 
                                value="Application for Graduation" <?php echo in_array("Application for Graduation", $array_type)?'checked':'';?>>
                                <label for="reg_graduation">Application for Graduation</label> 
                            </div>
                        </div>
                    </div>
                    <?php 
                } ?>

                    

                <div class="right_btn">
                    <input type="button" name="button_edit_profile" value="Save Changes" id="button_edit_profile" />
                </div>

                <div class="form-group">
                    <small id="message_staffprofile" style="color:red;"></small>
                </div>
            </form>     
        </div> 
        
            
        

        <div class="head_account">
            <div class="c_p">
                    <h2>Change Password</h2>
                </div>
            <form method="POST" action="#" id="dat_staff">    
                <div class="profile_input">
                    <p>Current password</p>
                    <input type="password" name="currentpass" id="currentpass" placeholder="Current password" autocomplete="off" />
                </div>

                <div class="profile_input">
                    <p>New Password</p>
                    <input type="password" name="newpass" id="newpass" placeholder="New password" autocomplete="off" />
                </div>

                <div class="pass_note">
                    <small>password must be at least 5 characters and have a number character,<br>e.g. abcde12345</small>
                </div>

                <div class="profile_input">
                    <p>Re-enter New Password</p>
                    <input type="password" name="newpass_verify" id="newpass_verify" placeholder="Re-enter new password" autocomplete="off" />
                </div>

                <div class="right_btn">
                    <input type="button" name="button_change_pass" value="Save Changes" id="button_change_pass" />
                </div>

                <div class="form-group">
                    <small id="message_sp_cp"></small>
                </div>
            </form>
        </div>
            

    </div>
</main>



    <?php
    include("backtotop.php");
    ?>



<style>
    main {
        background: #EFF0F4;
        padding: 15px;
    }
    main .profile_settings {
        display: flex;
        align-items: flex-end;
        margin-left: 15px;
    }
    main .profile_settings img {
        margin-right: 8px;
    }
    main .profile_settings h1 {
        font-family: 'Roboto';
        text-transform: uppercase;
        font-size: 20px;
        color: #333;
    }
    main .profile_div {
        background: #EFF0F4;
        padding: 15px;
    }
    main .profile_div .head_account {
        background: #fff;
        padding: 15px 30px;
    }
   
    main .profile_div .head_account:nth-child(1) {
        background: #324E9E;
    }

    main .profile_div .head_account:nth-child(2) {
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
        $("#dis_staff :input").prop('disabled', true);    
		var new_mobilenumber = $('#number').val();
		var new_position = $('#position').val();
        var type = [];
        $(':checkbox:checked').each(function(i){
          type[i] = $(this).val();
        });
        if(new_mobilenumber!=""&&new_position!=""&&type!=""){
        if (!/^[0-9]+$/.test(new_mobilenumber)) {
            $("#dis_staff :input").prop('disabled', false);   
			$('#message_staffprofile').html('Phone number only a number character'); 
		}
		else if (new_mobilenumber.length != 11) {
            $("#dis_staff :input").prop('disabled', false);   
			$('#message_staffprofile').html('Phone number must be at 11 characters'); 
		}
		else if (new_mobilenumber.substring(0, 2)!='09') {
            $("#dis_staff :input").prop('disabled', false);   
			$('#message_staffprofile').html('Incorrect phone number !!'); 
		}
        else{
			$.ajax({
				url: "staff_profileajax.php",
				type: "POST",
				data: {
					type:1,	
					new_mobilenumber: new_mobilenumber,
                    new_position: new_position,
                    types:type						
				},
                cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){  
                        $('#message_staffprofile').html('Updated profile settings sucessfully !!'); 
                        setTimeout( function() { location.href = "staff_profile.php" }, 1000 );    
					}
                    else if(dataResult.statusCode==201){
                        $("#dis_staff :input").prop('disabled', false);   
						$('#message_staffprofile').html('An Error occured, please refresh the page !!'); 
					}
                    else if(dataResult.statusCode==202){
                        $("#dis_staff :input").prop('disabled', false);   
						$('#message_staffprofile').html('Mobile number already in used, please try another !!'); 
					}
					
				}
			});
        }
    }
    else{
        $("#dis_staff :input").prop('disabled', false);   
		$('#message_staffprofile').html('Please fill all the field !!'); 
    }
		
	});
	// UPDATE PROFILE


    // CHANGE PASS
    $('#button_change_pass').on('click', function() {
        $("#dat_staff :input").prop('disabled', true);  
        var currentpass = $('#currentpass').val();
		var newpass = $('#newpass').val();
		var newpass_verify = $('#newpass_verify').val();
        if(currentpass!=""&&newpass!=""&&newpass_verify!=""){
        if (newpass.length < 8) {
            $("#dat_staff :input").prop('disabled', false); 
      	$("#message_sp_cp").html('Password must be at least 8 characters !!');
        }
      	else if (newpass.length > 16) {
            $("#dat_staff :input").prop('disabled', false);
        $("#message_sp_cp").html('Password must not exceed 16 characters !!'); 
        }
		else if (!/^(?!.* )/.test(newpass)) {
            $("#dat_staff :input").prop('disabled', false);
		$('#message_sp_cp').html('Password must not contain space !!'); 
		}
        else if  (newpass.search(/[a-z]/i) < 0) {
            $("#dat_staff :input").prop('disabled', false);
        $("#message_sp_cp").html('Password must contain at least one letter !!');
        }
        else if  (newpass.search(/[0-9]/) < 0) {
            $("#dat_staff :input").prop('disabled', false);
        $("#message_sp_cp").html('Password must contain at least one digit !!'); 
        }
      	else if (newpass != newpass_verify){
            $("#dat_staff :input").prop('disabled', false);
            $('#message_sp_cp').html('New Password did not match !!'); 
      	}
            else{
			$.ajax({
				url: "staff_profileajax.php",
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
                        $("#dat_staff :input").prop('disabled', false);
                        $('#currentpass').val('');
                        $('#newpass').val('');
                        $('#newpass_verify').val('');
                        $('#message_sp_cp').html('Password updated successfully !!'); 
					}
                    else if(dataResult.statusCode==201){
                        $("#dat_staff :input").prop('disabled', false);
						$('#message_sp_cp').html('An Error occured while changing password, please refresh the page !!'); 
					}
                    else if(dataResult.statusCode==202){
                        $$("#dat_staff :input").prop('disabled', false);
						$('#message_sp_cp').html('Current password did not match !!'); 
					}
					
				}
			});
        }
        }
        else{
            $("#dat_staff :input").prop('disabled', false);
            $('#message_sp_cp').html('Please fill all the field !!'); 
        }
		
	});
	// CHANGE PASS


});
</script>
