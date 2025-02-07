<?php
$info = new stdClass();
$mydata=
 'chats go here';
 //$info=$info[0];

 $info->message=$mydata;
 $info->data_type="chats";
 echo json_encode($info);

 die;
  
$info->message="chats were not found";
$info->data_type="error";
echo json_encode($info);
?>




