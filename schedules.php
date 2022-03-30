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
.body {
    margin-top: 50px;
    text-align: "center";
    font-size: 17px;
    font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}

#calendar {
    width: 800px;
    margin: 0 auto;
}
.parent-div{
        padding-top: 80px;
        margin-left: 10%;
        margin-right: 20%;
    }
</style>
</head>
<div class="parent-div">
<div class = calendar>
    <h2>Staff Schedules</h2>
    <div class="response"></div>
    <div id='calendar'></div>
</div>
</div>
