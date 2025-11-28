<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT id, nombre, destacado FROM producto ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin – Products</title>
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
                <h2>Products</h2>
                <a href="add_product.php" class="btn-primary">+ Add Product</a>
            </div>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Featured</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                                <td><?php echo $row["destacado"] ? "Yes" : "No"; ?></td>

                                <td>
                                    <a href="edit_product.php?id=<?php echo $row['id']; ?>"
                                        class="btn-action edit">Edit</a>
                                </td>

                                <td>
                                    <a href="delete_product.php?id=<?php echo $row['id']; ?>"
                                        class="btn-action delete"
                                        onclick="return confirmDelete();">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="empty-row">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>
    <script src="../assets/js/script.js"></script>
</body>

</html>