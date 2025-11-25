<?php
session_start();

// Temporary credentials
$valid_username = "admin";
$valid_password = "1234";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["logged_in"] = true;
        $_SESSION["admin_name"] = $username;

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Invalid username or password.";
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
