<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three-Section Chat UI with Timestamps</title>
    <link rel="stylesheet" href="aicat.css">
    <style>
        /* Flexbox container for sections */
      /* General Styles */
body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f0f2f5;
    color: #333;
    display: flex;
    height: 100vh;
    overflow: hidden;
}

/* Flexbox container for sections */
.chat-container {
    display: flex;
    width: 90%;
    height: 100vh;
    transition: 0.3s ease;
}

/* Sections (Chat List, Contacts, Settings) */
.chat-list, .contacts-section, .settings-section {
    background: #f8f9fa;
    padding: 20px;
    display: none; /* All hidden initially */
    transition: 0.3s ease;
}

/* Show active section */
.active {
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    border: 2px solid transparent;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 147, 233, 0.5);
    margin-top: 10px;
  margin-left: 10px;
  margin-bottom: 10px;
}

/* Ensure chat-list is visible by default */
.chat-list {
    display: flex;
    width: 90%;
    margin-top: 10px;
  margin-bottom: 10px;
  margin-right: 10px;
  border-radius: 15px;
  font-family: arial;
  font-size: 30px
}
#image_of_active{
    width: 150px;
  height: 150px;
  border-radius: 50%;
  margin-right: 40px;
  margin-left: 60px;
  margin-top: 30px;
}

.settings-section {
    width: 40%;
}

/* Sidebar Styles */
.sidebar {
    width: 8%;
    background: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border: 2px solid transparent;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 147, 233, 0.5);
    margin: 10px;
}
.sidebar-logo-image img{
    width: 70px;
    height: 70px;
}
.sidebar-logo img {
    width: 50px;
    height: 50px;
    margin-left: 9px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.sidebar-logo img:hover {
    transform: scale(1.1);
}

#label_setting img {
    width: 50px;
    height: 50px;
    cursor: pointer;
    margin-bottom: 50px;
    margin-left: 9px;
}

.logout button {
    background: black;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    margin-top: 250px;
    width: 80px;
    border-radius: 20px;
    font-family: Arial, sans-serif;
    font-size: 20px;
    height: 50px;
    text-align: center;
    transition: background-color 0.3s ease;
}

.logout button:hover {
    background-color: #333;
}

/* User Info Section */
#user_info {
    width: 12%;
    background: linear-gradient(90deg, #0093E9, #80D0C7);
    color: white;
    text-align: center;
    font-family: Arial, sans-serif;
    font-size: 18px;
    border: 2px solid transparent;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 147, 233, 0.5);
    margin: 10px;
}

#user_info img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}

/* Chat Messages */
#chatmessage {
    display: flex;
    flex-direction: column;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 147, 233, 0.5);
    padding: 20px;
    margin-top: 10px;
    margin-bottom: 10px;
    flex: 1;
    overflow: hidden; /* Prevent nested scrollbars */
    
}

#chat_message_child {
    display: flex;
    flex-direction: column;
    overflow-y: auto; /* Only this container will scroll */
    padding: 10px;
    height: calc(100vh - 200px); /* Fixed height */
    max-height: 100%; /* Ensure it doesn't exceed parent height */
    
    min-height:0px;
}

        #message_left, #message_right {
            max-width: 70%;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
            position: relative;
        }

        #message_left {
            background-color: #e1ffc7;
            align-self: flex-start;
        }

        #message_right {
            background-color: #f1f1f1;
            align-self: flex-end;
        }

        #message_left #prof_img, #message_right #prof_img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Trash and Icons in Messages */
        #message_left #trash, #message_right #trash {
            width: 20px;
            height: 20px;
            cursor: pointer;
            position: absolute;
            bottom: 5px;
            right: 5px;
        }

        #message_left div img, #message_right div img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin: 0;
        }

        #message_left div, #message_right div {
            width: 20px;
            height: 20px;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        /* Chat Input Container */
        .chat_input_container {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #fff;
            border-top: 1px solid #ccc;
            position: sticky;
            bottom: 0;
        }

        .chat_input_container input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .chat_input_container input[type="button"] {
            padding: 10px 20px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* File Upload Button */
        .chat_input_container label {
            cursor: pointer;
            margin-right: 10px;
        }

        .chat_input_container label img {
            width: 30px;
            height: 30px;
        }
       


@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Chat Input Container */
.chat_input_container {
    display: flex;
    align-items: center;
    padding: 10px;
    background: #fff;
    border-top: 1px solid #ccc;
    position: sticky;
    bottom: 0;
}

.chat_input_container input[type="text"] {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
    font-size: 16px;
}

.chat_input_container input[type="button"] {
    padding: 10px 20px;
    background: #2c3e50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.chat_input_container label {
    cursor: pointer;
    margin-right: 10px;
}

.chat_input_container label img {
    width: 30px;
    height: 30px;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .sidebar {
        width: 60px;
    }

    .sidebar-logo img {
        width: 40px;
        height: 40px;
    }

    #label_setting img {
        width: 40px;
        height: 40px;
    }

    .logout button {
        width: 70px;
        font-size: 16px;
    }

    #user_info {
        width: 25%;
    }
}

