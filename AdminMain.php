<?php
session_start();
include('config.php');

if (!isset($_SESSION['login_user'])) {
    header("location: entryFailed.php"); // Redirect to login page if not logged in
    exit();
}
if ($_SESSION['login_user'] !== "admin") {
    header("location: entryFailed.php"); // Redirect non-admins to main user page
    exit();
}
$sql = "SELECT id, username, password, created_at FROM user";
$result = $db->query($sql);

if (!$result) {
    die("Error executing query: " . $db->error);  // Display the error if the query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesMain.css">
    <script src="scripts.js"></script>
    <title>Admin Page</title>
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
                <button class="usrNameButton" onclick="getUsrInfo()">admin</button>
            </div>
        </nav>
        <div>
		<a href="logout.php">Logout</a>
		
	<table class="user-table">
    	<thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Registration Date</th>
        </tr>
    	</thead>
    	<tbody>
        	<?php
        	if ($result->num_rows > 0) {
        	    while($row = $result->fetch_assoc()) {
        	        echo "<tr>";
        	        echo "<td>" . $row["id"] . "</td>";
        	        echo "<td>" . $row["username"] . "</td>";
        	        echo "<td>" . $row["password"] . "</td>";
        	        echo "<td>" . $row["created_at"] . "</td>";
        	        echo "</tr>";
        	    }
        	} else {
        	    echo "<tr><td colspan='4'>No users found</td></tr>";
        	}
        	?>
    	</tbody>
	</table>
		
        </div>
    </div>
</body>
</html>
