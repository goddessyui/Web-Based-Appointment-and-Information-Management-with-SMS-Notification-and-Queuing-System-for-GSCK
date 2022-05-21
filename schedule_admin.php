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

    


    <main>
        <div class="schedule_admin">
            <div class="calendar_title">
                <h3>Calendar Scheduler
                <span>
                <?php
                    date_default_timezone_set('Asia/Manila');
                    echo date('F j, Y');
                ?>
                </span>
                </h3>
                <p>Click a date to set your schedule. Refresh and click to delete.</p>
            </div>

            <div class="response"></div>
            <div id="calendar"></div>
        </div>
    </main>

    </div>
</div>

<div class="mobile_header"></div>

</body>
</html>

<style>
    .schedule_admin {
        padding: 15px;
    }
    .schedule_admin .calendar_title {
        background: #fff;
        padding: 30px;
    }
    .calendar_title h3 {
        font-size: 16px;
        margin-bottom: 12px;
    }
    .calendar_title span {
        font-weight: 500;
        margin-left: 20px;
    }
    #calendar {
        background: #fff;
        padding: 30px;
        margin-top: 15px;
        padding-top: 20px;
    }
    #calendar h2 {
        display: none;
    }
    #calendar .fc-day-header {
        padding: 15px 0;
        color: #333;
        font-weight: 500;
    }
    #calendar .fc-today-button {
        background: #FE4961;
        opacity: 1;
        text-shadow: none;
        width: 120px;
        text-transform: uppercase;
        color: #eee;
        border: none;
        height: 28px;
        font-size: 14px;
        border-radius: 15px;
   }
   #calendar .fc-today-button:hover {
       background: #FF6276;
   }
    #calendar .fc-prev-button {
        background: #fff;
        border: 1px solid lightgrey;
        border-left: .5px solid lightgrey;
        height: 28px;
        padding-bottom: 2px;
        margin-right: 10px;
    }
    #calendar .fc-next-button {
        background: #fff;
        border: 1px solid lightgrey;
        border-left: .5px solid lightgrey;
        height: 28px;
        box-shadow: none;
        padding-bottom: 2px;
    }
  

    .fc-icon {
        text-shadow: none;
    }
    .fc-button-group {
        box-shadow: none;
        border: none;
    }
    .fc-day-number {
        font-size: 16px;
        margin-right: 5px;
        font-family: 'Roboto';
    }
 
    .fc-content {
        padding: 2px;
        padding-left: 5px;
    }
    .fc-event {
        background: #6BB4E4;
        border-radius: 0;
        border: none;
    }
</style>

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
                } 
                else {
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

                if(event.id == undefined || event.id == '') {
                    alert("Cannot delete the newly added schedule. Please refresh the Page!");
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



