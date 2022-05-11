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

<head>
    <title>STUDENT PROFILE</title>
</head>

<div class="parent_div">

    <div>
        <h1>PROFILE</h1>
    </div>

    <div>
        <h2> <?php echo $row["first_name"]," ", $row["last_name"]?></h2>
    </div>

    <div>
        <p> <?php echo $row["username"]?></p>
    </div>

    <div>
        <p> <?php echo $row["course"]," ", $row["year"]?></p>
    </div>

    <hr>





    <div>
        <h2>Update Profile</h2>
    </div>

    <div>
        <p>Student ID: </p>
        <input type="text" name="student_id" value="<?php echo $row["student_id"]?>" disabled />
    </div>

    <div>
        <p>Username: </p>
	    <input type="text" name="username" value="<?php echo $row["username"]?>" disabled />
	</div>

    <div>
        <p>First Name: </p>
        <input type="text" name="first_name" value=<?php echo $row["first_name"]?> disabled />
    </div>
    
    <div>
        <p>Last Name: </p>
        <input type="text" name="last_name" value=<?php echo $row["last_name"]?> disabled />
    </div>

    <form method="post" id="dis">
        <div>
            <p>Mobile Number: </p>
            <input type="tel" name="number" id="profile_number" value="<?php echo $row["mobile_number"]?>" maxlength="11" />
        </div>

        <div>
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


        <div>
            <p>Year: </p> 
            <select name="year" id="profile_year">  
                <option value="1" <?php echo $row["year"]=='1'?'selected':'';?>>1st Year</option>
                <option value="2" <?php echo $row["year"]=='2'?'selected':'';?>>2nd Year</option>
                <option value="3" <?php echo $row["year"]=='3'?'selected':'';?>>3rd Year</option>
                <option value="4" <?php echo $row["year"]=='4'?'selected':'';?>>4th Year</option>
            </select>
        </div>
    
        <div>
            <input type="button" name="button_edit_profile" value="Save Changes" id="button_edit_profile" />
        </div>

        <div class="form-group">
		    <small id="message3" class="" style="color:red;"></small>
	    </div>
    </form>
        <hr>
    






    <form method="post" id="dat">
        <div>
            <h2>Change Password</h2>
        </div>

        <p>Current password</p>
        <div>
            <input type="password" name="currentpass" id="profile_currentpass" placeholder="Current password" autocomplete="off" />
        </div>
        
        <p>New Password</p>
        <div >
            <input type="password" name="newpass" id="profile_newpass" placeholder="New password" autocomplete="off" />
        </div>
        
        <div>
            <small>password must be at least 5 characters and have a number character, e.g. 1234567890</small>
        </div>

        <p>Re-enter New Password</p>
        <div>
            <input type="password" name="newpass_verify" id="profile_newpass_verify" placeholder="Re-enter new password" autocomplete="off" />
        </div>

        <div>
            <input type="button" name="button_change_pass" value="Save Changes" id="button_change_pass" />
        </div>

        <div class="form-group">
		    <small id="changepass_message1" class="" style="color:red;"></small>
	    </div>
    </form>



    
</div>

<?php include("backtotop.php"); ?>


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


