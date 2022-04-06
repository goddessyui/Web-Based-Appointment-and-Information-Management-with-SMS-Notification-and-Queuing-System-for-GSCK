<?php
    include_once("admin_header.php"); 
?>
    <main><!-------------------------------Start of main div------------------------------------>
    <?php
        include("count_app.php");
       ?>


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
        <?php
         include("backtotop.php");
        ?>
    </main><!-------------------------------End of main div--------------------------------------------------------------------------->
</body>
</html>

<style>
    main {
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 100px;
    }
    .sc_container{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .status_count{
    width: 33.33%;
    background-color:lightgray;
    text-align: center;
    padding: 20px;
    }
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
