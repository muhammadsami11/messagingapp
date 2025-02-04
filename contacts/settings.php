<?php
$mydata=
 'settings go here';
 //$info=$info[0];

 $info->message=$mydata;
 $info->data_type="contacts";
 echo json_encode($info);

 die;
  
$info->message="no contacts were found";
$info->data_type="error";
echo json_encode($info);
?>




