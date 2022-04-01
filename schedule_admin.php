<?php
include_once("admin_header.php"); 

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

    <style>
        body {
            margin-top: 50px;
            text-align: center;
            font-size: 20px;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
        }

        #calendar {
            width: 800px;
            margin: 0 auto;
        }

        .response {
            height: 60px;
        }

        .success {
            background: #cdf3cd;
            padding: 10px 60px;
            border: #c3e6c3 1px solid;
            display: inline-block;
        }
    </style>
</head>
<body>
    <main>
        <h2>Calendar Scheduler</h2>
        <div class="response"></div>
        <div id='calendar'></div>
    </main>
</body>


</html>