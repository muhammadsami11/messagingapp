<?php
$mydata=
 '<div class="chat-list">

        <div class="chat-list-header">
            <h1>Chats</h1>
            <img src="search.png">
            <input type="text" placeholder="Search here">
        </div>
        <!-- Chat Items with Time -->
        <label class="chat-item" for="chat1">
            <img src="5.jpg" alt="Profile">
            <div class="chat-item-content">
                <strong>Favour Nwaeze</strong>
                <p>Hello Ken, Hope you are doing </p>
            </div>
            <div class="chat-item-time">12:45 PM</div>
        </label>

        <label class="chat-item" for="chat2">
            <img src="3.jpg" alt="Profile">
            <div class="chat-item-content">
                <strong>ariana Doe</strong>
                <p>What's the update on our project?</p>
            </div>
            <div class="chat-item-time">1:30 PM</div>
        </label>


        <label class="chat-item" for="chat3">
            <img src="2.jpg" alt="Profile">
            <div class="chat-item-content">
                <strong>Jane Smith</strong>
                <p>Don't forget our meeting at 3 PM!</p>
            </div>
            <div class="chat-item-time">2:15 PM</div>

        </label>
        <label class="chat-item" for="chat4">
            <img src="th.jpg" alt="Profile">
            <div class="chat-item-content">
                <strong>Chris Johnson</strong>
                <p>Can you review my latest draft?</p>
            </div>
            <div class="chat-item-time">4:00 PM</div>
        </label>

        <label class="chat-item" for="chat5">
            <img src="1.jpg" alt="Profile">
            <div class="chat-item-content">
                <strong>Emily Davis</strong>
                <p>Lunch plans?</p>
            </div>
            <div class="chat-item-time">5:45 PM</div>
        </label>
    </div>
';
 //$info=$info[0];

 $info->message=$mydata;
 $info->data_type="contacts";
 echo json_encode($info);

 die;
  
$info->message="no contacts were found";
$info->data_type="error";
echo json_encode($info);
?>




