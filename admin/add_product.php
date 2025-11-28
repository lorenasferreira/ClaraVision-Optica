<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $detalles = $_POST["detalles_tecnicos"];
    $imagen = $_POST["imagen"];
    $destacado = isset($_POST["destacado"]) ? 1 : 0;

    $sql = "INSERT INTO producto (nombre, detalles_tecnicos, imagen, destacado, fecha_registro) 
            VALUES (?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $detalles, $imagen, $destacado);

    if ($stmt->execute()) {
        $success = "Product added successfully!";
    } else {
        $error = "Error adding product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

    <header class="admin-header">
        <h1>ClaraVisión Admin</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <nav class="admin-nav">
        <a href="dashboard.php">Dashboard</a>
        <a href="clients.php">Clients</a>
        <a href="products.php"><strong>Products</strong></a>
        <a href="sales.php">Sales</a>
    </nav>

    <div class="login-wrapper">
        <div style="width:100%; max-width:900px;">

            <div class="page-header">
                <h2>Add New Product</h2>
                <a href="products.php" class="btn-primary">← Back</a>
            </div>

            <?php if (!empty($error)) : ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if (!empty($success)) : ?>
                <p class="success-message" style="
                   background:#d4ffd4;
                   color:#006600;
                   padding:10px;
                   border-radius:6px;
                   margin-bottom:15px;
                   border:1px solid #9ff89f;">
                   <?php echo $success; ?>
                </p>
            <?php endif; ?>

            <form method="POST" class="admin-form">

                <label for="nombre">Product Name</label>
                <input type="text" name="nombre" id="nombre" required>

                <label for="detalles_tecnicos">Technical Details (JSON)</label>
                <textarea 
                    name="detalles_tecnicos" 
                    id="detalles_tecnicos"
                    placeholder='{"material":"TR90","ajustable":true}'
                    required
                ></textarea>

                <label for="imagen">Image filename (e.g. photo1.jpg)</label>
                <input type="text" name="imagen" id="imagen" required>

                <label style="display:flex;align-items:center;gap:10px;">
                    <input type="checkbox" name="destacado"> Featured product
                </label>

                <button type="submit" class="btn-primary">Add Product</button>
            </form>

        </div>
    </div>

</body>
</html>