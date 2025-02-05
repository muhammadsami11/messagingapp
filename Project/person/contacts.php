<?php
header("Content-Type: application/json");
$info = new stdClass();
$sql = "SELECT * FROM signup LIMIT 10";
$myusers= $DB->read($sql, []);
$mydata = '';
// Ensure $info is defined
if(is_array($myusers)){
   

foreach ($myusers as $row) { 
    $image="http://localhost/Project/aicat/2.jpg";
if(!empty($row->image))
{
    $image=$row->image;
}  
$mydata .= "
<div class='contacts-list' style='display: inline-block; margin-right: 20px; text-align: left;'>
<img src='$image' alt='Profile' style='width: 100px; height: 100px; border-radius: 50%;'>
    <br>  $row->fullName
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
