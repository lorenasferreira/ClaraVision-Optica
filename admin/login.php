<?php

session_start();
require_once('../db_connect.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, username, password_hash FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin["password_hash"])) {

            $_SESSION["logged_in"] = true;
            $_SESSION["admin_name"] = $admin["username"];

            header("Location: ./dashboard.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Admin not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ClaraVisión Admin Login</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="login-body">

    <div class="login-wrapper">
        <div class="login-box">

            <h1 class="login-title">Admin Login</h1>

            <?php if (!empty($error)) : ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="POST" class="login-form">

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="login-btn">Sign In</button>

            </form>
        </div>
    </div>

</body>

</html>