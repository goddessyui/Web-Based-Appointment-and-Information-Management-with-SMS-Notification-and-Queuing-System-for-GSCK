<?php
 


 

//fetch notification
if(isset($_POST["view"]))
{
 include("dbconfig.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE tbl_notification SET notification_status=1 WHERE notification_status=0 AND id = '".$_POST["id"]."'";
  mysqli_query($db, $update_query);
 }
 $query = "SELECT * FROM tbl_notification WHERE id = '".$_POST["id"]."' ORDER BY notification_id DESC LIMIT 10";
 $result = mysqli_query($db, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li>
    <a href="#">
     <strong>'.$row["notification_subject"].'</strong><br />
     <small><em>'.$row["notification_text"].'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM tbl_notification WHERE notification_status=0 AND id = '".$_POST["id"]."'";
 $result_1 = mysqli_query($db, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>