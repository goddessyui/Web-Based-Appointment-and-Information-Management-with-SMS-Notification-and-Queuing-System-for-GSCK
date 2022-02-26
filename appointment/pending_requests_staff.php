<?php
include("../db_connection.php"); 

?>

<main>
  
    <div>
        <h3>Pending Requests</h3>
        <?php 
            $requests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment ON tbl_appointment_detail.appointment_id =
            tbl_appointment.appointment_id INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
            WHERE status ='pending' ORDER BY appointment_detail_id";

                        $request_result = mysqli_query($conn, $requests);
            if($request_result==TRUE) 
            {
                $count = mysqli_num_rows($request_result);                   
                if($count>0) 
                {
                    $i = 1;
                    while($rows=mysqli_fetch_assoc($request_result)) 
                    {
        ?>

                        <div>
                            <p><span>Appointment #:</span> <?php echo $rows["appointment_id"]; ?></p>
                            <p><span>Request Date: </span><?php echo $rows["date_created"]; ?></p> 
				            <p><span>Student:</span> <?php echo $rows["first_name"]." ".$rows['last_name']; ?></p>
                            <p><span>Appointment Type: </span><?php echo $rows["appointment_type"]; ?></p>
                            <p><span>Note: </span><?php echo $rows["note"]; ?></p> 
			            </div>
                        <div>
				            <?php
					            date_default_timezone_set('Asia/Manila');                           		
					            $currentdate = date("Y-m-d");
				            ?>
				            <p>Manage Appointment Date</p>
				            <span>
				            <form action="update.php?appointment_id=<?=$rows['appointment_id']?>" method="post">
	      	 		        <input type="date" name="appointment_date" placeholder="" value="<?php echo $rows["appointment_date"]; ?>" 
	      	 				    min="<?php echo $currentdate ?>" max="<?php echo date('Y-m-d', strtotime($rows["appointment_date"]. ' + 20 days'));?>">
	      	 				<br>
	      	 				<br>
	      	 		        <input id="update" type="submit" name="update" value="UPDATE APPOINTMENT DATE">
	      		            </form>
	      		            </span>
	      		            <button id="accept"><a href="accept.php?appointment_id=<?php echo $rows["appointment_id"]; ?>">ACCEPT</a> </button>
                            <button id="decline"><a href="decline.php?appointment_id=<?php echo $rows["appointment_id"]; ?>">DECLINE</a> </button>
			
		                </div>


        <?php 
                    }
                }
            }
	    ?>
       

    </div>


</main>