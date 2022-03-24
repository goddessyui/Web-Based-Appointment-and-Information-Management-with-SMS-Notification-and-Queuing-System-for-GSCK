<?php
    include_once("admin_header.php"); 
?>
    <main>
        <h2>Appointments</h2>
        <h4>Pending Appointments</h4>
        <?php
            include("staff_pending_requests.php");
        ?>
        <hr>
        <h4>Active Appointments</h4>
        <?php
            include("staff_accepted_requests.php");
        ?>
        <hr>
    </main>
</body>
</html>
