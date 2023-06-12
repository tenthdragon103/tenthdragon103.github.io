<?php
    $host = 'localhost';
    $user = 'root';
    $password = '1q@W3e$R';
    $database = 'usrdata';

    setcookie("user");
    setcookie("password");


    // Connect to MySQL server
    $db = mysqli_connect($host, $user, $password, $database);
    if (!$db) {
        die('Could not connect: ' . mysqli_connect_error());
    }
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_name($myusername);
         $_SESSION['login_user'] = $myusername;
         if($myusername == 'admin') {
            setcookie("user", $myusername);
            setcookie("password", $mypassword);
            header("location: AdminMain.php");
         }else{
            setcookie("user", $myusername);
            setcookie("password", $mypassword);
            header("location: MainPage.php");
         }
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesIndex.css">
    <script src="script.js"></script>
    <title>ECS-PRJ</title>
</head>
<body>
    <div class="centerTitle">
        <strong class="title centAlign">The Dump<br></strong>
        <span class="littleText">For random stuff; By @tenthdragon103 on GitHub</span>
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
    </div>
</body>
</html>