<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
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
    <div class="heading">
        <h1>Sign Up</h1>
    </div>
    <div id="error">
      
    </div>
    <div class="form">
        <form id="myForm">


            <label for="full_name">Full Name:</label><br>
            <input type="text" id="full_name" name="full_name" placeholder="Enter Your Full Name" required><br>

            <label for="username">User Name:</label><br>
            <input type="text" id="username" name="username" placeholder="Enter Unique User Name" required><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="@gmail.com" required><br>

            <label for="date">Date of Birth:</label><br>
            <input type="date" id="date" name="date" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Create Strong Password" required><br>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"
                required><br><br>

            <label>
                <input type="checkbox" name="agree" required> I agree to the <a href="#">Terms & Conditions</a>
            </label><br><br>

            <button type="submit" id="submit">Sign Up</button>
        </form>
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