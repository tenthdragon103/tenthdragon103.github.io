<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: entryFailed.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesMain.css">
    <script src="scripts.js"></script>
    <title>Main Page</title>
</head>
<body>
    <div class="main">
        <nav>
            <div class="navdiv1">
                example name
            </div>
            <div class="navdiv2">
                Main
            </div>
            <div class="navdiv3">
                <input type="image" class="plusImg" onclick="" src="plusSign.png"/>
		<button class="usrNameButton" onclick="getUsrInfo()"><?php echo($_SESSION['login_user']) ?></button>
<div class="dropdown-content" id="userdropdown">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
    <p>p</p>
</div>
            </div>
        </nav>
        <div>
            <a href="logout.php">Logout</a>
	    <form action="restartMc.php" method="post">
    		<button type="submit">Restart Minecraft Server</button>
	    </form>
        </div>
    </div>
</body>
</html>
