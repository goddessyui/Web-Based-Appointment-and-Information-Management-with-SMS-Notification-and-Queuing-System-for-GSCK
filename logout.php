<?php
	session_start();
	session_unset();
    session_destroy();
	 echo '<script type="text/javascript">alert("Log Out Successfully!");window.location.href="index.php"</script>';

?>