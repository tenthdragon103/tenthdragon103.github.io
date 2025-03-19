<?php
$host = 'localhost';
$user = 'webuser';
$password = '1q@W3e$R5t^Y7u*I9o)P';
$database = 'usrdata';

// Create a secure database connection
$db = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($db->connect_error) {
    die('Database connection failed: ' . $db->connect_error);
}
?>
