<?php 
    include("admin_header.php");
?>

<main>
    <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
    <div>
        <!--------------Start of No. of Active Requests-------------->
        <div>
            <h5>Active Requests</h5>
            <p>
                <?php
                    $acceptedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id'";
                    $acceptedrequest_result = mysqli_query($db, $acceptedrequest);
                    $count = mysqli_num_rows($acceptedrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Active Requests-------------->
        <!--------------Start of No. of Pending Requests-------------->
        <div>
            <h5>Pending Requests</h5>
            <p>
                <?php
                    $pendingrequest="SELECT * FROM tbl_appointment INNER JOIN tbl_staff_registry 
                        ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                        WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                        AND tbl_staff_registry.staff_id = '$staff_id'";
                    $pendingrequest_result = mysqli_query($db, $pendingrequest);
                    $count = mysqli_num_rows($pendingrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Pending Requests-------------->
        <!--------------Start of No. of Missed Requests-------------->
        <div>
            <h5>Missed Requests</h5>
            <p>
                <?php
                    $missedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE DATE(tbl_appointment_detail.appointment_date) < CURDATE() 
                        AND tbl_appointment_detail.status = 'Accepted' 
                        AND tbl_staff_registry.staff_id = '$staff_id'";
                    $missedrequest_result = mysqli_query($db, $missedrequest);
                    $count = mysqli_num_rows($missedrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Missed Requests-------------->

        <!--------------Start of No. of Declined Requests-------------->
        <div>
            <h5>Declined Requests</h5>
            <p>
                <?php
                    $declinedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_appointment_detail.status = 'Declined' AND tbl_appointment.staff_id = '$staff_id'";
                    $declinedrequest_result = mysqli_query($db, $declinedrequest);
                    $count = mysqli_num_rows($declinedrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Declined Requests-------------->
        <!--------------Start of No. of Cancelled Requests-------------->
        <div>
            <h5>Cancelled Requests</h5>
            <p>
                <?php
                    $cancelledrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_appointment_detail.status = 'Cancelled' AND tbl_appointment.staff_id = '$staff_id'";
                    $cancelledrequest_result = mysqli_query($db, $cancelledrequest);
                    $count = mysqli_num_rows($cancelledrequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Cancelled Requests-------------->
        <!--------------Start of No. of Past Requests-------------->
        <div>
            <h5>Past Requests</h5>
            <p>
                <?php
                    $donerequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                        WHERE tbl_appointment_detail.status = 'done' AND tbl_appointment.staff_id = '$staff_id'";
                    $donerequest_result = mysqli_query($db, $donerequest);
                    $count = mysqli_num_rows($donerequest_result);
                    echo $count;
                ?>
            </p>
        </div>
        <!--------------End of No. of Declined Requests-------------->
    </div>
    <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->

    <!----------Viewable only by Registrar----------------------->  
     

</main>
</body>
</html>

 


