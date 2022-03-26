<?php
    include_once("admin_header.php"); 
?>
    <main >
        <h2>Appointments</h2>
        <button onclick="activeapp()">Active Appointments</button>
        <button onclick="pendingapp()">Pending Appointments</button>
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
    function declineddapp() {
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
