<?php
include("header.php");
$student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
if (empty($_SESSION['student_id'])){
        echo '<script type="text/javascript">window.location.href="index.php"</script>';
    }

?>
<!-- Active/Accepted Appointments-->
<div class="parent-div">
    <div><!---------Start of No. of Appointments (Active, Pending, Declined, Cancelled, Past)-------------------------------->
        <div><!---------Start of No. of Active Appointments-------------------------------->
            <h5>Active Appointments</h5>
            <p>
                <?php
                    $acceptedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                        tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Accepted'";
                    $accepted_appointment_list = mysqli_query($db, $acceptedappointment);
                    $count = mysqli_num_rows($accepted_appointment_list); 
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Active Appointments-------------------------------->
        <!---------Start of No. of Pending Appointments-------------------------------->
        <div>
            <h5>Pending Appointments</h5>
            <p>
                <?php
                    $pendingappointment="SELECT * FROM tbl_appointment INNER JOIN tbl_staff_registry 
                    ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                    WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                    AND tbl_student_registry.student_id = '$student_id' AND tbl_appointment.status = 'Pending'";
                    $pending_appointment_list = mysqli_query($db, $pendingappointment);
                    $count = mysqli_num_rows($pending_appointment_list);
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Pending Appointments-------------------------------->
        <!---------Start of No. of Missed Appointments-------------------------------->
        <div>
            <h5>Missed Appointments</h5>
            <p>
                <?php
                    $missedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
                        tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE DATE(tbl_appointment_detail.appointment_date) < CURDATE() 
                        AND tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Accepted'";
                    $missed_appointment_list = mysqli_query($db, $missedappointment);
                    $count = mysqli_num_rows($missed_appointment_list);
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Missed Appointments-------------------------------->
        <!---------Start of No. of Declined Appointments-------------------------------->
        <div>
            <h5>Declined Appointments</h5>
            <p>
                <?php
                    $declinedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                        tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Declined'";
                    $declined_appointment_list = mysqli_query($db, $declinedappointment);
                    $count = mysqli_num_rows($declined_appointment_list); 
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Declined Appointments-------------------------------->
        <!---------Start of No. of Cancelled Appointments-------------------------------->
        <div>
            <h5>Cancelled Appointments</h5>
            <p>
                <?php
                    $cancelledappointments="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                        tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Cancelled'";
                    $cancelled_appointment_list = mysqli_query($db, $cancelledappointments);
                    $count = mysqli_num_rows($cancelled_appointment_list); 
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Cancelled Appointments-------------------------------->
        <!---------Start of No. of Past Appointments-------------------------------->
        <div>
            <h5>Past Appointments</h5>
            <p>
                <?php
                    $doneappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
                        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, 
                        tbl_staff_registry.last_name, tbl_appointment.note, tbl_appointment_detail.comment
                        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Done'";
                    $done_appointment_list = mysqli_query($db, $doneappointment);
                    $count = mysqli_num_rows($done_appointment_list); 
                    echo $count;
                ?>
            </p>
        </div>
        <!---------End of No. of Past Appointments-------------------------------->
    </div><!---------End of No. of Appointments (Active, Pending, Declined, Cancelled, Past)-------------------------------->
    
    <div><!---------Start of Show Appointment Based on Status----------------------------------->
    <h3>Student Appointment Details</h3><br><hr>
        <!------Start of Appointment Status Buttons ---------------------->
        <button onclick="activeapp()">Active Appointments</button>
        <button onclick="pendingapp()">Pending Appointments</button>
        <button onclick="missedapp()">Missed Appointments</button>
        <button onclick="declinedapp()">Declined Appointments</button>
        <button onclick="cancelledapp()">Cancelled Appointments</button>
        <button onclick="doneapp()">Past Appointments</button>
         <!------End of Appointment Status Buttons ---------------------->
        <div> <!------Start of Appointment Status Includes ---------->
            <div id="appactive">
                <h4>Active Appointments</h4>
                <?php
                    include("reports/student_accepted_app.php");
                ?>
            </div>
            <div id="apppending">
                <h4>Pending Appointments</h4>
                <?php
                    include("reports/student_pending_app.php");
                ?>
            </div>
            <div id="appmissed">
                <h4>Missed Appointments</h4>
                <?php 
                    include("reports/student_missed_app.php");
                ?>
            </div>
            <div id="appdeclined">
                <h4>Declined Appointments</h4>
                <?php
                    include("reports/student_declined_app.php");
                ?>
            </div>
            <div id="appcancelled">
                <h4>Cancelled Appointments</h4>
                <?php
                    include("reports/student_cancelled_app.php");
                ?>
            </div>
            <div id="appdone">
                <h4>Past Appointments</h4>
                <?php
                    include("reports/student_done_app.php");
                ?>
            </div>
        </div> <!------End of Appointment Status Includes ---------->
    </div><!---------End of Show Appointment Based on Status----------------------------------->
    <!-------------------------------Start of the BACK TO TOP BUTTON ------------------------------------>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    <!-------------------------------End of the BACK TO TOP BUTTON ------------------------------------>        
</div><!--End of parent-div-->
<style>
    .parent-div{
        padding-top: 150px;
        margin-left: 15%;
        margin-right: 15%;
    }
    #appactive,
    #apppending,
    #appmissed,
    #appdeclined,
    #appcancelled,
    #appdone {
        display: none;
    }
    #myBtn { /*--------------START OF THE CSS FOR THE BACK TO TOP BUTTON------------------------*/
        display: none; /* Hidden by default */
        position: fixed; /* Fixed/sticky position */
        bottom: 20px; /* Place the button at the bottom of the page */
        right: 30px; /* Place the button 30px from the right */
        z-index: 99; /* Make sure it does not overlap */
        border: none; /* Remove borders */
        outline: none; /* Remove outline */
        background-color: red; /* Set a background color */
        color: white; /* Text color */
        cursor: pointer; /* Add a mouse pointer on hover */
        padding: 15px; /* Some padding */
        border-radius: 10px; /* Rounded corners */
        font-size: 18px; /* Increase font size */
    }

    #myBtn:hover {
        background-color: #555; /* Add a dark-grey background on hover */
    } /*--------------END OF THE CSS FOR THE BACK TO TOP BUTTON------------------------*/
</style>

<script>

    function activeapp() {
            document.getElementById('appactive').style.display = "block";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function pendingapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "block";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function missedapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "block";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function declinedapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "block";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function cancelledapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "block";
            document.getElementById('appdone').style.display = "none";
    }
    function doneapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "block";
    }
    //--------------START OF THE SCRIPT FOR THE BACK TO TOP BUTTON------------------------//
    //Get the button:
    mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
    //--------------END OF THE SCRIPT FOR THE BACK TO TOP BUTTON------------------------//

</script>

