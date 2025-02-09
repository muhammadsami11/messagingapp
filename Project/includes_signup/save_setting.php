<?php
$info=(object)[];


 sleep(1);
 $data = [];
 $data['userid']=$_SESSION['userid'];
 $data['fullName']=$DATA_OBJ->full_name;
 $data['userName']=$DATA_OBJ->username;
 if(empty($DATA_OBJ->username))
 {
     $Error.="username is required.<br>";
 }
 else if(strlen($DATA_OBJ->username)<3)
 {
     $Error.="username must be at least 3 characters.<br>";
 }
 else if(!preg_match("/^[a-zA-Z0-9]*$/",$DATA_OBJ->username))
 {
     $Error.="username is invalid.<br>";
 }
 
 $data['Email']=$DATA_OBJ->email;
 if(empty($DATA_OBJ->email))
 {
    $Error.="email is required.<br>";
 }
 else if(!filter_var($DATA_OBJ->email,FILTER_VALIDATE_EMAIL))
 {
    $Error.="email is invalid.<br>";
 }
 

 $data['Date_birth']=$DATA_OBJ->date;
 $data['password']=$DATA_OBJ->password;
 $password=$DATA_OBJ->confirm_password;
 if(empty($DATA_OBJ->password))
 {
    $Error.="password is required.<br>";
 }
 else if(strlen($DATA_OBJ->password)<5)
 {
    $Error.="password must be at least 5 characters.<br>";
 }
 else if($DATA_OBJ->password!=$password)
 {
    $Error.="passwords do not match.<br>";
 }
 if($Error=="")
 {
 $query="update signup set fullName=:fullName,userName=:userName,Email= :Email,Date_birth=:Date_birth,password=:password where userid=:userid limit 1";
 $result=$DB->write($query,$data);
 if($result)
 {  $info->message="your data was saved";
    $info->data_type="save_settings";
    echo json_encode($info);    
 }
else{
    $info->message="your data was not saved";
    $info->data_type="save_settings";
    echo json_encode($info);   

}  } 
else{

$info->message=$Error;
$info->data_type="save_settings";
echo json_encode($info);
exit();
}
