<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three-Section Chat UI with Timestamps</title>
    <link rel="stylesheet" href="aicat.css">
    <style>
        /* Flexbox container for sections */
        .chat-container {
            display: flex;
            height: 100vh;
            width: 100%;
            transition: 0.3s ease;
        }

        /* Sections (Chat List, Contacts, Settings) */
        .chat-list, .contacts-section, .settings-section {
            flex: 1;
            background: #f8f9fa;
            padding: 10px;
            display: none; /* All hidden initially */
            transition: 0.3s ease;
        }

        /* Show active section */
        .active {
            display: flex;
            width: 100%;

            flex-direction: column;
        }
        #contacts-list img{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 10px;
            padding:
        }
        #contacts-section{
            display: flex;
            flex-direction: row;
            margin: 10px;
           
            justify-content: center;
        }
        
        #active_contact {
            
            height: 90px;
            border: solid thin #aaa;
            margin:10px;
            padding: 5px;
            background-color: #eee;
        }
        #active_contact img{
            width: 70px;
            height: 70px;
            float:left;
            margin:5px;
        }
        #chatmessage{
            display: flex;
            flex-direction: column;
            background-color: green;
            overflow-y:scroll;
        }
        #chat_message_child{
            display: flex;
            flex-direction: column;
            height:550px;
            background-color: white;
            overflow-y:scroll;
        }

        #message_left {
            width: 80%;
            
            height: 90px;
            float:left;
            margin:10px;
            padding: 5px;
            padding-right:8px;
            background-color: #eee;
            box-shadow: 0px 0px 1px #aaa;
            border-bottom-left-radius: 50%;
            position: relative;
        }
        #message_left img{
            width: 70px;
            height: 70px;
            float:left;
            margin:5px;
            border-radius:50%;
            border: solid 2px white;
        }
        #message_left div{
            width: 20px;
            height: 20px;
            float:left;
            margin:5px;
            background-color: black;
            border-radius:50%;
            position: absolute;
            left:-15px;
            top:20px;
        }
        #message_right {
            height: 90px;
            margin-top:20px;
  float: right;
  margin-left: 200px;
  margin-right: 20px;
  text-align: left;
  padding: 8px;
  background-color: #eee;
  box-shadow: 0px 0px 1px #aaa;
  border-bottom-right-radius: 50%;
  position: relative;
  width: 400px;
                        }
        
        #message_right img{
            width: 70px;
            height: 70px;
            float:right;
            margin:5px;
            border-radius:50%;
            border: solid 2px white;
        }
        #message_right div{
            width: 20px;
            height: 20px;
            float:right;
            margin:5px;
            background-color: black;
            border-radius:50%;
            position: relative;
            
        }
        .active_chat_container {
    display: flex;
    flex-direction: column;
    height: 100%;
    max-width: 100%; /* Adjust based on your chat container */
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
}

.chat_message_child {
    flex: 1;
    overflow-y: auto;
    padding: 10px;
}

.chat_input_container {
    display: flex;
    align-items: center;
    padding: 10px;
    background: white;
    border-top: 1px solid #ccc;
}

