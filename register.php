<?php
include("database.php");

$message = "";
$messageClass = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    
    $checkStmt = $conn->prepare("SELECT id FROM login_details WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();

    if ($checkStmt->get_result()->num_rows > 0) {
       
        $message = "Username already exists. Please choose a different username. Or
                    Login with that username.";
        $messageClass = "error-message";
    } else {
      
        $insertStmt = $conn->prepare("INSERT INTO login_details (username, password) VALUES (?, ?)");
        $insertStmt->bind_param("ss", $username, $password);

        if ($insertStmt->execute()) {
       
            $message = "Registration successful. Please login.";
            $messageClass = "success-message";
        } else {
           
            $message = "Error during registration";
            $messageClass = "error-message";
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login or Register</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php
           
            if (!empty($message)) {
                echo "<p class='$messageClass'>$message</p>";
            }

            
            if (isset($_GET["register"])) {
               
                include("register-form.php");
            } elseif (isset($_POST["login"])) {
               
                include("login.php");
            } else {
               
                include("login-form.php");
            }
            ?>
        </div>
    </div>
</body>
</html>