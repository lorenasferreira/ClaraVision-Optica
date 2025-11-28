<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT id, nombre, apellido FROM cliente";
$result = $conn->query($sql);

$clients = [];

if ($result && $result->num_rows > 0) {
    $clients = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Clients</title>
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
    <main>
        <div class="page-header">
            <h2>Clientes</h2>
            <a href="add_client.php" class="btn-primary">Add New Client</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clients)) : ?>
                    <tr>
                        <td colspan="4" class="empty-row">No clients registered yet.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($clients as $c): ?>
                        <tr>
                            <td><?php echo $c['id']; ?></td>
                            <td><?php echo $c['nombre']; ?></td>
                            <td><?php echo $c['apellido']; ?></td>
                            <td>
                                <a href="edit_client.php?id=<?php echo $c['id']; ?>" class="btn-action edit">Edit</a>
                                <a href="delete_client.php?id=<?php echo $c['id']; ?>"
                                    class="btn-action delete"
                                    onclick="return confirmDelete();">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <script src="../assets/js/script.js"></script>
</body>
</html>