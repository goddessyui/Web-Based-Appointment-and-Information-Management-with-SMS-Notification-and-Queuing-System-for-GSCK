<?php



$db = mysqli_connect("localhost", "admin", "admin", "db_appointment_system");

if($db == ""){
	echo '<script type="text/javascript">alert("Check database connection");window.location.href="404.html";</script>';
}




//class Config {
    // ------------------------------------------------------------------------
    // DATABASE SETTINGS
    // ------------------------------------------------------------------------

   //const DB_HOST       = 'localhost';
  //const DB_NAME       = 'appointment';
   // const DB_USERNAME   = 'admin';
    //const DB_PASSWORD   = 'admin';

    // ------------------------------------------------------------------------
    // GOOGLE CALENDAR SYNC
    // ------------------------------------------------------------------------

   //const GOOGLE_SYNC_FEATURE   = FALSE; // Enter TRUE or FALSE
   //const GOOGLE_PRODUCT_NAME   = '';
   //const GOOGLE_CLIENT_ID      = '';
   //const GOOGLE_CLIENT_SECRET  = '';
   //const GOOGLE_API_KEY        = '';

?>