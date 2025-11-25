<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);

    if ($nombre !== "" && $apellido !== "") {

        $sql = "INSERT INTO cliente (nombre, apellido) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $apellido);

        if ($stmt->execute()) {
            header("Location: clients.php");
            exit;
        } else {
            $error = "Error saving client.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Client</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <header class="admin-header">
        <img src="../assets/img/logo.png" alt="ClaraVisión logo" class="brand-logo" />
        <h1>ClaraVisión Admin</h1>
        <a class="logout-btn" href="logout.php">Logout</a>
    </header>
    <nav class="admin-nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="clients.php" class="active">Clients</a>
        <a href="products.php">Products</a>
        <a href="sales.php">Sales</a>
    </nav>

    <main class="admin-main">
        <h2>Add New Client</h2>
        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST" class="admin-form">

            <label for="nombre">Name</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Last Name</label>
            <input type="text" id="apellido" name="apellido" required>

            <button type="submit" class="btn-primary">Save Client</button>
        </form>

    </main>

</body>

</html>