<?php
ini_set('session.gc_maxlifetime', 3600);  // 1 hour session timeout
session_set_cookie_params(3600);  // Ensures cookies are kept for the session
session_start();
$info = (object)[];
if (!isset($_SESSION['userid'])) {
    
    if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup") {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}

header("Access-Control-Allow-Origin: *"); // Allow requests from any domain
header("Content-Type: application/json"); // Set JSON content type
header("Access-Control-Allow-Methods: POST"); // Allow only POST requests
require_once("D:/Software/xamp/htdocs/Project/Class/intialize.php");
require_once("D:/Software/xamp/htdocs/Project/person/keys.php");

$DB = new Database();

// Read JSON input
$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

$Error = ""; // Error message

// Check data type and include the necessary PHP file
if (isset($DATA_OBJ->data_type)) {
    switch ($DATA_OBJ->data_type) {
        case "submit":
            include("D:/Software/xamp/htdocs/Project/includes_signup/signup_include.php");
            break;
        case "login":
            include("D:/Software/xamp/htdocs/Project/includes_signup/login_include.php");
            break;
        case "logout":
            include("D:/Software/xamp/htdocs/Project/includes_signup/logout.php");
            break;
        case "user_info":
            include("D:/Software/xamp/htdocs/Project/includes_signup/user_info.php");
            break;
        case "contacts":
            include("D:/Software/xamp/htdocs/Project/person/contacts.php");
            break;
        case "settings":
            include("D:/Software/xamp/htdocs/Project/person/settings.php");
            break;
        case "chats_refresh":
                include("D:/Software/xamp/htdocs/Project/person/chats.php");
                break;
        case "chats":
            include("D:/Software/xamp/htdocs/Project/person/chats.php");
            break;
         
        case "save_settings":
            include("D:/Software/xamp/htdocs/Project/includes_signup/save_setting.php");
            break;
        case "send_message":
            include("D:/Software/xamp/htdocs/Project/includes_signup/send_message.php");
                break;
        case "delete_message":
            include("D:/Software/xamp/htdocs/Project/person/delete_message.php");
                break;
        case "delete_thread":
            include("D:/Software/xamp/htdocs/Project/person/delete_thread.php");
                break;
        
        case "check_email":
            include("D:/Software/xamp/htdocs/Project/person/emailhandle.php");
                break;
        default:
            echo json_encode(["error" => "Invalid data type"]);
            break;
    }
} else {
    echo json_encode(["error" => "Missing data_type"]);
}
function message_left($data, $row) {
    $image = "http://localhost/Project/aicat/2.jpg";
    if (!empty($row->image)) {
        $image = $row->image;
    }  

    // Prepare multiple images
    $imagesHtml = "";
    if (!empty($data->files)) {
        $filesArray = explode(",", $data->files);
        foreach ($filesArray as $file) {
            $imagesHtml .= "<img src='$file' style=' max-width: 100%;
    border-radius: 8px;
    margin-top: 5px;
    display: block;'><br>";
        }
    }
    
    $a = "
    <div class='message_left' id='message_left' userid='$row->userid'>
        <div>";
        if($data->seen){
        
            $a.=" <img src='http://localhost/Project/aicat/verify.png' >";
             }
             elseif($data->received)
             {
            $a.=" <img src='http://localhost/Project/aicat/tick.png' >";
              }
       $a.=" </div>
        <img id='prof_img' src='$image' alt='Profile'>
        <b>$row->fullName</b><br>
        <br>
        ";
        $a.= decrypt_message($data->message);
        $a.="
        <br>
        $imagesHtml
        <span style='font-size: 12px; color: green'>".date("jS M Y H:i:s a", strtotime($data->date))."</span>
        <img id='trash' src='http://localhost/Project/aicat/bin.png' onclick='delete_message(event)' msgid='$data->id'>
    </div><br>";

    return $a;
 
}

function message_right($data, $row)
{   $image = "http://localhost/Project/aicat/2.jpg";
    if (!empty($row->image)) {
        $image = $row->image;
    }  

    // Prepare multiple images
    $imagesHtml = "";
    if (!empty($data->files)) {
        $filesArray = explode(",", $data->files);
        foreach ($filesArray as $file) {
            $imagesHtml .= "<img src='$file' style=' max-width: 100%;
    border-radius: 8px;
    margin-top: 5px;
    display: block;'><br>";
        }
    }
    
    $a = "
    <div class='message_right' id='message_right' userid='$row->userid'>
        <div>";
        if($data->seen){
        
            $a.=" <img src='http://localhost/Project/aicat/verify.png' >";
             }
             elseif($data->received)
             {
            $a.=" <img src='http://localhost/Project/aicat/tick.png' >";
              }
       $a.=" </div>
        <img id='prof_img' src='$image' alt='Profile'>
        <b>$row->fullName</b><br>
        <br>
        ";
        $a.= decrypt_message($data->message);
        $a.="
        <br>
        $imagesHtml
        <span style='font-size: 12px; color: green'>".date("jS M Y H:i:s a", strtotime($data->date))."</span>
        <img id='trash' src='http://localhost/Project/aicat/bin.png' onclick='delete_message(event)' msgid='$data->id'>
    </div><br>";

    return $a;
 
}
function message_controls()
{
    return "
    </div>
        <div  onclick='delete_thread(event)' style='color: black; background-color: white; cursor: pointer;'> Delete this thread</div>
        <!-- Input Bar Stays at Bottom of Active Chat -->
        <div class='chat_input_container'>
        <label for='file'><img src='file.png'></label>
        <input type='file' id='file' onchange='send_image(this.files)'name='file' style='display:none;'>
        <input type='text' id='chat_input' onkeyup='enter_pressed(event)' placeholder='Type your message'>
        <input type='button' id='send_button' value='Send' onclick='send_message(event)'>
        </div>
    </div>";
}
function encrypt_message($message) {
    require_once("D:/Software/xamp/htdocs/Project/person/keys.php"); // Load the key and IV

    global $encryption_key, $iv;
    
    $encrypted = openssl_encrypt($message, 'aes-256-cbc', $encryption_key, 0, $iv);
    return base64_encode($encrypted);
}

function decrypt_message($encrypted_message) {
    require_once("D:/Software/xamp/htdocs/Project/person/keys.php"); // Load the key and IV

    global $encryption_key, $iv;
    
    $encrypted_message = base64_decode($encrypted_message);
    return openssl_decrypt($encrypted_message, 'aes-256-cbc', $encryption_key, 0, $iv);
}

?>
