<?php

$student_id = !empty($_SESSION["student_id"])?$_SESSION["student_id"]:'';
$student_username = !empty($_SESSION["student_username"])?$_SESSION["student_username"]:'';
$staff_id = !empty($_SESSION["staff_id"])?$_SESSION["staff_id"]:'';
$position = !empty($_SESSION["position"])?$_SESSION["position"]:'';
$staff_username = !empty($_SESSION["staff_username"])?$_SESSION["staff_username"]:'';
?>

<?php 
include('header.php');
?>
<div class="parent-div">
<h3>THIS IS THE INDEX</h3>
<h4>Test: Show student name if session active: <?php echo $student_username;?></h4>
</div>



</body>

</html>
<style>
    .parent-div{
        padding-top: 150px;
        margin-left: 15%;
        margin-right: 15%;
    }
</style>