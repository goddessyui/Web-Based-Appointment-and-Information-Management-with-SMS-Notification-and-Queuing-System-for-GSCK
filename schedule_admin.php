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
