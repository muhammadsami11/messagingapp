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
                <img src="search.png">
                <input type="text" placeholder="Search here">
            </div>
        </div>

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
         function handle_result(result, type) {
    console.log("Server Response:", result);
    try {
        if (!result.trim()) {
            throw new Error("Empty response from server");
        }

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
                    var contactsList = _("contacts-section");
                    contactsList.innerHTML = obj.message || "<p>No contacts found</p>";
                    break;
                case "chats":
                    var chatList = _("chat-list");
                    chatList.innerHTML = obj.message || "<p>No chats found</p>";
                    break;
                case "settings":
                    var settingsSection = _("settings-section");
                    settingsSection.innerHTML = obj.message || "<p>No settings found</p>";
                    break;
                case "save_settings":
                   
                    console.log( obj.message) ;
                    send_data({}, "user_info");
                   
                  
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

            function get_data(find, type) {
                var xml = new XMLHttpRequest();
                xml.onload = function () {
                    if (xml.readyState == 4 && xml.status == 200) {
                     alert(xml.responseText);  
                        handle_result(xml.responseText, type);
                    }
                };
                var data = { find: find, data_type: type };
                xml.open("POST", "http://localhost/Project/Signup/api.php", true);
                xml.setRequestHeader("Content-Type", "application/json");
                xml.send(JSON.stringify(data));
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
                     alert(xml.responseText);  
                    
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
    function start_chats(event)
    {
        var chatlist= _("chat-list");
        chatlist.checked= false;
        
    }
</script>
</body>
</html>
