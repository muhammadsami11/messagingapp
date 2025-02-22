<?php

$info = new stdClass();
$arr['rowid']="null";

$seen= false;

if(isset($DATA_OBJ->find->rowid))
{$arr['rowid']= $DATA_OBJ->find->rowid;
  }
  $sql = "SELECT * FROM messages where id= :rowid";
$result= $DB->read($sql, $arr);
$row=$result[0];
if(is_array($result))
{
    if($_SESSION['userid']==$row->sender )
    {
        $sql = "UPDATE messages set deleted_sender=1 where id='$row->id'";
        $result= $DB->write($sql);

    }
    elseif($_SESSION['userid']==$row->receiver )
    {
        $sql = "UPDATE messages set deleted_receiver=1 where id='$row->id'";
        $result= $DB->write($sql);
    }
}


  

?>




