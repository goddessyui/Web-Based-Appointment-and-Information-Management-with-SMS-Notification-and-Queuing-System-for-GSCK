<?php

$servername = "localhost";

$db_username = "root";

$db_password = "";

$dbname = "db_appointment_system";

// Create connection

$db = mysqli_connect($servername, $db_username, $db_password, $dbname);


// Check connection

if (!$db) {

die("Connection failed: " . mysqli_connect_error());

}

