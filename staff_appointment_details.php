<?php
    include_once("admin_header.php"); 
?>
    <main>
        <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
        <div>
            <!--------------Start of No. of Active Requests-------------->
            <div>
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
            </div>
            <!--------------End of No. of Active Requests-------------->
            <!--------------Start of No. of Pending Requests-------------->
            <div>
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
            </div>
            <!--------------End of No. of Pending Requests-------------->
            <!--------------Start of No. of Missed Requests-------------->
            <div>
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
            </div>
            <!--------------End of No. of Missed Requests-------------->
            <!--------------Start of No. of Declined Requests-------------->
            <div>
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
            </div>
            <!--------------End of No. of Declined Requests-------------->
            <!--------------Start of No. of Cancelled Requests-------------->
            <div>
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
            </div>
            <!--------------End of No. of Cancelled Requests-------------->
            <!--------------Start of No. of Past Requests-------------->
            <div>
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
            </div>
            <!--------------End of No. of Declined Requests-------------->
        </div>
    <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->

        <div>
            <h2>Appointments</h2>
            <button onclick="activeapp()">Active Appointments</button>
            <button onclick="pendingapp()">Pending Appointments</button>
            <button onclick="missedapp()">Missed Appointments</button>
            <button onclick="declineddapp()">Declined Appointments</button>
            <button onclick="cancelledapp()">Cancelled Appointments</button>
            <button onclick="doneapp()">Past Appointments</button>
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
            <hr>
        </div>
    </main>
</body>
</html>

<?php if(empty($_POST['searchbydate'])){?>
    <style>
        #appactive {
            display: none;
        }
    </style>
    <?php
    }
    ?>
<style>
    #apppending,
    #appmissed,
    #appdeclined,
    #appcancelled,
    #appdone {
        display: none;
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
</script>
