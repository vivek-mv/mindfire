<?php
// DATABASE CONNECTION
    $servername = "localhost";
    $username   = "root";
    $password   = "mindfire";
    $database   = "registration";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message=" . " " . $conn->connect_error);
        exit();
    }
?>