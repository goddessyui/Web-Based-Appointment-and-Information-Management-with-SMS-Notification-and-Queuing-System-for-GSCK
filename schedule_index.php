
<!DOCTYPE html>
<html lang="en">
<head>
<title>Event Calendar</title>
	
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/schedule/fullcalendar/fullcalendar.min.css" />
<script src="css/schedule/fullcalendar/lib/jquery.min.js"></script>
<script src="css/schedule/fullcalendar/lib/moment.min.js"></script>
<script src="css/schedule/fullcalendar/fullcalendar.min.js"></script>

<script>
$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "Staff/schedule/fetch-event.php",
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

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>

<style>
body {
    margin-top: 50px;
    text-align: center;
    font-size: 17px;
    font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}

#calendar {
    width: 800px;
    margin: 0 auto;
}




</style>
</head>
<body>
    <h2>Staff Schedules</h2>

    <div class="response"></div>
    <div id='calendar'></div>
</body>

</body>
</html>