<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <header class="admin-header">
        <img src="../assets/img/logo.png" alt="ClaraVisión logo" class="brand-logo" />
        <h1>ClaraVisión Admin</h1>
        <a class="logout-btn" href="logout.php">Logout</a>
    </header>
    <nav class="admin-nav">
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="clients.php">Clientes</a>
        <a href="products.php">Productos</a>
        <a href="sales.php">Ventas</a>
    </nav>
    <main class="admin-welcome">
        <h2>Bienvenida, <?php echo $_SESSION["admin_name"]; ?>!</h2>
        <p>Selecciona una opción en el menu para navegar por el sistema.</p>
    </main>
</body>

</html>