@media (max-width: 480px) {
    .sidebar {
        width: 50px;
    }

    .sidebar-logo img {
        width: 30px;
        height: 30px;
    }

    #label_setting img {
        width: 30px;
        height: 30px;
    }

    .logout button {
        width: 60px;
        font-size: 14px;
    }

    #user_info {
        width: 30%;
    }
}

    </style>
</head>

<body>

    <!-- Sidebar Section -->
    <div class="sidebar">
        <div class='leftsidebar'>
            <div class="sidebar-logo-image">
                <img src="6.png" alt="Logo" id="logo">
            </div>
            <div class="sidebar-logo">
                <label id="label_contacts"> <img src="contact.png" alt="Contacts"></label>
            </div>
            <div class="sidebar-logo">
                <label id="label_message"><img src="8.png" alt="Chats"></label>
            </div>
            <div class="sidebar-logo">
                <label id="label_weather"><a href="http://localhost/Project/Weather/weather.php"><img src="weather.png" alt="weather"></a></label>
            </div>
            <div class="sidebar-logo">
                <label id="label_planning"><a href="http://localhost/Project/aicat/planning.php"><img src="task.png" alt="plan"></a></label>
            </div>
            <div class="sidebar-logo">
                <label id="label_expense"><a href="http://localhost/Project/aicat/expense.php"><img src="expenses.png" alt="Expense"></a></label>
            </div>
            <div class="sidebar-setting">
                <label id="label_setting"> <img src="7.png" alt="Settings"></label>
            </div>
        </div>  
        </div>
      
    

    <!-- Chat Container (Flexbox Layout) -->
  
        <!-- Chat List Section -->
        <div class="chat-list active" id="chat-list">
            <div class="chat-list-header">
                <h1>Chats</h1>
               <!-- <img src="search.png">
                <input type="text" placeholder="Search here"> -->
            </div>
        </div>
    <div class="chatmessage" id="chatmessage" ></div>
        <!-- Contacts Section (Initially Hidden) -->
        <div class="contacts-section" id="contacts-section">
        <div style='font-family: arial;
  font-size: 30px;
  margin-top: 20px;
  margin-bottom: 20px;
  color: black;
  text-align: center;'>Contacts</div>
          
        </div>

        <!-- Settings Section (Initially Hidden) -->
        <div class="settings-section" id="settings-section">
            <h2>Settings</h2>
            <p>Settings will be displayed here.</p>
        </div>
  

    <div id="user_info">
        <h2>Profile</h2>
        <img id="profile_image" src="5.jpg" width=100px; height= 80px; alt="Profile">
        <div id="information">
            <div id="username">Username</div>
            <div id="email">Email</div>
        </div>
        <div class="logout">
            <button type="button" id="logout">Logout</button>
        </div>
    </div>

    <script>
   
    var CURRENT_USER_ID = "";
    var SEEN_STATUS = false;

    // Function to restore scroll position
    function restoreScroll() {
        var chatMessageChild = _("chat_message_child");
        if (chatMessageChild) {
            var savedScrollPosition = sessionStorage.getItem("chat_scroll");
            if (savedScrollPosition) {
                // Restore the scroll position
                chatMessageChild.scrollTop = parseInt(savedScrollPosition, 10);
                console.log("Scroll position restored:", chatMessageChild.scrollTop);
            }
        }
    }

    // Function to save scroll position
    function saveScrollPosition() {
        var chatMessageChild = _("chat_message_child");
        if (chatMessageChild) {
            sessionStorage.setItem("chat_scroll", chatMessageChild.scrollTop);
            console.log("Scroll position saved:", chatMessageChild.scrollTop);
        }
    }

    function handle_result(result, type) {
        console.log(result);
        try {
            if (!result.trim()) {
                throw new Error("Empty response from server");
            }
            var chatmessage = _("chatmessage");
            chatmessage.style.overflow = "visible";
            var obj = JSON.parse(result);

            if (obj.logged_in === false) {
                setTimeout(() => {
                    window.location.href = "http://localhost/Project/loginpage/login.php";
                }, 2000);
            } else {
                switch (type) {
                    case "user_info":
                        _("username").innerText = obj.userName || "No username found";
                        _("email").innerText = obj.Email || "No email found";
                        _("profile_image").src = obj.image;
                        break;

                    case "chats_refresh":
                        SEEN_STATUS = false;
                        var active_chat_container = _("active_chat_container");
                        active_chat_container.innerHTML = obj.messages;

                       
                        break;

                    case "contacts":
                        var contactsList = _("contacts-section");
                        contactsList.innerHTML = obj.message;
                        chatmessage.style.overflow = "hidden";
                        break;

                    case "chats":
                        SEEN_STATUS = false;
                        var chatList = _("chat-list");
                        var chat_message = _("chatmessage");
                        chatList.innerHTML = obj.user;
                        chat_message.innerHTML = obj.messages;
                        var chat_message_child= _("chat_message_child");
                        chat_message_child.scrollTo(0,chat_message_child.scrollHeight);
                        break;

                    case "settings":
                        var settingsSection = _("settings-section");
                        settingsSection.innerHTML = obj.message;
                        break;

                    case "save_settings":
                        send_data({}, "user_info");
                        break;

                    case "send_message":
                        var chatList = _("chat-list");
                        var chat_message = _("chatmessage");
                        chatList.innerHTML = obj.user;
                        chat_message.innerHTML = obj.messages;
                        break;

                    default:
                        console.log("Unknown data type");
                        break;
                }
            }
        } catch (e) {
            console.error("JSON Parsing Error:", e);
        }
    }

    function get_data(find, type) {
        var xml = new XMLHttpRequest();
        xml.onload = function () {
            if (xml.readyState == 4 && xml.status == 200) {
                handle_result(xml.responseText, type);
            }
        };
        var data = { find: find, data_type: type };
        xml.open("POST", "http://localhost/Project/Signup/api.php", true);
        xml.setRequestHeader("Content-Type", "application/json");
        xml.send(JSON.stringify(data));
    }

    function _(element) {
        return document.getElementById(element);
    }

    document.addEventListener("DOMContentLoaded", function () {
        var logoutButton = _("logout");
        var contactsButton = _("label_contacts");
        var messagesButton = _("label_message");
        var settingsButton = _("label_setting");

        var contactsSection = _("contacts-section");
        var chatList = _("chat-list");
        var settingsSection = _("settings-section");

        // Function to show only one section at a time
        function showSection(section) {
            chatList.classList.remove("active");
            contactsSection.classList.remove("active");
            settingsSection.classList.remove("active");

            section.classList.add("active");
        }

        if (logoutButton) logoutButton.addEventListener("click", logout_user);
        if (contactsButton) {
            contactsButton.addEventListener("click", function () {
                showSection(contactsSection);
                get_contacts();
            });
        }
        if (messagesButton) {
            messagesButton.addEventListener("click", function () {
                showSection(chatList);
                get_chats();
            });
        }
        if (settingsButton) {
            settingsButton.addEventListener("click", function () {
                showSection(settingsSection);
                get_settings();
            });
        }

        function logout_user() {
            get_data({}, "logout");
        }

        function get_contacts() {
            get_data({}, "contacts");
        }

        function get_chats() {
            get_data({}, "chats");
        }

        function get_settings() {
            get_data({}, "settings");
        }

        function send_message(event) {
            var chat_input = _("chat_input");
            alert(chat_input.value);
        }

        get_data({}, "user_info");

        // Save scroll position before refresh
        var chatMessageChild = _("chat_message_child");
        if (chatMessageChild) {
            chatMessageChild.addEventListener("scroll", function () {
                saveScrollPosition();
            });
        }

        // Restore scroll position on page load
        restoreScroll();

        // Refresh chat messages every 5 seconds
        setInterval(function () {
            if (CURRENT_USER_ID !== "") {
                get_data({ userid: CURRENT_USER_ID, seen: SEEN_STATUS }, "chats_refresh");
            }
        }, 5000); // Refresh every 5 seconds
    });

