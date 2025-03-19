<?php
   
   require '/var/www/html/config.php'; 
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $myusername);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($mypassword, $row['password'])) {
            session_start();
            $_SESSION['login_user'] = $myusername;
            header("Location: " . ($myusername == 'admin' ? "AdminMain.php" : "MainPage.php"));
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesIndex.css">
    <script src="script.js"></script>
    <title>example title</title>
</head>
<body>
    <div class="centerTitle">
        <strong class="title centAlign">example name<br></strong>
        <span class="littleText">example undertext</span>
    </div>
    <div class="centAlign">
        <form class="signIn" action="" method="post">
            <div class="alignRight">
                <input class="pass" type="text" placeholder="Username" id="usrnm" name="username" required>
                <input class="pass" type="password" placeholder="Password" id="pwd" name="password" required>
            </div>
            <div class="alignLeft">
                <button type="submit" class="passEnt" id="enter"><span>Enter</span></button>
            </div>
        </form>
	<form action="signup.php" method="post">
    		<h3>Create an Account</h3>
    		<input type="text" name="username" placeholder="New Username" required>
    		<input type="password" name="password" placeholder="New Password" required>
    		<button type="submit">Sign Up</button>
	</form>
    </div>
</body>
</html>
