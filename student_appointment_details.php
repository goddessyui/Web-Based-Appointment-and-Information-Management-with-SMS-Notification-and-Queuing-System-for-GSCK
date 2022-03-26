<?php
include("header.php");

?>
<!-- Active/Accepted Appointments-->
<div class="parent-div">
    
    <h3>Student Appointment Details</h3><br><hr>

        <button onclick="activeapp()">Active Appointments</button>
        <button onclick="pendingapp()">Pending Appointments</button>
        <button onclick="declineddapp()">Declined Appointments</button>
        <button onclick="cancelledapp()">Cancelled Appointments</button>
        <button onclick="doneapp()">Past Appointments</button>
        <div>
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
        </div>
        
       
</div>
<style>
    .parent-div{
        padding-top: 150px;
        margin-left: 15%;
        margin-right: 15%;
    }
    #appactive,
    #apppending,
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
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function pendingapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "block";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function declinedapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appdeclined').style.display = "block";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    }
    function cancelledapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "block";
            document.getElementById('appdone').style.display = "none";
    }
    function doneapp() {
            document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "block";
    }

</script>

