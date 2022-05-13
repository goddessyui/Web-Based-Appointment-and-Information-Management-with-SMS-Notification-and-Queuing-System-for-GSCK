<?php
include("header.php");
?>

<!-- This File will show the Calendar Staff Schedules for the user(Student) and visitor -->
<head>
<link rel="stylesheet" href="css/schedule/fullcalendar/fullcalendar.min.css" />
<script src="css/schedule/fullcalendar/lib/jquery.min.js"></script>
<script src="css/schedule/fullcalendar/lib/moment.min.js"></script>
<script src="css/schedule/fullcalendar/fullcalendar.min.js"></script>

<script>
$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "fetch-event.php",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: false,
        selectHelper: false,
        
        
        editable: false,
    });
});

</script>

<style>

    #calendar {
        width: 96%;
        margin: 0 auto;
    }
    .parent-div{
        margin-top: 80px;
        padding-top: 40px;
    }
    
    .select_teacher {
        width: 96%;
        margin: 0 auto;
    }
    .select_teacher h2 {
        font-family: 'Roboto';
        font-size: 20px;
        color: #333;
        margin-bottom: 12px;
    }
    .select_teacher select {
        width: 220px;
        height: 30px;
        border: 1px solid lightgrey;
        margin-bottom: 40px;
    }

  
     .fc-left h2 {
        color: #333;
        font-family: 'Roboto';
        transform: translateY(15px);
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 400;
    }

     .fc-day-header {
        font-family: 'Roboto';
        font-size: 14px;
        color: #333;
        height: 30px;
        line-height: 30px;
        font-weight: 400;
    }

     .fc-day-number {
        font-family: 'Roboto Serif';
        font-size: 20px;
        margin-right: 12px;
        margin-top: 8px;
    }

     .fc-widget-content {
        cursor: pointer;
    }

     .fc-content {
        background: #324E9E;
        padding: 2px;
        padding-left: 8px;
        font-family: 'Roboto'
    }
     .fc-icon {
        background: none;
    }
     .fc-prev-button {
        background: #fff;
        height: 30px;
        border-radius: 0;
    }
    .fc-next-button {
        background: #fff;
        border-radius: 0;
        height: 30px;
    }
    .fc-today-button {
        background: #324E9E;
        color: #fff;
        opacity: 1;
        border-radius: 0;
        text-transform: uppercase;
        font-size: 13px;
        height: 30px;
    }
    .fc-view-container {
        margin-top: 20px;
    }

    @media screen and (max-width: 652px) {
     
        .parent-div{
        margin: 0 auto;
        margin-top: 60px;
        padding-top: 40px;
        width: 96%;
        
    }
    }
</style>

</head>
<div class="parent-div">
    <div class = calendar>
        <div class="select_teacher">
                <h2>Staff Schedules</h2> 
                <select onchange="location = this.value;">
                <option value="" selected>All</option>
                <?php
                    $sql = "SELECT
                    tbl_staff_registry.first_name,
                    tbl_staff_registry.last_name
                    FROM
                    tbl_staff_registry
                    ORDER BY last_name ASC";
                    $res = mysqli_query($db, $sql);
                    if (mysqli_num_rows($res) > 0) {

                        while ($row = mysqli_fetch_assoc($res)) {
                            # code...
                    ?>
                    <option value="staff_schedule.php?name=<?php echo $row['first_name'],' ',$row['last_name'];?>"><?php echo $row['first_name'],' ',$row['last_name'];?></option>
                                            
                    <?php

                        }
                    }

                    ?>

        </select>  
    </div>

    <div class="response"></div>
    <div id='calendar'></div>
    </div>
</div>



