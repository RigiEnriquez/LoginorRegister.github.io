<?php
include("database.php");

session_start();

// Function to display messages
function displayMessage($message, $messageClass) {
    echo "<p class='$messageClass'>$message</p>";
}

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
            // Display error message if any
            if (!empty($_SESSION['loginErrorMessage'])) {
                displayMessage($_SESSION['loginErrorMessage'], 'error-message');
                unset($_SESSION['loginErrorMessage']); // Clear the error message after displaying
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
