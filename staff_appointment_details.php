<?php
    include_once("admin_header.php"); 
?>
    <main><!-------------------------------Start of main div------------------------------------>

        <div class="container-fluid"><!-------------------------------Start of Show Appointment Based on Status ------------------------------->
            
            <div class="row">
                <?php
                     include("count_app.php");
                ?>
            </div>

            <div class="row">
                <?php
                    if (isset($_GET['status'])){
                ?> 
                <hr>
                <a href="staff_appointment_details.php"><button type="button">View all appointment</button></a><hr> <?php 
                
                include("staff_pending_requests.php");   
                }
                else{
            ?>
            </div>

            <div class="row">
                <h3>Appointments</h3> 
            </div>

            <div class="row">
                    <!--success or error-->
                    <?php 
                            if(isset($_GET['success'])){
                        ?>
                                <p align="center">
                                    <?php 
                                        echo $_GET['success'];
                                    ?>
                                </p>
                        <?php
                            }
                            if(isset($_GET['error'])){
                        ?>
                                        <p align="center">
                                            <?php 
                                                echo $_GET['error'];
                                            ?>
                                        </p>
                                <?php
                                    }
                            else{
                            }
                        ?>
                        <!--success or error-->
            </div>

            <div class="row">                       
                <!------Start of Appointment Status Buttons ---------------------->
                
                <div class="form-group" role="group" aria-label="Basic example">
                    <div class="form-inline">
                        <button class="btn btn-secondary" onclick="activeapp()">Active</button>
                        <button class="btn btn-secondary" onclick="pendingapp()">Pending</button>
                        <button class="btn btn-secondary" onclick="missedapp()">Missed</button>
                        <button class="btn btn-secondary" onclick="declineddapp()">Declined</button>
                        <button class="btn btn-secondary" onclick="cancelledapp()">Cancelled</button>
                        <button class="btn btn-secondary" onclick="doneapp()">Past</button>
                    </div>
                </div>
                <!------ End of of Appointment Status Buttons -------------------->
            </div>

            <div class="row"><!------- Start of Appointment Status Includes ------------------>
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
            </div><!------End of Appointment Status Includes ----------><?php } ?>
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
        background: violet;
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
    if (window.location.hash === '#displaypending') { 
        function displaypending(){

        document.getElementById('appactive').style.display = "none";
            document.getElementById('apppending').style.display = "block";
            document.getElementById('appmissed').style.display = "none";
            document.getElementById('appdeclined').style.display = "none";
            document.getElementById('appcancelled').style.display = "none";
            document.getElementById('appdone').style.display = "none";
    };}
 
</script>
