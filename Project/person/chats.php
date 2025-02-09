<?php
$info = new stdClass();
$arr['userid']="null";
$refresh=false;
$seen= false;
if($DATA_OBJ->data_type=="chats_refresh")
{
    $refresh=true;
    $seen=$DATA_OBJ->seen;
}
if(isset($DATA_OBJ->find->userid))
{$arr['userid']= $DATA_OBJ->find->userid;
  }
  $sql = "SELECT * FROM signup where userid= :userid LIMIT 10";
   
$mydata="";
$messages="";

$result= $DB->read($sql, $arr);
if(is_array($result))
{
    $row=$result[0];
    $image="http://localhost/Project/aicat/2.jpg";
if(!empty($row->image))
{
    $image=$row->image;
}  $row->image=$image;
if(!$refresh)
{ $mydata .= "Now chatting with:<br>
    <div class='contacts-list' id='active_contact' userid=' $row->userid' >
    <img src='$image' alt='Profile' >
    $row->fullName
    </div>";

}
  
    $messages .= "
    
    <div class='active_chat_container' onclick='set_seen(event)'>
        <div class='chat_message_child' id='chat_message_child'>
            " ; 
             $a['sender']=$_SESSION['userid'];
             $a['receiver']=$arr['userid'];
             $sql = "SELECT * FROM messages WHERE (sender = :sender AND receiver = :receiver ) || (receiver = :sender AND sender = :receiver ) LIMIT 10";
            $result2 = $DB->read($sql, $a);
        
            if (is_array($result2)) {
           
            foreach ($result2 as $data) {
               
                $myuser= $DB->get_user($data->sender);
                if($data->receiver==$_SESSION['userid'] && $data->received==1 && $seen )
                {
                 $DB->write("update messages set seen =1 where id ='$data->id' limit 1");
                }
                if($data->receiver==$_SESSION['userid'])
                {
                 $DB->write("update messages set received =1 where id ='$data->id' limit 1");
                }
                if($_SESSION['userid']==$data->sender){
                $messages.= message_left( $data ,$myuser);}
                else{
                    $messages.= message_right( $data ,$myuser);
                }
            }
             }
             if(!$refresh)
{    $messages .=   message_controls();}   



 
    $info->user=$mydata;
    $info->messages=$messages;
    
    if(  $refresh)
    {
        $info->data_type="chats_refresh";
    }
    else{
        $info->data_type="chats";
    }
    echo json_encode($info);
   

}
else
{   $a['userid']=$_SESSION['userid'];
  
    $sql = "SELECT * FROM messages WHERE (sender = :userid OR receiver = :userid ) group by msgid LIMIT 10";
   $result2 = $DB->read($sql, $a);
    $mydata .= "Previous Chats:<br>";
   if (is_array($result2)) {
  
   foreach ($result2 as $data) {
    $other_user=$data->sender;
      if($data->sender==$_SESSION['userid'])
      {
        $other_user=$data->receiver;
      }
       $myuser= $DB->get_user($other_user);
       $image="http://localhost/Project/aicat/2.jpg";
       if(!empty( $myuser->image))
       {
           $image= $myuser->image;
       }   
       $mydata .= "
       
       <div class='contacts-list' id='active_contact' userid=$myuser->userid' onclick='start_chat(event)' style='display: inline-block; margin-right: 20px;  text-align: left; cursor:pointer'>
       <img src='$image' alt='Profile' >
        $myuser->fullName<br>
        <span style='font-size: 14px; padding-left: 10px; text-align:center;'>'$data->message'</span>
       </div>";
   }
    }
    $info->user=$mydata;
    $info->messages="";
    $info->data_type="chats";

    echo json_encode($info);
   
}


  

?>