</script>

    
<script>
    


  function collect_data() {
    var save_settings_button = _("save_settings");
    save_settings_button .disabled = true;
    save_settings_button .innerText = "Please wait...";
        var myform = _("settingsForm");
        var inputs = myform.getElementsByTagName("input");
        var data = {};

        for (var i = 0; i < inputs.length; i++) {
            var key = inputs[i].name;
            var value = inputs[i].value;

            switch (key) {
                case "full_name":
                    data.full_name = value;
                    break;
                case "username":
                    data.username = value;
                    break;
                case "email":
                    data.email = value;
                    break;
                case "date":
                    data.date = value;
                    break;
                case "password":
                    data.password = value;
                    break;
                case "confirm_password":
                    data.confirm_password = value;
                    break;
                default:
                    break;
            }
        }

        send_data(data, "save_settings");
      
    }

    function send_data(data, type) {
        data.data_type = type;
        var data_string = JSON.stringify(data);
        var xml = new XMLHttpRequest();
        xml.open("POST", "http://localhost/Project/Signup/api.php", true);
        xml.setRequestHeader("Content-Type", "application/json");

        xml.onload = function () {
            if (xml.readyState == 4 && xml.status == 200) {
                handle_result(xml.responseText,type);
                var save_settings_button = _("save_settings");
            }
           
        };

        xml.send(data_string);
    }
    function upload_profile_image(files){
    var change_image_button=_("change_image_button");
    change_image_button.disabled=false;
    change_image_button.innerHTML="Change Profile Picture";
    var myform= new FormData();
    var xml = new XMLHttpRequest();
                xml.onload = function () {
                    if (xml.readyState == 4 && xml.status == 200) {
                     
                    
                    send_data({}, "user_info");
                    
                       var change_image_button=_("change_image_button");
                    change_image_button.disabled=true;
                    change_image_button.innerHTML="Upload Profile Picture";
                    }
                };
                myform.append('file', files[0]);
                myform.append('data_type', "change_profile_image");
                xml.open("POST", "http://localhost/Project/aicat/uploader.php", true);
                xml.send(myform);
    }
    function handle_drag_and_drop(e)
    {
        if(e.type=="dragover")
        {
            e.preventDefault();
            e.target.className="dragging";
        }
        else if(e.type=="dragleave")
        {   e.preventDefault();
            e.target.className="";
            upload_profile_image(e.dataTransfer.files);
        }
        else if(e.type=="drop")
        {
            e.preventDefault();
            e.target.className="";
        }
        
    }
    function start_chat(e) {
    var userid = e.target.getAttribute("userid") || e.target.parentNode.getAttribute("userid");
    CURRENT_USER_ID = userid;
    console.log(CURRENT_USER_ID);

    var contactsSection = _("contacts-section");
    var chatList = _("chat-list");
    var chatMessage = _("chatmessage"); // The chat message area



    // Ensure chat list remains active
    chatList.classList.add("active");

    // Expand the chat message area to fill space
    chatMessage.style.flex = "2"; // Adjust width as needed
    chatMessage.style.display = "flex"; // Ensure it remains visible

    // Fetch chat data
    get_data({ userid: CURRENT_USER_ID }, "chats");
}
function send_message(event) {
                var chat_input=_("chat_input");
                if(  chat_input.value.trim()=="")
                {   alert("Please type some text")
                    return ;
                }
                get_data({ message:chat_input.value.trim(),
                    userid: CURRENT_USER_ID },
                 "send_message");
            }
