<?php
$info=(object)[];

 $data = [];
 $data['Email']=$DATA_OBJ->email;
 $data['password']=$DATA_OBJ->password;
 if($Error=="")
 {
    
   $query= "SELECT * FROM signup WHERE Email = :Email AND password = :password LIMIT 1";
echo $query;
 $result=$DB->read($query,$data);
 if(is_array($result))
 {  $result=$result[0];
    if($result->password==$DATA_OBJ->password)
    {  ob_end_clean(); // Clear any unwanted output before sending JSON
        $_SESSION['userid']=$result->userid;
        $info->message="You are successfully logged in";
    $info->data_type="info";
   
 
    echo json_encode($info);
    } else {
    $info->message="Wrong Password";
    $info->data_type="error";
    echo json_encode($info); 
      
    }}
    else{
    $info->message="wrong email";
    $info->data_type="error";
    echo json_encode($info);   

}  } 
else{

$info->message=$Error;
$info->data_type="error";
echo json_encode($info);
exit();
}

