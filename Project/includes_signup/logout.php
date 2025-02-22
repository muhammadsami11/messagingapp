<?php
 // Ensure correct path to api.php

// Ensure $info is initialized to avoid "Attempt to assign property on null" error
if (!isset($info)) {
    $info = new stdClass();
}

// Destroy session properly
if (isset($_SESSION['userid'])) {
    unset($_SESSION['userid']);
    session_destroy();
    $info->logged_in = false;
    $info->message = "Logged out successfully";
} else {
    $info->logged_in = false;
    $info->message = "No active session found";
}

// Return JSON response

echo json_encode($info);
?>
