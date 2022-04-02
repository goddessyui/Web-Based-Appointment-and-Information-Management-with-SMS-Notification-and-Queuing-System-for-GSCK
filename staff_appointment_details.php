<?php
    include_once("admin_header.php"); 
?>
    <main><!-------------------------------Start of main div------------------------------------>
        <div><!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
            <div><!--------------Start of No. of Active Requests-------------->
                <h5>Active Appointments</h5>
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
            </div><!--------------End of No. of Active Requests-------------->
            <div><!--------------Start of No. of Pending Requests-------------->
                <h5>Pending Appointments</h5>
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
            </div><!--------------End of No. of Pending Requests-------------->
            <div><!--------------Start of No. of Missed Requests-------------->
                <h5>Missed Appointments</h5>
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
            </div><!--------------End of No. of Missed Requests-------------->
            <div> <!--------------Start of No. of Declined Requests-------------->
                <h5>Declined Appointments</h5>
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
            </div><!--------------End of No. of Declined Requests-------------->
            <div><!--------------Start of No. of Cancelled Requests-------------->
                <h5>Cancelled Appointments</h5>
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
            </div><!--------------End of No. of Cancelled Requests-------------->
            <div><!--------------Start of No. of Past Requests-------------->
                <h5>Past Appointments</h5>
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
            </div><!--------------End of No. of Declined Requests-------------->
        </div><!----End of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->

        <div><!-------------------------------Start of Show Appointment Based on Status ------------------------------->
            <h2>Appointments</h2>
            <!------Start of Appointment Status Buttons ---------------------->
            <button onclick="activeapp()">Active Appointments</button>
            <button onclick="pendingapp()">Pending Appointments</button>
            <button onclick="missedapp()">Missed Appointments</button>
            <button onclick="declineddapp()">Declined Appointments</button>
            <button onclick="cancelledapp()">Cancelled Appointments</button>
            <button onclick="doneapp()">Past Appointments</button>
            <!------ End of of Appointment Status Buttons -------------------->

            <div><!------- Start of Appointment Status Includes ------------------>
                <div id="appactive">
                    <h4>Active Appointments</h4>
                    <?php
                        include("staff_accepted_requests.php");
                    ?>
                </div>
                <div id="apppending">                                 
                    <h4>Pending Appointments</h4>
                    <?php
                        include("staff_pending_requests.php");
                    ?>
                </div>
                <div id="appmissed">                                 
                    <h4>Missed Appointments</h4>
                    <?php
                        include("staff_missed_requests.php");
                    ?>
                </div>
                <div id="appdeclined">
                    <h4>Declined Appointments</h4>
                    <?php
                        include("reports/staff_declined_requests.php");
                    ?>
                </div>
                <div id="appcancelled">
                    <h4>Cancelled Appointments</h4>
                    <?php
                        include("reports/staff_cancelled_requests.php");
                    ?>
                </div>
                <div id="appdone">
                    <h4>Past Appointments</h4>
                    <?php
                        include("reports/staff_done_requests.php");
                    ?>
                </div>
            </div><!------End of Appointment Status Includes ---------->
            <hr>
        </div><!-------------------------------End of Show Appointment Based on Status -------------------------->
        <!-------------------------------Start of the BACK TO TOP BUTTON ---------------------------------------->
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        <!-------------------------------Start End of the BACK TO TOP BUTTON ------------------------------------>
    </main><!-------------------------------End of main div--------------------------------------------------------------------------->
</body>
</html>

<style>
    #apppending,
    #appmissed,
    #appdeclined,
    #appcancelled,
    #appdone {
        display: none;
    }

    #myBtn {
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
    }
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
    function declineddapp() {
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
</script>