.chat_input_container input[type="text"] {
    flex: 6;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.chat_input_container input[type="button"] {
    flex: 1;
    margin-left: 10px;
    padding: 10px;
    background: green;
    color: white;
    border: none;
    border-radius: 5px;
}

.chat_input_container label img {
    width: 30px;
    cursor: pointer;
    margin-right: 10px;
}


    </style>
</head>

<body>

    <!-- Sidebar Section -->
    <div class="sidebar">
        <div class='leftsidebar'>
            <div class="sidebar-logo">
                <img src="6.png" alt="Logo">
            </div>
            <div class="sidebar-logo">
                <label id="label_contacts"> <img src="contact.png" alt="Contacts"></label>
            </div>
            <div class="sidebar-logo2">
                <label id="label_message"><img src="8.png" alt="Chats"></label>
            </div>
        </div>
        <div class='sidebar-bottom'>
            <div class="sidebar-logo">
                <label id="label_setting"> <img src="7.png" alt="Settings"></label>
            </div>
        </div>
        <div class="logout">
            <button type="button" id="logout">Logout</button>
        </div>
    </div>

    <!-- Chat Container (Flexbox Layout) -->
    <div class="chat-container" id="chat_container">
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
           
          
        </div>

        <!-- Settings Section (Initially Hidden) -->
        <div class="settings-section" id="settings-section">
            <h2>Settings</h2>
            <p>Settings will be displayed here.</p>
        </div>
    </div>

    <div id="user_info">
        <h2>Profile</h2>
        <img id="profile_image" src="5.jpg" width=100px; height= 80px; alt="Profile">
        <div id="information">
            <div id="username">Username</div>
            <div id="email">Email</div>
        </div>
    </div>

    <script>
        var CURRENT_USER_ID="";
        var SEEN_STATUS=false;
         function handle_result(result, type) {
  
    try {
        if (!result.trim()) {
            throw new Error("Empty response from server");
        }
        var chatmessage=_("chatmessage");
        chatmessage.style.overflow= "visible";
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
                    _("profile_image").src = obj.image ;
                    break;
                case "contacts":
                    SEEN_STATUS=false;
                    var contactsList = _("contacts-section");
                    contactsList.innerHTML = obj.message || "<p>No contacts found</p>";
                    chatmessage.style.overflow= "hidden";

                    break;
               
                case "chats":
                    SEEN_STATUS=false;
                    var chatList = _("chat-list");
                    var chat_message=_("chatmessage");
                    chatList.innerHTML = obj.user ;
                    chat_message.innerHTML = obj.messages ;
                    break;
                    case "chats_refresh":
                    var active_chat_container = _("chat_message_child");
                    active_chat_container.innerHTML = obj.messages ;
                    break;
                case "settings":
                    var settingsSection = _("settings-section");
                    settingsSection.innerHTML = obj.message || "<p>No settings found</p>";
                    break;
                case "save_settings":
                   
                    
                    send_data({}, "user_info");
                   
                    break;
                    case "send_message":
                        var chatList = _("chat-list");
                    var chat_message=_("chatmessage");
                    chatList.innerHTML = obj.user ;
                    chat_message.innerHTML = obj.messages ;
                    var chat_message_child=_("chat_message_child");
                    chat_message_child.scrollTo(0,chat_message_child.scrollHeight);
                    var chat_input=_("chat_input");
                    chat_input.focus();
                   
                  
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

            // Logout Button Event Listener
            if (logoutButton) logoutButton.addEventListener("click", logout_user);

            // Contacts Button Event Listener
            if (contactsButton) {
                contactsButton.addEventListener("click", function () {
                    showSection(contactsSection);
                    get_contacts(); // Fetch contacts when the section is displayed
                });
            }

            // Messages Button Event Listener
            if (messagesButton) {
                messagesButton.addEventListener("click", function () {
                    showSection(chatList);
                    get_chats(); // Fetch chats when the section is displayed
                });
            }

            // Settings Button Event Listener
            if (settingsButton) {
                settingsButton.addEventListener("click", function () {
                    showSection(settingsSection);
                    get_settings(); // Fetch settings when the section is displayed
                });
            }

           
           

            function logout_user() {
                get_data({}, "logout");
            }

            function get_contacts() {
                get_data({}, "contacts");
            }

            function get_chats() {
                get_data({
                    
                }, "chats");
                
            }

            function get_settings() {
                get_data({}, "settings");
            }
            function send_message(event) {
                var chat_input=_("chat_input");
                alert(chat_input.value);
            }

            get_data({}, "user_info");
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

    // Hide contacts section
    contactsSection.style.display = "none";

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
</script>
</body>
</html>
