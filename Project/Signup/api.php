<?php
ini_set('session.gc_maxlifetime', 3600);  // 1 hour session timeout
session_set_cookie_params(3600);  // Ensures cookies are kept for the session
session_start();

if(!isset($_SESSION['userid']))
$info=(object)[];
{   
    if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type!="login")
    {
    $info->logged_in=false;
    echo json_encode($info);
    die;}
}

header("Access-Control-Allow-Origin: *"); // Allow requests from any domain
header("Content-Type: application/json"); // Set JSON content type
header("Access-Control-Allow-Methods: POST"); // Allow only POST requests
require_once("D:/Software/xamp/htdocs/Project/Class/intialize.php");
$DB= new Database();
// Read JSON input
$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ= json_decode($DATA_RAW);
$Error=""; //error message
if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type=="submit")
{ include("D:/Software/xamp/htdocs/Project/includes_signup/signup_include.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type=="login")
{ include("D:/Software/xamp/htdocs/Project/includes_signup/login_include.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type=="logout")
{ include("D:/Software/xamp/htdocs/Project/includes_signup/logout.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type=="user_info")
{ 
    include("D:/Software/xamp/htdocs/Project/includes_signup/user_info.php");
    
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type=="contacts ")
{ 
    include("D:/Software/xamp/htdocs/Project/includes_signup/contacts.php");
    
}
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type=="chats ")
{ 
    include("D:/Software/xamp/htdocs/Project/includes_signup/chats.php");
    
}
}else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type=="settings ")
{ 
    include("D:/Software/xamp/htdocs/Project/includes_signup/settings.php");
    
}

?>
