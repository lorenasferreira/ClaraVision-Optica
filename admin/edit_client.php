<?php
session_start();
require_once('../db_connect.php');
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}
if (!isset($_GET["id"])) {
    header("Location: clients.php");
    exit;
}

$id = intval($_GET["id"]);
$sql = "SELECT nombre, apellido FROM cliente WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Client not found.";
    exit;
}

$client = $result->fetch_assoc();
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);

    if ($nombre !== "" && $apellido !== "") {

        $sql_update = "UPDATE cliente SET nombre = ?, apellido = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssi", $nombre, $apellido, $id);

        if ($stmt_update->execute()) {
            header("Location: clients.php");
            exit;
        } else {
            $error = "Error updating client.";
        }
    } else {
        $error = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Client</title>
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

        <h2>Edit Client</h2>

        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST" class="admin-form">

            <label for="nombre">Name</label>
            <input type="text" id="nombre" name="nombre"
                value="<?php echo $client['nombre']; ?>" required>

            <label for="apellido">Last Name</label>
            <input type="text" id="apellido" name="apellido"
                value="<?php echo $client['apellido']; ?>" required>

            <button type="submit" class="btn-primary">Save Changes</button>
        </form>

    </main>

</body>

</html>