<?php
include("database.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM login_details WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $dbUsername, $dbPassword);
    $stmt->fetch();
    $stmt->close();

    if ($username == $dbUsername && password_verify($password, $dbPassword)) {
        
        $_SESSION["username"] = $username;
        header("Location: registered.php");
        exit();
    } else {
        
        $_SESSION['loginErrorMessage'] = "Invalid username or password";
        header("Location: index.php"); 
        exit();
    }
}

$conn->close();
?>
