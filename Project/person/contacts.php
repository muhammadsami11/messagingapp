<?php
header("Content-Type: application/json");
$info = new stdClass();
$myid=$_SESSION['userid'];
$sql = "SELECT * FROM signup where userid!= '$myid' LIMIT 10";
$myusers= $DB->read($sql, []);
$mydata = '';
$mydata.='<style>
    /* ✅ Fix: Properly closing @keyframes */
    @keyframes appear {
        0% { opacity: 0; transform: translateY(50px); }
        100% { opacity: 1; transform: translateY(0px); }
    }

    /* ✅ Fix: Move hover styles outside of @keyframes */
    .contacts-list {
        display: inline-block;
        margin-right: 20px;
        opacity: 0; /* Start hidden */
        cursor: pointer;
        animation: appear 0.5s ease-in-out forwards; /* ✅ Fix animation */
        text-align: left;
    }

    /* ✅ Fix: Hover effect properly applied */
    .contacts-list:hover {
      transform: scale(1.8);
        
        transition: all 0.5s cubic-bezier(.78,.11,.42,.85);
      
    }
</style>';
// Ensure $info is defined
if(is_array($myusers)){
   

foreach ($myusers as $row) { 
    $image="http://localhost/Project/aicat/2.jpg";
if(!empty($row->image))
{
    $image=$row->image;
}  
$mydata .= "

<div class='contacts-list' userid='$row->userid' onclick='start_chat(event)' style='display: inline-block; margin-right: 20px;  text-align: left;'>
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
