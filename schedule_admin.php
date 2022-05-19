<?php
include_once("new_header_admin.php"); 

$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];
$query = mysqli_query($db, "SELECT tbl_staff_registry.staff_id, tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
$row = $query->fetch_assoc();
$fullname = $row['first_name'].' '.$row['last_name'];

if ($staff_id == "" || $username == ""){
    echo '<script type="text/javascript">window.location.href="index.php"</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
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
            selectable: true,
            selectHelper: true,
            select: function (start, allDay) {
                var title = '<?php echo $fullname; ?>'
                var staff = '<?php echo $row['staff_id']; ?>'
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD"); 
                    var res;

                    $.ajax({
                        async: false,
                        type: "POST",
                        url: "Staff/schedule/verify-event.php",
                        data: 'start=' + start + '&staff=' + staff,
                        success: function (response) {
                                res = response;
                        }
                        });
                        if (res === 'true') {
                    $.ajax({
                        url: 'Staff/schedule/add-event.php',
                        data: 'title=' + title + '&start=' + start + '&staff=' + staff,
                        type: "POST",
                        success: function (data) {
                            displayMessage("Updated Successfully!");
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                allDay: allDay
                            },
                    true
                            );
                        
                calendar.fullCalendar('unselect');
            }
            
            },
            
            editable: false,
            eventClick: function (event) {

                if(event.id == undefined || event.id == ''){
                    alert("Can not delete the new added schedule, please refresh the Page!");
                }
                else{
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: "Staff/schedule/delete-event.php",
                        data: "&id=" + event.id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Deleted Successfully");
                            }
                        }
                    });
                }
            }
            }

        });
    });

    function displayMessage(message) {
            $(".response").html("<div class='success'>"+message+"</div>");
        setInterval(function() { $(".success").fadeOut(); }, 1000);
    }
    </script>


</head>
<body>
    <main>
        <div class="schedule_admin">
            <div class="calendar_title">
                <h2>Calendar Scheduler</h2>
            </div>
            <p>Click a date to set your schedule. Refresh and click to delete.</p>
            <div class="response"></div>
            <div id='calendar'></div>
        </div>
    </main>

    </div>
</div>

<div class="mobile_header"></div>

</body>
</html>


<style>
    main {
        background: #EFF0F4;
    }
    main .schedule_admin {
        background: #fff;
        padding: 20px;
    }
    main .schedule_admin p {
        font-size: 14px;
        font-family: 'Roboto';
        color: gray;
        margin-top: 12px;
        width: 300px;
    }
    main .schedule_admin .calendar_title {
        display: flex;
        align-items: center;
    }

    main .schedule_admin .calendar_title h2 {
        color: #000;
        font-size: 20px;
        font-family: 'Roboto';
        text-transform: uppercase;
    }
    main .schedule_admin .fc-left h2 {
        color: #333;
        font-size: 16px;
        font-family: 'Roboto';
        transform: translateY(15px);
        font-size: 18px;
        text-transform: uppercase;
    }
    main .schedule_admin .fc-day-header {
        padding: 8px 0;
        font-family: 'Roboto';
        font-size: 14px;
        color: #333;
    }

    main .schedule_admin .fc-day-number {
        font-family: 'Roboto Serif';
        font-size: 20px;
        margin-right: 8px;
    }

    main .schedule_admin .fc-widget-content {
        
        cursor: pointer;
    }
    main .schedule_admin .fc-day-grid-event {
        background: none;
        border: none;;
    }
    main .schedule_admin .fc-content {
        background: #324E9E;
        padding: 2px;
        padding-left: 8px;
        font-family: 'Roboto'
    }
    main .schedule_admin .fc-icon {
        background: none;
    }
    main .schedule_admin .fc-prev-button {
        background: #fff;
        border-radius: 0;
        height: 30px;
    }
    main .schedule_admin .fc-next-button {
        background: #fff;
        border-radius: 0;
        height: 30px;
    }
    main .schedule_admin .fc-today-button {
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

</style>