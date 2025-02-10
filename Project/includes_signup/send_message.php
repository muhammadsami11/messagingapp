<?php
$info = new stdClass();
$arr = array();
$arr['userid'] = "null";
$mydata="";
$messages="";
// $row is defined later in the code
// Set userid from the incoming data if available
if (isset($DATA_OBJ->find->userid)) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}

$sql = "SELECT * FROM signup WHERE userid = :userid LIMIT 10";
$result = $DB->read($sql, $arr);


if (is_array($result)) {
    // Set message, date, sender, and msgid in $arr
    $arr['message'] = isset($DATA_OBJ->find->message) ? $DATA_OBJ->find->message : "";
    $arr['date'] = date("Y-m-d H:i:s");
    $arr['sender'] = $_SESSION['userid'];
    $arr['msgid'] = get_random_string_max(60);

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
        'msgid'    => $arr['msgid']
    );

    // Prepare and execute the insert query
    $query = "INSERT INTO messages(sender, receiver, message, date, msgid) VALUES(:sender, :receiver, :message, :date, :msgid)";
    $DB->write($query, $insertData);

    // Get the contact's data from signup
    $row = $result[0];
    $image = "http://localhost/Project/aicat/2.jpg";
    if (!empty($row->image)) {
        $image = $row->image;
    }
    $row->image = $image;
    
    // Prepare chat header and message container HTML
    $mydata .= "Now chatting with:<br>
    <div class='contacts-list' id='active_contact' userid='$row->userid'>
        <img src='$image' alt='Profile'>
        $row->fullName
    </div>";
    
    $messages .= "
    <div class='active_chat_container'>
        <div class='chat_message_child' id='chat_message_child'>";
        $a['msgid']=$arr['msgid'];
        $sql = "SELECT * FROM messages WHERE msgid = :msgid LIMIT 10";
        $result2 = $DB->read($sql, $a);
       
        if (is_array($result2)) {
       
        foreach ($result2 as $data) {
           
            $myuser= $DB->get_user($data->sender);
            if($_SESSION['userid']==$data->sender){
            $messages.= message_left( $data ,$myuser);}
            else{
                $messages.= message_right( $data ,$myuser);
            }
        }
         }
        $messages .= message_controls();
    
    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = "send_message";
    echo json_encode($info);
} else {
    $info->message = "That contact was not found";
    $info->data_type = "send_message";
    echo json_encode($info);
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
?>
