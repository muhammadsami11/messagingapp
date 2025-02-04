<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three-Section Chat UI with Timestamps</title>
    <link rel="stylesheet" href="aicat.css">
</head>

<body>

    <!-- Sidebar Section -->
    <div class="sidebar">
        <div class='leftsidebar'>
            <div class="sidebar-logo">
                <img src="6.png" id alt="Logo">

            </div>
            <div class="sidebar-logo">
                <img src="contact.png" id alt="Logo">
            </div>
            <div class="sidebar-logo2">
                <label id="message-chat" for="message"><img src="8.png" alt="Logo"></label>
            </div>
        </div>
        <div class='sidebar-bottom'>
            <div class="sidebar-logo">
                <label id="setting-chat" for="setting"> <img src="7.png" alt="Logo">

                </label>
            </div>

        </div>
        <div class="logout">
        <button type="button" id="logout" value="logout">Logout</button>
    </div>

    </div>

    <input type="radio" id="message" name="icon" checked style="display: none;">
    <input type="radio" id="setting" name="icon" style="display: none;">
    <!-- Chat List Section -->
    <div class="chat-list">

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


    <div class="setting-div">

    </div>

    <input type="radio" id="chat1" name="active-chat" style="display: none;">
    <input type="radio" id="chat2" name="active-chat" style="display: none;">
    <input type="radio" id="chat3" name="active-chat" style="display: none;">
    <input type="radio" id="chat4" name="active-chat" style="display: none;">
    <input type="radio" id="chat5" name="active-chat" style="display: none;">

    <!-- Chat Sections -->
    <div class="chat-section chat1">
        <div class="chat-header">
            <img src="5.jpg" alt="Profile">
            <strong>Favour Nwaeze</strong>
        </div>
        <div class="chat-messages">
            <div class="chat-message sent">
                hey men!how have you been?
                <div> <span class="timestamp">10:30 AM</span></div>
            </div>
            <div class="chat-message received">
                <div>Hey, Ronaldo, I mean Messi, which one are you? </div>
                <div><span class="timestamp">10:32 AM</span></div>
            </div>
            <div class="chat-message sent">
                Ohhh, I'm both, yeah it's a long story.
                <div><span class="timestamp">10:33 AM</span></div>
            </div>
            <div class="chat-message received">
                <div> Ohhh, really what year is it?</div>
                <span class="timestamp">10:34 AM</span>
            </div>
        </div>
    </div>

    <div class="chat-section chat2">
        <div class="chat-header">
            <img src="5.jpg" alt="Profile">
            <strong>ariana Doe</strong>
        </div>
        <div class="chat-messages">
            <div class="chat-message sent">
                hey men!how have you been?
                <div> <span class="timestamp">10:30 AM</span></div>
            </div>
            <div class="chat-message received">
                <div>Hey, Ronaldo, I mean Messi, which one are you? </div>
                <div><span class="timestamp">10:32 AM</span></div>
            </div>
            <div class="chat-message sent">
                Ohhh, I'm both, yeah it's a long story.
                <div><span class="timestamp">10:33 AM</span></div>
            </div>
            <div class="chat-message received">
                <div> Ohhh, really what year is it?</div>
                <span class="timestamp">10:34 AM</span>
            </div>
        </div>
    </div>

    <div class="chat-section chat3">
        <div class="chat-header">
            <img src="5.jpg" alt="Profile">
            <strong>Jane Smith</strong>
        </div>
        <div class="chat-messages">
            <div class="chat-message sent">
                hey men!how have you been?
                <div> <span class="timestamp">10:30 AM</span></div>
            </div>
            <div class="chat-message received">
                <div>Hey, Ronaldo, I mean Messi, which one are you? </div>
                <div><span class="timestamp">10:32 AM</span></div>
            </div>
            <div class="chat-message sent">
                Ohhh, I'm both, yeah it's a long story.
                <div><span class="timestamp">10:33 AM</span></div>
            </div>
            <div class="chat-message received">
                <div> Ohhh, really what year is it?</div>
                <span class="timestamp">10:34 AM</span>
            </div>
        </div>
    </div>

    <div class="chat-section chat4">
        <div class="chat-header">
            <img src="5.jpg" alt="Profile">
            <strong>Chris Johnson</strong>
        </div>
        <div class="chat-messages">
            <div class="chat-message sent">
                hey men!how have you been?
                <div> <span class="timestamp">10:30 AM</span></div>
            </div>
            <div class="chat-message received">
                <div>Hey, Ronaldo, I mean Messi, which one are you? </div>
                <div><span class="timestamp">10:32 AM</span></div>
            </div>
            <div class="chat-message sent">
                Ohhh, I'm both, yeah it's a long story.
                <div><span class="timestamp">10:33 AM</span></div>
            </div>
            <div class="chat-message received">
                <div> Ohhh, really what year is it?</div>
                <span class="timestamp">10:34 AM</span>
            </div>
        </div>
    </div>

    <div class="chat-section chat5">
        <div class="chat-header">
            <img src="5.jpg" alt="Profile">
            <strong>Emily Davis</strong>
        </div>
        <div class="chat-messages">
            <div class="chat-message sent">
                hey men!how have you been?
                <div> <span class="timestamp">10:30 AM</span></div>
            </div>
            <div class="chat-message received">
                <div>Hey, Ronaldo, I mean Messi, which one are you? </div>
                <div><span class="timestamp">10:32 AM</span></div>
            </div>
            <div class="chat-message sent">
                Ohhh, I'm both, yeah it's a long story.
                <div><span class="timestamp">10:33 AM</span></div>
            </div>
            <div class="chat-message received">
                <div> Ohhh, really what year is it?</div>
                <span class="timestamp">10:34 AM</span>
            </div>
        </div>
    </div>
    <div id="user_info">

        <h2>Profile</h2>
        <img src="5.jpg" alt="Profile">
        <div id="information">
            <div id="username">
                Username
            </div>
            <div id="email">
                Email
            </div>
            <div id="password">
                Password
            </div>
        </div>

    </div>
   
    <script>
        function _(element)
        {
            return document.getElementById(element);
        }
        var logout_button = _("logout");
        logout_button.addEventListener("click", logout_user);
         
        function get_data(find, type) {
            var xml = new XMLHttpRequest();
            xml.onload = function () {
                if (xml.readyState == 4 || xml.status == 200) {
                    handle_result(xml.responseText,type);
                }
            }
            var data = {};
            data.find = find;
            data.data_type = type;
            data = JSON.stringify(data);
           
         xml.open("POST", "http://localhost/Project/Signup/api.php", true);
         xml.setRequestHeader("Content-Type", "application/json");
         xml.send(data);

        }
        function handle_result(result, type) {
    console.log(result); // This will show the JSON response
    if (result.trim() !== "") {
        try {
            var obj = JSON.parse(result);
            console.log(obj); // Log the object to check the structure

            if (typeof(obj.logged_in) !== "undefined" && !obj.logged_in) {
                console.log("Redirecting to /Project/loginpage/login.php...");
            setTimeout(() => {
                window.location.href = "http://localhost/Project/loginpage/login.php";
            }, 2000);
            } else {
                switch (obj.data_type) {
                    case "user_info":
                        var username = _("username");
                        var email = _("email");
                        var password = _("password");

                        // Make sure the values are being set correctly
                        username.innerHTML = obj.userName || "No username found";
                        email.innerHTML = obj.Email || "No email found";
                        password.innerHTML = obj.password || "No password found";
                        console.log(password);
                        break;
                    default:
                        console.log("No data type found");
                        break;
                }
            }
        } catch (e) {
            console.log("JSON Parsing Error:", e);
        }
    } else {
        console.log("An error occurred");
    }
}

        function logout_user() {
            get_data({}, "logout");
        }
        get_data({}, "user_info");

    </script>


</body>

</html>