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
      <img ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" src="'. $DATA->image . '" width=50px; height: 30px; alt="Profile Picture">
      <label  for="change_image_input" id="change_image_button" ">Change Profile Picture </label>
      <input type="file" onchange="upload_profile_image(this.files)" id="change_image_input" name="profile_picture" style: "display: none;">
   
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

   

    <button type="submit" id="save_settings" onclick="collect_data(event)">Update Settings</button>
    <div id="loading" class="loading" style="display: none;">Updating...</div>
  </form>
</div>

';

$info->message = $mydata;
$info->data_type = "settings";
echo json_encode($info);}

else{

$info->message = "no settings were found";
$info->data_type = "error";
echo json_encode($info);}
?>
