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
    if($_FILES['file']['error'] == 0){
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
    {   $id=$_SESSION['userid'];
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
       
