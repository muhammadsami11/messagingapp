<?php

$info = new stdClass();
$arr['userid'] = "null";
$refresh = false;
$seen = false;

if ($DATA_OBJ->data_type == "chats_refresh") {
    $refresh = true;
    $seen = $DATA_OBJ->find->seen;
}
if (isset($DATA_OBJ->find->userid)) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}

$sql = "SELECT * FROM signup WHERE userid = :userid LIMIT 10";
$mydata = "";
$messages = "";
$myuser = "";

$result = $DB->read($sql, $arr);
if (is_array($result)) {
    $row = $result[0];
    $image = "http://localhost/Project/aicat/2.jpg";
    if (!empty($row->image)) {
        $image = $row->image;
    }
    $row->image = $image;

    if (!$refresh) {
        $mydata .= "<div style='margin-top: 20px;
  margin-right: 20px;
  margin-left: 20px;
  text-align: center;
  margin-bottom: 20px;
  font-size: 40px;'>IN CHAT</div>
        <div class='contacts-list' id='active_contact' userid=' $row->userid' >
        <img src='$image' id='image_of_active' alt='Profile' style=''><br>
        <div style='font-size: 30px;
  background-color: #09b796;
  border: 2px solid transparent;
  border-radius: 10px;
  text-align: center;
  color: white;
  height: auto;
  margin-top: 20px;'>$row->fullName</div>
        </div>";
    }

    $messages .= "
    <div class='active_chat_container' id='active_chat_container' onclick='set_seen(event)'>
        <div class='chat_message_child' id='chat_message_child'>";

    $a['sender'] = $_SESSION['userid'];
    $a['receiver'] = $arr['userid'];
    $sql = "SELECT * FROM messages 
            WHERE (sender = :sender AND receiver = :receiver AND deleted_sender = 0) 
               OR (receiver = :sender AND sender = :receiver AND deleted_receiver = 0) 
            ORDER BY id ASC LIMIT 50";

    $result2 = $DB->read($sql, $a);

    if (is_array($result2)) {
        foreach ($result2 as $data) {
            $myuser = $DB->get_user($data->sender);
            if (!$myuser) continue; // Ensure user exists

            if ($data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen) {
                $DB->write("UPDATE messages SET seen = 1 WHERE id = '$data->id' LIMIT 1");
            }
            if ($data->receiver == $_SESSION['userid']) {
                $DB->write("UPDATE messages SET received = 1 WHERE id = '$data->id' LIMIT 1");
            }
            if ($_SESSION['userid'] == $data->sender) {
                $messages .= message_left($data, $myuser);
            } else {
                $messages .= message_right($data, $myuser);
            }
        }
    }

    if ($refresh) {
        $messages .= message_controls();
    }

    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = $refresh ? "chats_refresh" : "chats";
    echo json_encode($info);
} else {
    $a['userid'] = $_SESSION['userid'];

    $sql = "SELECT m1.* 
    FROM messages m1
    INNER JOIN (
        SELECT msgid, MAX(id) as last_msg_id
        FROM messages
        WHERE sender = :userid OR receiver = :userid
        GROUP BY msgid
    ) m2 ON m1.id = m2.last_msg_id
    ORDER BY m1.id DESC";


$result2 = $DB->read($sql, $a);

    $mydata .= "Previous Chats:<br>";

    if (is_array($result2)) {
        foreach ($result2 as $data) {
            $other_user = ($data->sender == $_SESSION['userid']) ? $data->receiver : $data->sender;
            if (empty($other_user)) continue;

            $myuser = $DB->get_user($other_user);
            if (!$myuser) continue;

            $image = !empty($myuser->image) ? $myuser->image : "http://localhost/Project/aicat/2.jpg";
            $data->message = decrypt_message($data->message);
            $mydata .= "
            <div class='contacts-list' id='active_contact' userid='$myuser->userid' 
            onclick='start_chat(event)' style='display: inline-block; margin-right: 20px; text-align: left; cursor:pointer'>
                <img src='$image' style=' width: 80px;
  height: 80px;
  margin-right: 20px;
  margin-left: 15px;
  margin-top: 20px;'alt='Profile'><br>
               <div style='font-size: 25px;
  background-color: #09b796;
  border: 2px solid transparent;
  border-radius: 10px;
  text-align: center;
  color: white;
  height: 30px;
  margin-top: 20px;'> $myuser->fullName</div>
                <div style='font-size: 18px;
  text-align: left;
  background-color: #01242412;
  margin-top: 5px;
  border: 2px solid transparent;
  height: 30px;'>$data->message</div>
            </div>";
        }
    }
    $info->user = $mydata;
    $info->messages = "";
    $info->data_type = "chats";

    echo json_encode($info);
}

?>
