<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="login.css">
    <style>
    #error{
        color: #f4f3f3;
  font-size: 14px;
  margin-top: 5px;
  padding: 6px;
  background-color: red;
  width: 400px;
  text-align: center;
}
    </style>
</head>
<body>
    <div class="mainpage">
        <div id="login-box">
            <div class="avatar">
                <img src="man.png">
            </div>
            <form>
                <div class="username">
                    <span><img  src="user.png"></span>
                    <input class="email" name="email" alt="users" placeholder="Email">
                </div>
                <div class="username">
                    <span><img  src="padlock.png"></span>
                    <input class="password" name="password" alt="password" placeholder="Password">
                </div>
                <div class="options">
                    <label>
                        <input type="checkbox" class="checkbox">Remember me
                    </label>
                    <a href="#" class="Forgot">Forgot Password?</a>
                </div>
                <div class="submit-type">
                    <button type="button" id="submit">Login</button>
                </div>
                <div class="signup">
                    Don't have an account? <a href="#">Sign up</a>
                </div>
            </form>
            <div id="error" style="display:none;"></div> <!-- Added error div -->
        </div>
    </div>
    <script>
        function _(element) {
            return document.getElementById(element);
        }

        var login_button = _("submit");
        login_button.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent form submission
            collect_data();
        });

        function collect_data() {
            login_button.disabled = true;
            login_button.innerText = "Please wait...";   

            var myform = _("login-box");
            var inputs = myform.getElementsByTagName("input");
            var data = {};

            for (var i = 0; i < inputs.length; i++) {
                var key = inputs[i].name;
                var value = inputs[i].value;

                switch (key) {
                    case "email":
                        data.email = value;
                        break;
                    case "password":
                        data.password = value;
                        break;
                    default:
                        break;
                }
            }

            send_data(data, "login");
        }

        function send_data(data, type) {
            data.data_type = type;
            var data_string = JSON.stringify(data);
            var xml = new XMLHttpRequest();
            xml.open("POST", "http://localhost/Project/Signup/api.php", true);
            xml.setRequestHeader("Content-Type", "application/json");

            xml.onload = function () {
                if (xml.readyState == 4 && xml.status == 200) {
                    handle_result(xml.responseText);
                }
            };

            xml.send(data_string);
        }

       
        function handle_result(result) {
     // Alert for debugging
    alert(result);
    try {
        var data = JSON.parse(result); // Attempt to parse JSON

        var errorDiv = _("error");
        errorDiv.innerHTML = "";
        errorDiv.style.display = "none";

        if (data.data_type === "info") {
            errorDiv.style.backgroundColor = "green";
            errorDiv.innerHTML = "Login successful!";
            errorDiv.style.display = "block";

            console.log("Redirecting to /Project/aicat/aicat.php...");
            setTimeout(() => {
                window.location.href = "/Project/aicat/aicat.php";
            }, 2000); // Redirect after 2 seconds
        } else {
            errorDiv.innerHTML = data.message;
            errorDiv.style.display = "block";
        }
    } catch (e) {
        console.error("JSON Parsing Error:", e);
        _("error").innerHTML = "There was an issue with the response.";
        _("error").style.display = "block";
    }

    // Reset button
    login_button.disabled = false;
    login_button.innerText = "Login";
}

    </script>
</body>
</html>