function enter_pressed(event){
    if(event.keyCode==13)
{
    send_message(event);
}
SEEN_STATUS=true;
}
setInterval(function() {
   if(CURRENT_USER_ID !="")
   {
    get_data({
         userid: CURRENT_USER_ID,
        seen: SEEN_STATUS
        }, "chats_refresh");
   }
   
    
}, 5000);
function set_seen(e)
{
    SEEN_STATUS=true;
}
function delete_message(e)
{
    if(confirm("Are you want to delete that message??"))
{
    var msgid= e.target.getAttribute("msgid");
    get_data({
         rowid: msgid
        
        }, "delete_message");
    get_data({
         userid: CURRENT_USER_ID,
        seen: SEEN_STATUS
        }, "chats_refresh");
}
}
function delete_thread(e)
{
    if(confirm("Are you want to delete that message??"))
{
   
    get_data({
        userid: CURRENT_USER_ID
        
        }, "delete_thread");
    get_data({
         userid: CURRENT_USER_ID,
        seen: SEEN_STATUS
        }, "chats_refresh");
}
}
function send_image(files){
    var filename=files[0].name;
    var ext_start=filename.lastIndexOf(".");
    var ext=filename.substr(ext_start+1,3);
    if(!(ext=="jpg" || ext=="JPG"))
{
    alert("This file type is not allowed");
    return;
}

    var myform= new FormData();
    var xml = new XMLHttpRequest();
                xml.onload = function () {
                    if (xml.readyState == 4 && xml.status == 200) {
                     handle_result(xml.responseText,"send_image");
                     get_data({
                     userid: CURRENT_USER_ID,
                     seen: SEEN_STATUS
        }, "chats_refresh");
                    }
                };
                myform.append('file', files[0]);
                myform.append('data_type', "send_image");
                myform.append('userid', CURRENT_USER_ID);
                xml.open("POST", "http://localhost/Project/aicat/uploader.php", true);
                xml.send(myform);
}


</script>
</body>
</html>
