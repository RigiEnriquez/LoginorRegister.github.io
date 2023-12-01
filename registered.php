<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include("database.php");

$result = $conn->query("SELECT id, username, password FROM login_details");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Registered Accounts</title>
</head>

<body>

<div class="registered-container">

    <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
    <h1>Registered Accounts Database</h1>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td><input type='password' value='{$row['password']}' readonly></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="logout-container">
        <a href="logout.php" class="logout-link">Logout</a>
    </div>

</div>

</body>

</html>

<?php
$conn->close();
?>