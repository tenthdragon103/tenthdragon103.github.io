<?php
    session_start(); // Start the session

    $host = 'localhost';
    $user = 'root';
    $password = '1q@W3e$R';
    $database = 'usrdata';

    // Connect to MySQL server
    try {
        $db = mysqli_connect($host, $user, $password, $database);
    } catch (Exception $e) {
        header("location: EntryFailed.php?error=Database error");
    }

    if (!$db) {
        die('Could not connect: ' . mysqli_connect_error());
        //header("location: EntryFailed.php");
        //echo "<script>alert('DB err');</script>";
        header("location: EntryFailed.php?error=Database error");
    }

    if(!isset($_COOKIE["user"])) {
        //cookie failure
        header("location: EntryFailed.php?error=Failed to load cookies");
    }

    if (isset($_COOKIE["user"]) && isset($_COOKIE["password"])) {
        // Sanitize and validate $myusername and $mypassword

        $user = filter_input(INPUT_COOKIE, 'user', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($user)) {
            // Handle empty user
            header("location: EntryFailed.php?error=Empty username");
            //echo "<script>alert('usrnm empty err');</script>";
        }

        // Validate $_COOKIE["user"] format
        if (!preg_match('/^[A-Za-z0-9]+$/', $user)) {
            // Handle invalid user format
            header("location: EntryFailed.php?error=Invalid username");
            //echo "<script>alert('usrnm invalid err');</script>";
        }

        // Sanitize and validate $_COOKIE["password"]
        $password = filter_input(INPUT_COOKIE, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($password)) {
            // Handle empty password
            header("location: EntryFailed.php?error=Empty password");
            //echo "<script>alert('pw empty err');</script>";
        }

        // Validate $_COOKIE["password"] format or criteria
        if (strlen($password) < 4) {
            // Handle short password
            header("location: EntryFailed.php?error=Invalid password");
            //echo "<script>alert('pw short err');</script>";
        }

        //ensure user is admin
        if ($user != 'admin') {
            header("location: EntryFailed.php?error=You do not have access to this page");
        }

        $myusername = mysqli_real_escape_string($db, $user);
        $mypassword = mysqli_real_escape_string($db, $password);

        $sql = "SELECT * FROM user WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row
        if ($count == 1) {
            $_SESSION['login_user'] = $myusername;
        } else {
            header("location: EntryFailed.php?error=Validation failed");
            //echo "<script>alert('cred err');</script>";
        }
    } else {
        header("location: EntryFailed.php?error=Missing perams");
        //echo "<script>alert('missing params err');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesMain.css">
    <script src="script.js"></script>
    <title>Admin Page</title>
</head>
<body>
    <div class="main">
        <nav>
            <div class="navdiv1">
                The Dump
            </div>
            <div class="navdiv2">
                Main/Database
            </div>
            <div class="navdiv3">
                <button class="usrNameButton" onclick="getUsrInfo()">admin</button>
            </div>
        </nav>
    </div>
    <h1>Connection:</h1>
<?php
$host = 'localhost';
$user = 'root';
$password = '1q@W3e$R';
$database = 'usrdata';

// Connect to MySQL server
$link = mysqli_connect($host, $user, $password, $database);
if (!$link) {
    die('Could not connect: ' . mysqli_connect_error());
}

echo 'Connected successfully <br>';
$result = $link->query("SELECT * FROM user LIMIT 100");

echo "<table border='1'>
<tr>
<th>Email</th>
<th>Password</th>
<th>Username</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['password'] . "</td>";
echo "<td>" . $row['username'] . "</td>";
echo "</tr>";
}
echo "</table>";

// Close the connection
//mysqli_close($link);
?>
</body>
</html>