<?php
header("Content-Type: application/json");
$info = new stdClass();
$myid=$_SESSION['userid'];
$sql = "SELECT * FROM signup where userid!= '$myid'";
$myusers= $DB->read($sql, []);
$mydata = '';
$mydata.='<style>

</style>';
// Ensure $info is defined
if(is_array($myusers)){
   
$mydata.="<div style='font-family: arial;
  font-size: 30px;
  margin-top: 20px;
  margin-bottom: 20px;
  color: black;
  text-align: center;'>Contacts</div>";
foreach ($myusers as $row) { 
    $image="http://localhost/Project/aicat/2.jpg";
if(!empty($row->image))
{
    $image=$row->image;
}  
$mydata .= "

<div class='contacts-list' id='contact_list' userid='$row->userid' onclick='start_chat(event)' ><br>
 
<img src='$image' alt='Profile' style='width: 100px; height: 100px; border-radius: 50%; margin-left: 10px;'>
   <br>$row->fullName
    </div>";}}

// Check if contacts exist
if (!empty($mydata)) {
    $info->message = $mydata;
    $info->data_type = "contacts";
} else {
    $info->message = "No contacts were found";
    $info->data_type = "error";
}

echo json_encode($info);

?>
