<?php

$info = new stdClass();
$arr['userid']="null";

$seen= false;

if(isset($DATA_OBJ->find->userid))
{$arr['userid']= $DATA_OBJ->find->userid;
  }
  $arr['sender']=$_SESSION['userid'];
  $arr['receiver']=$arr['userid'];
  $sql = "SELECT * FROM messages WHERE (sender = :sender AND receiver = :receiver ) || (receiver = :sender AND sender = :receiver)";
$result= $DB->read($sql, $arr);

if(is_array($result))
{   foreach ($result as $row) {
    # code...

    if($_SESSION['userid']==$row->sender )
    {
        $sql = "UPDATE messages set deleted_sender=1 where id='$row->id'";
        $result= $DB->write($sql);

    }
    elseif($_SESSION['userid']==$row->receiver )
    {
        $sql = "UPDATE messages set deleted_receiver=1 where id='$row->id'";
        $result= $DB->write($sql);
    }}
}


  

?>




