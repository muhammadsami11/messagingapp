<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="login.css">
    <style>
        /* General Reset */
/* General Reset */
/* General Reset */
body {
  margin: 0;
  padding: 0;
  font-family: 'Poppins', Arial, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(135deg, #0093E9, #80D0C7);
  color: #333;
}

/* Glassmorphism Effect for Login Box */
.mainpage {
  width: 90%;
  max-width: 400px;
  padding: 30px;
  background: rgba(255, 255, 255, 0.9); /* White but slightly transparent */
  border-radius: 15px;
  backdrop-filter: blur(10px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
  text-align: center;
  transition: 0.3s;
}

/* Avatar Styling */
.avatar {
  margin-bottom: 20px;
}
.avatar img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 4px solid #0093E9;
  box-shadow: 0 4px 10px rgba(0, 147, 233, 0.4);
}

/* Input Fields */
.username {
  display: flex;
  align-items: center;
  background: #f5f5f5;
  border-radius: 10px;
  padding: 12px;
  margin-bottom: 15px;
  box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
  transition: 0.3s;
}
.username img {
  width: 22px;
  margin-right: 10px;
}
.email,
.password {
  border: none;
  outline: none;
  background: transparent;
  font-size: 16px;
  width: 100%;
  color: #333;
}

/* Focus Effect */
.username:focus-within {
  box-shadow: 0 0 8px rgba(0, 147, 233, 0.6);
}

/* Options Section */
.options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 14px;
  margin-bottom: 20px;
  color: #333;
}
.options .checkbox {
  width: 16px;
  height: 16px;
}
.options .Forgot {
  color: #0093E9;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease;
}
.options .Forgot:hover {
  color: #80D0C7;
}

/* Submit Button */
.submit-type {
  margin-top: 20px;
}
button {
  width: 100%;
  padding: 14px;
  font-size: 18px;
  font-weight: bold;
  color: #fff;
  background: linear-gradient(90deg, #0093E9, #80D0C7);
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
button:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 20px rgba(0, 147, 233, 0.4);
}
button:active {
  transform: scale(0.96);
}

/* Signup Section */
.signup {
  margin-top: 20px;
  font-size: 14px;
  color: #333;
}
.signup a {
  color: #0093E9;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease;
}
.signup a:hover {
  color: #80D0C7;
}

/* Error Message */
#error {
  color: white;
  font-size: 14px;
  margin-top: 5px;
  padding: 8px;
  background-color: red;
  width: 100%;
  text-align: center;
  border-radius: 8px;
  display: none;
}

/* Media Query for Mobile */
@media (max-width: 480px) {
  .mainpage {
    padding: 25px;
  }
  .username {
    padding: 10px;
  }
  button {
    padding: 12px;
  }
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
               
                <div class="submit-type">
                    <button type="button" id="submit">Login</button>
                </div>
                <div class="signup">
                    Don't have an account? <a href="http://localhost/Project/Signup/signup.php">Sign up</a>
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
