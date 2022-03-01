<?php
include("../db_connection.php"); 

?>

<main>
  
    <div>
        <h3>Pending Requests</h3>
        <?php
        //if (isset($_SESSION['staff_username'])) {
            $requests="SELECT * FROM tbl_appointment 
            INNER JOIN tbl_staff_registry 
            ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
            WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
            WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
            AND `status` ='pending' ORDER BY appointment_id";
            //AND tbl_appointment.staff_id = '$staff_id' 
             $request_result = mysqli_query($conn, $requests);
             //check whether the query is executed or not
            if($request_result==TRUE) 
            {   // count rows to check whether we have data in database or not
                $count = mysqli_num_rows($request_result);  //function to get all the rows in database
                //check the num of rows                 
                if($count>0) //we have data in database
                {
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($request_result)) 
                    //using while loop to get all the date from database
			        //and while loop will run as long as we have data in database
                    {
        ?>

                        <div>
                            <td>
                                <?php   echo $i;
		                  	            $i++; 
                                ?>
                            </td>
                            <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                            <p><span>Request Date: </span><?php echo $rows['date_created']; ?></p> 
				            <p><span>Student:</span> <?php echo $rows['first_name']." ".$rows['last_name']; ?></p>
                            <p><span>Course and Year:</span> <?php echo $rows['course']." ".$rows['year']; ?></p>
                            <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                            <p><span>Note: </span><?php echo $rows['note']; ?></p> 
			            </div>
                        <div>
				            <?php
					            date_default_timezone_set('Asia/Manila');                           		
					            $currentdate = date("Y-m-d");
				            ?>
				            <span>
				            <form action="accept.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
	      	 		            <input type="date" name="appointment_date" placeholder="" value="<?php echo $currentdate; ?>"
	      	 				    min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', strtotime($currentdate. ' + 20 days'));?>"><br>
                                   <textarea name="comment" placeholder="Comment here" value=""></textarea><br>
                                   <button type="submit" name="accept">ACCEPT</button>
	      	 				<br>
	      	 		        
            
	      		            </form>
	      		            </span>
	      		           
                            <button id="decline"><a href="decline.php?appointment_id=<?php echo $rows['appointment_id']; ?>">DECLINE</a> </button>
			
		                </div>


        <?php 
                    }
                }
            }
        //}    
	    ?>
       



        
    </div>


</main>