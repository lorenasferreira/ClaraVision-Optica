<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["id"])) {
    header("Location: products.php");
    exit;
}

$id = $_GET["id"];

$sql = "SELECT * FROM producto WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $detalles = $_POST["detalles_tecnicos"];
    $imagen = $_POST["imagen"];
    $destacado = isset($_POST["destacado"]) ? 1 : 0;

    $sqlUpdate = "UPDATE producto 
                  SET nombre = ?, detalles_tecnicos = ?, imagen = ?, destacado = ?
                  WHERE id = ?";

    $stmt2 = $conn->prepare($sqlUpdate);
    $stmt2->bind_param("sssii", $nombre, $detalles, $imagen, $destacado, $id);

    if ($stmt2->execute()) {
        $success = "Product updated successfully!";

        $product["nombre"] = $nombre;
        $product["detalles_tecnicos"] = $detalles;
        $product["imagen"] = $imagen;
        $product["destacado"] = $destacado;
    } else {
        $error = "Error updating product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
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
                <h2>Edit Product</h2>
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
                <input type="text" name="nombre" id="nombre"
                    value="<?php echo htmlspecialchars($product['nombre']); ?>" required>

                <label for="detalles_tecnicos">Technical Details (JSON)</label>
                <textarea name="detalles_tecnicos" id="detalles_tecnicos" required><?php
                                                                                    echo htmlspecialchars($product["detalles_tecnicos"]);
                                                                                    ?></textarea>

                <label for="imagen">Image filename</label>
                <input type="text" name="imagen" id="imagen"
                    value="<?php echo htmlspecialchars($product['imagen']); ?>" required>

                <label style="display:flex;align-items:center;gap:10px;">
                    <input type="checkbox" name="destacado"
                        <?php if ($product["destacado"] == 1) echo "checked"; ?>>
                    Featured product
                </label>

                <button type="submit" class="btn-primary">Save Changes</button>
            </form>

        </div>
    </div>

</body>

</html>