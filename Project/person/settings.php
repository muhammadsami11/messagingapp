<?php
$id=$_SESSION['userid'];
$sql="SELECT * FROM signup WHERE userid=:userid";
$DATA=$DB->read($sql,['userid'=>$id]);
$mydata='';
$info = new stdClass();
if(is_array($DATA))
{
    $DATA=$DATA[0];
    $image="http://localhost/Project/aicat/2.jpg";
    if(!empty($DATA->image))
    {
        $image=$DATA->image;
    }  
$mydata = '
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    div.heading {
      text-align: center;
      margin-bottom: 30px;
    }

    h1 {
      font-size: 36px;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    div.form {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 100%;
      max-width: 500px;
      box-sizing: border-box;
      transition: all 0.3s ease;
    }

    div.form:hover {
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    label {
      font-size: 14px;
      color: #555;
      margin-bottom: 8px;
      display: inline-block;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"],
    input[type="date"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      background-color: #f9f9f9;
      transition: border 0.3s, background-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    input[type="password"]:focus,
    input[type="date"]:focus {
      border-color: #3498db;
      background-color: #eaf5ff;
      outline: none;
    }

    input[type="file"] {
      padding: 4px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #2980b9;
      transform: translateY(-2px);
    }

    input[type="checkbox"] {
      margin-right: 10px;
    }

    a {
      color: #3498db;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    @media (max-width: 600px) {
      div.form {
        padding: 20px;
        width: 90%;
      }

      h1 {
        font-size: 28px;
      }
    }
  </style>
  
   <div class="container">
  <div class="heading">
    <h1>Update Your Settings</h1>
  </div>

  <form id="settingsForm" enctype="multipart/form-data" class="form">
    <div class="image">
      <img src="'. $DATA->image . '" alt="Profile Picture">
      <label for="profile_picture">Change Profile Picture</label>
      <input type="file" id="profile_picture" name="profile_picture">
    </div>

    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <label for="full_name">Full Name</label>
    <input type="text" id="full_name" name="full_name" value="'. $DATA->fullName .'" required>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" value="'. $DATA->userName .'" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="'. $DATA->Email .'" required>

    <label for="date">Date of Birth</label>
    <input type="date" id="date" name="date" value="'. $DATA->Date_birth .'" required>

    <label for="password">New Password</label>
    <input type="password" id="password" name="password" placeholder="Create New Password" value="'. $DATA->password.'" required>

    <label for="confirm_password">Confirm New Password</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" value="'. $DATA->password.'" required>

    <button type="submit" id="submit">Update Settings</button>
    <div id="loading" class="loading" style="display: none;">Updating...</div>
  </form>
</div>

<script>
  // Your existing JavaScript here, but modify error/success handling
  function handle_result(result) {
    const errorMessage = document.getElementById("error-message");
    const successMessage = document.getElementById("success-message");
    const loading = document.getElementById("loading");

    try {
      const data = JSON.parse(result);
      errorMessage.style.display = "none";
      successMessage.style.display = "none";
      loading.style.display = "none";

      if (data.data_type === "info") {
        successMessage.innerHTML = "Your settings have been updated!";
        successMessage.style.display = "block";
        setTimeout(() => {
          window.location = "http://localhost/Project/Settings/settings.php";
        }, 2000);
      } else {
        errorMessage.innerHTML = data.message;
        errorMessage.style.display = "block";
      }
    } catch (e) {
      errorMessage.innerHTML = "There was an issue with the response.";
      errorMessage.style.display = "block";
    }
  }



  <script>
    function _(element) {
      return document.getElementById(element);
    }

    var settings_button = _("submit");
    settings_button.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default form submission
      collect_data();
    });

    function collect_data() {
      settings_button.disabled = true;
      settings_button.innerText = "Please wait...";
      var myform = _("settingsForm");
      var formData = new FormData(myform); // Using FormData to include file uploads

      send_data(formData, "update_settings");
    }

    function send_data(formData, type) {
      formData.append("data_type", type); // Append data type to form data
      var xml = new XMLHttpRequest();
      xml.open("POST", "http://localhost/Project/Settings/api.php", true);

      xml.onload = function () {
        if (xml.readyState == 4 && xml.status == 200) {
          handle_result(xml.responseText);
        }
      };

      xml.send(formData); // Send the FormData which includes the file
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
          errorDiv.innerHTML = "Your settings have been updated.";
          errorDiv.style.display = "none";
          window.location = "http://localhost/Project/Settings/settings.php";
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
      settings_button.disabled = false;
      settings_button.innerText = "Update Settings"; // Make sure the button text is reset to its original
    }
  </script>
';}

$info->message = $mydata;
$info->data_type = "settings";
echo json_encode($info);

die;

$info->message = "no settings were found";
$info->data_type = "error";
echo json_encode($info);
?>
