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
<hr>

    <div><h1>PROFILE</h1></div>
    <div><h2> <?php echo $row["first_name"]," ", $row["last_name"]?></h2></div>
    <div><p> <?php echo $row["username"]?></p></div>
    <div><p> <?php echo $row["mobile_number"]?></p></div>
    <hr>

    <div><h2>Update Profile</h2></div>
    <div>
        Student ID: <input type="text" name="student_id" value="<?php echo $row["staff_id"]?>" disabled />
    </div>

    <div class="">
	    Username: <input type="text" name="username" value="<?php echo $row["username"]?>" disabled />
	</div>

    <div>
        First Name: <input type="text" name="first_name" value=<?php echo $row["first_name"]?> disabled />
    </div>
    
    <div>
        Last Name: <input type="text" name="last_name" value=<?php echo $row["last_name"]?> disabled />
    </div>

    <form  method="POST" action="#" id="dis">
        <div>
            Mobile Number: <input type="tel" name="number" id="number" value="<?php echo $row["mobile_number"]?>" maxlength="11" autocomplete="off" />
        </div>
        <?php 
            if ($position == 'Registrar') {?>
        <div>
            Position: 
            <select name="position" id="position">  
                <option value="Registrar" selected>Registrar</option>  
            </select>  </div>

        <div><label>Appointment Type: </label></div>
        <div>
            <input type="checkbox" name="check_list[]" value="Request Documents From Registrar" <?php echo in_array("Request Documents From Registrar", $array_type)?'checked':'';?>>
            <label> Request Documents From Registrar</label><br>
            <input type="checkbox" name="check_list[]" value="Evaluation of Grades" <?php echo in_array("Evaluation of Grades", $array_type)?'checked':'';?>>
            <label> Evaluation of Grades - Department Head</label><br>
            <input type="checkbox" name="check_list[]" value="Enrollment" <?php echo in_array("Enrollment", $array_type)?'checked':'';?>>
            <label> Enrollment</label><br>
            <input type="checkbox" name="check_list[]" value="Pre-Enrollment" <?php echo in_array("Pre-Enrollment", $array_type)?'checked':'';?>>
            <label> Pre-Enrollment</label><br>
            <input type="checkbox" name="check_list[]" value="UniFAST - Claim Cheque" <?php echo in_array("UniFAST - Claim Cheque", $array_type)?'checked':'';?>>
            <label> UniFAST - Claim Cheque</label><br>
            <input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents" <?php echo in_array("UniFAST - Submit Documents", $array_type)?'checked':'';?>>
            <label> UniFAST - Submit Documents</label><br>
            <input type="checkbox" name="check_list[]" value="Meeting" <?php echo in_array("Meeting", $array_type)?'checked':'';?>>
            <label> Meeting</label><br>
            <input type="checkbox" name="check_list[]" value="Module Claiming/Submission" <?php echo in_array("Module Claiming/Submission", $array_type)?'checked':'';?>>
            <label> Module Claiming/Submission</label><br>
            <input type="checkbox" name="check_list[]" value="Request for Grades" <?php echo in_array("Request for Grades", $array_type)?'checked':'';?>>
            <label> Request for Grades</label><br>
            <input type="checkbox" name="check_list[]" value="Project Submission" <?php echo in_array("Project Submission", $array_type)?'checked':'';?>>
            <label> Project Submission</label><br>
            <input type="checkbox" name="check_list[]" value="Presentation" <?php echo in_array("Presentation", $array_type)?'checked':'';?>>
            <label> Presentation</label><br>
        </div>
        <?php 
            }
            else {?>
                <div>
                    Position: 
                    <select name="position" id="position">  
                        <option value="Teacher" <?php echo $row["position"]=='Teacher'?'selected':''?>>Teacher</option>  
                        <option value="Accounting Staff/Scholarship Coordinator" <?php echo $row["position"]=='Accounting Staff/Scholarship Coordinator'?'selected':''?>>Accounting Staff/Scholarship Coordinator</option>  
                    </select>  
                </div>

        <div><label>Appointment Type: </label></div>
        <div>
            <input type="checkbox" name="check_list[]" value="Evaluation of Grades" <?php echo in_array("Evaluation of Grades", $array_type)?'checked':'';?>>
            <label> Evaluation of Grades - Department Head</label><br>
            <input type="checkbox" name="check_list[]" value="UniFAST - Claim Cheque" <?php echo in_array("UniFAST - Claim Cheque", $array_type)?'checked':'';?>>
            <label> UniFAST - Claim Cheque</label><br>
            <input type="checkbox" name="check_list[]" value="UniFAST - Submit Documents" <?php echo in_array("UniFAST - Submit Documents", $array_type)?'checked':'';?>>
            <label> UniFAST - Submit Documents</label><br>
            <input type="checkbox" name="check_list[]" value="Meeting" <?php echo in_array("Meeting", $array_type)?'checked':'';?>>
            <label> Meeting</label><br>
            <input type="checkbox" name="check_list[]" value="Module Claiming/Submission" <?php echo in_array("Module Claiming/Submission", $array_type)?'checked':'';?>>
            <label> Module Claiming/Submission</label><br>
            <input type="checkbox" name="check_list[]" value="Project Submission" <?php echo in_array("Project Submission", $array_type)?'checked':'';?>>
            <label> Project Submission</label><br>
            <input type="checkbox" name="check_list[]" value="Presentation" <?php echo in_array("Presentation", $array_type)?'checked':'';?>>
            <label> Presentation</label><br>
        </div>
        <?php } ?>
    
        

        <div>
        <input type="button" name="button_edit_profile" value="Save Changes" id="button_edit_profile" />
        </div>
        <div class="form-group">
		<small id="message" class="" style="color:red;"></small>
	    </div>        
    <hr>
        <div><h2>Change Password</h2></div>
        <label>Current password</label>
        <div>
            <input type="password" name="currentpass" id="currentpass" placeholder="Current password" autocomplete="off" />
        </div>
        <label>New Password</label>
        <div >
            <input type="password" name="newpass" id="newpass" placeholder="New password" autocomplete="off" />
        </div>
        <div class="">
            <small>password must be at least 5 characters and<br /> have a number character, e.g. 1234567890</small>
        </div>
        <label>Re-enter New Password</label>
        <div>
            <input type="password" name="newpass_verify" id="newpass_verify" placeholder="Re-enter new password" autocomplete="off" />

        <div>
            <input type="button" name="button_change_pass" value="Save Changes" id="button_change_pass" />
        </div>
        <div class="form-group">
		<small id="message1" class="" style="color:red;"></small>
	    </div>
    </form>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // UPDATE PROFILE
	$('#button_edit_profile').on('click', function() { 
        $("#dis :input").prop('disabled', true);    
		var new_mobilenumber = $('#number').val();
		var new_position = $('#position').val();
        var type = [];
        $(':checkbox:checked').each(function(i){
          type[i] = $(this).val();
        });
        if(new_mobilenumber!=""&&new_position!=""&&type!=""){
        if (!/^[0-9]+$/.test(new_mobilenumber)) {
            $("#dis :input").prop('disabled', false);   
			$('#message').html('Phone number only a number character'); 
		}
		else if (new_mobilenumber.length != 11) {
            $("#dis :input").prop('disabled', false);   
			$('#message').html('Phone number must be at 11 characters'); 
		}
		else if (new_mobilenumber.substring(0, 2)!='09') {
            $("#dis :input").prop('disabled', false);   
			$('#message').html('Incorrect phone number !!'); 
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
                        $('#message').html('Updated profile settings sucessfully !!'); 
                        setTimeout( function() { location.href = "staff_profile.php" }, 1000 );    
					}
                    else if(dataResult.statusCode==201){
                        $("#dis :input").prop('disabled', false);   
						$('#message').html('An Error occured, please refresh the page !!'); 
					}
                    else if(dataResult.statusCode==202){
                        $("#dis :input").prop('disabled', false);   
						$('#message').html('Mobile number already in used, please try another !!'); 
					}
					
				}
			});
        }
    }
    else{
        $("#dis :input").prop('disabled', false);   
		$('#message').html('Please fill all the field !!'); 
    }
		
	});
	// UPDATE PROFILE


    // CHANGE PASS
    $('#button_change_pass').on('click', function() {
        $("#dis :input").prop('disabled', true);  
        var currentpass = $('#currentpass').val();
		var newpass = $('#newpass').val();
		var newpass_verify = $('#newpass_verify').val();
        if(currentpass!=""&&newpass!=""&&newpass_verify!=""){
        if (newpass.length < 8) {
            $("#dis :input").prop('disabled', false); 
      	$("#message1").html('Password must be at least 8 characters !!');
        }
      	else if (newpass.length > 16) {
            $("#dis :input").prop('disabled', false);
        $("#message1").html('Password must not exceed 16 characters !!'); 
        }
		else if (!/^(?!.* )/.test(newpass)) {
            $("#dis :input").prop('disabled', false);
		$('#message1').html('Password must not contain space !!'); 
		}
        else if  (newpass.search(/[a-z]/i) < 0) {
            $("#dis :input").prop('disabled', false);
        $("#message1").html('Password must contain at least one letter !!');
        }
        else if  (newpass.search(/[0-9]/) < 0) {
            $("#dis :input").prop('disabled', false);
        $("#message1").html('Password must contain at least one digit !!'); 
        }
      	else if (newpass != newpass_verify){
            $("#dis :input").prop('disabled', false);
            $('#message1').html('New Password did not match !!'); 
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
                        $("#dis :input").prop('disabled', false);
                        $('#currentpass').val('');
                        $('#newpass').val('');
                        $('#newpass_verify').val('');
                        $('#message1').html('Password updated successfully !!'); 
					}
                    else if(dataResult.statusCode==201){
                        $("#dis :input").prop('disabled', false);
						$('#message1').html('An Error occured while changing password, please refresh the page !!'); 
					}
                    else if(dataResult.statusCode==202){
                        $$("#dis :input").prop('disabled', false);
						$('#message1').html('Current password did not match !!'); 
					}
					
				}
			});
        }
        }
        else{
            $("#dis :input").prop('disabled', false);
            $('#message1').html('Please fill all the field !!'); 
        }
		
	});
	// CHANGE PASS


});
</script>


<?php
 include("backtotop.php");
?>
</main>

