<?php
$host = 'localhost';
$user = 'webuser';
$password = '1q@W3e$R5t^Y7u*I9o)P';
$database = 'usrdata';

// Connect to MySQL
$db = mysqli_connect($host, $user, $password, $database);
if (!$db) {
    die('Database connection failed: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Check if username already exists
    $checkUser = "SELECT id FROM user WHERE username='$username'";
    $result = mysqli_query($db, $checkUser);
    if (mysqli_num_rows($result) > 0) {
        die("Username already taken. Please choose another.");
    }

    // Insert new user
    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($db, $sql)) {
        echo "Account created successfully! <a href='index.php'>Login</a>";
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
