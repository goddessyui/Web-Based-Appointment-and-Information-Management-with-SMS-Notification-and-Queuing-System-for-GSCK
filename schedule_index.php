<?php
 date_default_timezone_set("Asia/Manila");
 $date = date("Y-m-d");
include 'Calendar.php';
$calendar = new Calendar($date);
$calendar->add_event('Birthday', $date, 1, 'green');
$calendar->add_event('Doctors', $date, 1, 'red');
$calendar->add_event('Holiday', $date, 1);
include_once("dbconfig.php"); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Event Calendar</title>
		<link href="css/calendar.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
                $sql = "SELECT
                tbl_schedule.staff_id,
                tbl_schedule.date,
                tbl_schedule.title
                FROM
                tbl_schedule
                WHERE `date` >= DATE(NOW())";

                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...
                        
                        $calendar->add_event($row['title'], $row['date'], 1, 'green');
                     
                    }
                }

                ?>



	    <nav class="navtop">
	    	<div>
	    		<h1>Staff Schedules</h1>
	    	</div>
	    </nav>
		<div class="content home">
			<?=$calendar?>
		</div>
	</body>
</html>