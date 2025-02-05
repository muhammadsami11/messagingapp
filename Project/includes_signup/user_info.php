<?php


$info=(object)[];
// Check if session is set properly
if (!isset($_SESSION['userid']) || empty($_SESSION['userid'])) {
  $info->message = "User not logged in";
  $info->data_type = "error";
  echo json_encode($info);
  exit();
}

 $data = [];
 $data['userid']=$_SESSION['userid'];

 if($Error=="")
 {
    
   $query= "SELECT * FROM signup WHERE userid = :userid LIMIT 1";
 
 $result=$DB->read($query,$data);
 if(is_array($result))
 {  // Clear any unwanted output before sending JSON
    $result=$result[0];
    $result->data_type="user_info";
    echo json_encode($result);}
    else{
    $info->message="wrong id";
    $info->data_type="error";
    echo json_encode($info);   

}  } 
else{

$info->message=$Error;
$info->data_type="error";
echo json_encode($info);
exit();
}

