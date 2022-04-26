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
        <span>Student ID: </span>
        <input type="text" name="student_id" value="<?php echo $row["student_id"]?>" disabled />
    </div>

    <div>
        <span>Username: </span>
	    <input type="text" name="username" value="<?php echo $row["username"]?>" disabled />
	</div>

    <div>
        <span>First Name: </span>
        <input type="text" name="first_name" value=<?php echo $row["first_name"]?> disabled />
    </div>
    
    <div>
        <span>Last Name: </span>
        <input type="text" name="last_name" value=<?php echo $row["last_name"]?> disabled />
    </div>

    <form  method="POST" id="dis">
        <div>
            <span>Mobile Number: </span>
            <input type="tel" name="number" id="number" value="<?php echo $row["mobile_number"]?>" maxlength="11" />
        </div>

        <div>
            <span>Course:</span>
            <select name="course" id="course">  
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
            <span>Year: </span> 
            <select name="year" id="year">  
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

        <hr>

        <div>
            <h2>Change Password</h2>
        </div>

        <span>Current password</span>
        <div>
            <input type="password" name="currentpass" id="currentpass" placeholder="Current password" autocomplete="off" />
        </div>
        
        <span>New Password</span>
        <div >
            <input type="password" name="newpass" id="newpass" placeholder="New password" autocomplete="off" />
        </div>
        
        <div>
            <small>password must be at least 5 characters and<br /> have a number character, e.g. 1234567890</small>
        </div>

        <span>Re-enter New Password</span>
        <div>
            <input type="password" name="newpass_verify" id="newpass_verify" placeholder="Re-enter new password" autocomplete="off" />
        </div>

        <div>
            <input type="button" name="button_change_pass" value="Save Changes" id="button_change_pass" />
        </div>

        <div class="form-group">
		    <small id="message1" class="" style="color:red;"></small>
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
		var new_mobilenumber = $('#number').val();
		var new_course = $('#course').val();
        var new_year = $('#year').val();;
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


