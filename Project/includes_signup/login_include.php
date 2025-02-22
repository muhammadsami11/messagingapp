<?php
$info = (object)[];
$data = [];
$data['Email'] = $DATA_OBJ->email;

// Debugging: Log received email
error_log("Attempting login for email: " . $DATA_OBJ->email);

$query = "SELECT * FROM signup WHERE Email = :Email LIMIT 1";  
$result = $DB->read($query, $data);

if (is_array($result)) {
    $result = $result[0];

   
  
    // Verify the hashed password
    if (password_verify($DATA_OBJ->password, $result->password)) {
        $_SESSION['userid'] = $result->userid;
        
        $info->message = "You are successfully logged in";
        $info->data_type = "info";
    } else {
        $info->message = "Wrong Password";
        $info->data_type = "error";

        // Debugging: Log wrong password attempt
        error_log("Password mismatch for user: " . $DATA_OBJ->email);
    }
} else {
    $info->message = "Wrong Email";
    $info->data_type = "error";

    // Debugging: Log email not found
    error_log("Email not found: " . $DATA_OBJ->email);
}

echo json_encode($info);
exit();
?>
