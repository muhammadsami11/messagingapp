<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif; /* Modern Google Font */
    background: linear-gradient(to right, #0093E9, #80D0C7);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    padding: 20px;
}

.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    max-width: 1000px;
    width: 100%;
    padding: 30px;
    background: rgba(255, 255, 255, 0.1); /* Glass-morphism effect */
    border-radius: 20px;
    backdrop-filter: blur(10px); /* Blur effect for glass-morphism */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3); /* Subtle border */
}

.left_side_header {
    flex: 1;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: white;
    padding: 20px;
}

.left_side_header img {
    max-width: 150px;
    margin-bottom: 20px;
}

.left_side_header h2 {
    font-size: 28px;
    margin-bottom: 10px;
    color: white;
}

.left_side_header p {
    font-size: 16px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9); /* Semi-transparent text */
}

.right_side_header {
    flex: 1;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.heading {
    text-align: center;
    margin-bottom: 20px;
}

.heading h1 {
    font-size: 32px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: white;
    background: linear-gradient(to right, #0093E9, #80D0C7); /* Gradient text */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Form Styling */
.form {
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    padding: 25px;
    width: 100%;
    max-width: 400px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.form:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

/* Input Fields with Floating Labels */
.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group input {
    width: 100%;
    padding: 12px;
    border: 2px solid transparent;
    border-radius: 8px;
    font-size: 14px;
    background-color: rgba(255, 255, 255, 0.9);
    transition: all 0.3s ease;
}

.input-group input:focus {
    border-color: #0093E9;
    background-color: white;
    outline: none;
    box-shadow: 0 0 10px rgba(0, 147, 233, 0.3);
}

.input-group label {
    position: absolute;
    top: 12px;
    left: 12px;
    font-size: 14px;
    color: #777;
    pointer-events: none;
    transition: all 0.3s ease;
}

.input-group input:focus ~ label,
.input-group input:not(:placeholder-shown) ~ label {
    top: -8px;
    left: 10px;
    font-size: 12px;
    color: #0093E9;
    background: white;
    padding: 0 5px;
}

/* Button Styling */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background: linear-gradient(to right, #0093E9, #80D0C7);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

button[type="submit"]:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

button[type="submit"]:active {
    transform: translateY(0);
}

/* Checkbox Styling */
.checkbox-group {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.checkbox-group input[type="checkbox"] {
    appearance: none;
    width: 16px;
    height: 16px;
    border: 2px solid #0093E9;
    border-radius: 4px;
    position: relative;
    cursor: pointer;
    margin-right: 8px;
    transition: all 0.3s ease;
}

.checkbox-group input[type="checkbox"]:checked {
    background-color: #0093E9;
    border-color: #0093E9;
}

.checkbox-group input[type="checkbox"]:checked::after {
    content: '✔';
    color: white;
    font-size: 10px;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Error Message */
#error {
    color: white;
    font-size: 14px;
    margin-top: 10px;
    padding: 10px;
    background-color: #ff4d4d;
    width: 100%;
    max-width: 380px;
    text-align: center;
    display: none;
    border-radius: 5px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .left_side_header,
    .right_side_header {
        width: 100%;
        text-align: center;
        padding: 15px;
    }

    .form {
        max-width: 100%;
        padding: 20px;
    }
}
</style>



</head>

<body>
    <div class="container">
        <div class="left_side_header">
            <img src="logo.png" alt="ChimeChat Logo">
            <h2>Welcome to ChimeChat</h2>
            <p>ChimeChat is your ultimate communication platform, offering secure and real-time messaging with seamless planning integration. Stay connected with your friends, family, and colleagues effortlessly.</p>
        </div>
        <div class="right_side_header">
            <div class="heading">
                <h1>Sign Up</h1>
            </div>
            <div id="error"></div>
            <div class="form">
                <form id="myForm">
                    <div class="input-group">
                        <input type="text" id="full_name" name="full_name" placeholder=" " required>
                        <label for="full_name">Full Name</label>
                    </div>
                    <div class="input-group">
                        <input type="text" id="username" name="username" placeholder=" " required>
                        <label for="username">User Name</label>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder=" " required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="date" id="date" name="date" required>
                        <label for="date">Date of Birth</label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder=" " required>
                        <label for="password">Password</label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder=" " required>
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="agree" id="agree" required>
                        <label for="agree">I agree to the <a href="#">Terms & Conditions</a></label>
                    </div>
                    <button type="submit" id="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>

        <script>
    function _(element) {
        return document.getElementById(element);
    }

    var signup_button = _("submit");
    signup_button.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default form submission
        collect_data();
    });

    function collect_data() {
    signup_button.disabled = true;
    signup_button.innerText = "Please wait...";
        var myform = _("myForm");
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

        send_data(data, "submit");
      
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
   console.log(result);
        try {
        var data = JSON.parse(result);
        var errorDiv = _("error");

        // Clear previous error/success message
        errorDiv.innerHTML = "";
        errorDiv.style.display = "none";

        if (data.data_type == "info") {
            errorDiv.innerHTML = "Your profile has been created.";
            errorDiv.style.display = "none";
            window.location = "http://localhost/Project/Loginpage/login.php";
        } else {
            errorDiv.innerHTML = data.message;
            errorDiv.style.display = "block";
        }
    } catch (e) {
        var errorDiv = _("error");
        errorDiv.innerHTML = "There was an issue with the response.";
        errorDiv.style.display = "block";
    }

    // Reset the button after response
    signup_button.disabled = false;
    signup_button.innerText = "Sign Up"; // Make sure the button text is reset to its original
}

</script>

    </div>
   
</body>

</html>