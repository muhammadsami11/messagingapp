<?php
session_start();
require_once("D:/Software/xamp/htdocs/Project/Class/intialize.php");
$DB = new Database();
$info = (object)[];
$data_type="";
    if(isset($_POST['data_type'])){
        $data_type = $_POST['data_type'];
    }
if (!isset($_SESSION['userid'])) {
    
    if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup") {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}
$destination="";
if(isset($_FILES['file']) && $_FILES['file']['name'] != ""){
    
    if($_FILES['file']['error'] == 0 ){
        $folder="uploads/";
        if(!file_exists($folder)){
            mkdir($folder, 0777, true);
        }
        $destination = $folder.basename($_FILES['file']['name']);
        if(move_uploaded_file($_FILES['file']['tmp_name'], $destination)){
            $info->message="your image was uploaded";
            $info->data_type=$data_type;
            echo json_encode($info);
        }
        else{
            $info->message="your image was not uploaded";
            $info->data_type=$data_type;
            echo json_encode($info);
        }  
    
    
    }}

    
    if($data_type=="change_profile_image")

    {if($destination!="")
    {   
        $id=$_SESSION['userid'];
        $query="update signup set image= '$destination' where userid='$id' limit 1";
        $result=$DB->write($query,[]);
        if($result)
        {
            $info->message="your image was saved";
            $info->data_type="change_profile_image";
            echo json_encode($info);    
        }
        else{
            $info->message="your image was not saved";
            $info->data_type="change_profile_image";
            echo json_encode($info);
        }
    }
    else{
        $info->message="your image was not saved";
        $info->data_type="change_profile_image";
        echo json_encode($info);
    }

}
elseif($data_type=="send_image")
{   $arr['userid'] = "null";
    
   if (isset($_POST['userid'])) {
    $arr['userid'] = addslashes($_POST['userid']);
}

    
    
        // Set message, date, sender, and msgid in $arr
        $arr['message'] = isset($DATA_OBJ->find->message) ? $DATA_OBJ->find->message : "";
        $arr['date'] = date("Y-m-d H:i:s");
        $arr['sender'] = $_SESSION['userid'];
        $arr['msgid'] = get_random_string_max(60);
        $arr['file'] = $destination;
        // Create a separate array for the SELECT query on messages
        $arr2 = array();
        $arr2['sender'] = $_SESSION['userid'];
        $arr2['receiver'] = $arr['userid'];
    
        // Fix the SELECT query (note: spelling corrected and use AND instead of &&)
        $sql = "SELECT * FROM messages WHERE (sender = :sender AND receiver = :receiver ) || (receiver = :sender AND sender = :receiver ) LIMIT 1";
        $result2 = $DB->read($sql, $arr2);
        if (is_array($result2)) {
            $arr['msgid'] = $result2[0]->msgid;
        }
    
        // Create a new array that only contains the keys required for the insert query
        $insertData = array(
            'sender'   => $arr['sender'],
            'receiver' => $arr['userid'], // Set receiver to the userid from $arr
            'message'  => $arr['message'],
            'date'     => $arr['date'],
            'msgid'    => $arr['msgid'],
            'files'    => $arr['file']
        );
    
        // Prepare and execute the insert query
        $query = "INSERT INTO messages(sender, receiver, message, date, msgid, files) VALUES(:sender, :receiver, :message, :date, :msgid, :files)";
        $DB->write($query, $insertData);

}
function get_random_string_max($length) {
    $array = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
    $text = "";
    $length = rand(4, $length);
    for ($i = 0; $i < $length; $i++) {
        $random = rand(0, count($array) - 1);
        $text .= $array[$random];
    }
    return $text;
}
       
