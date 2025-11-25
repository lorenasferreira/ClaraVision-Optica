<?php require_once "db_connect.php"; ?>

<?php
$sql = "SELECT id, nombre, detalles_tecnicos, fecha_registro, imagen FROM producto";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catálogo - ClaraVisión</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/catalogue.css">
</head>
<body>
    <?php include('./partials/header.php'); ?>
    <main>
    <h2>Catálogo ClaraVisión</h2>

    <div class="catalogo-grid">

        <?php
        while ($p = $result->fetch_assoc()) {
            $detalles = json_decode($p['detalles_tecnicos'], true);
        ?>

            <div class="producto-card">
                <img
                    src="./assets/img/<?php echo $p['imagen']; ?>"
                    alt="<?php echo $p['nombre']; ?>"
                    class="producto-img">

                <h3><?php echo $p['nombre']; ?></h3>

                <p><strong>Material:</strong>
                    <?php echo $detalles['material'] ?? 'N/A'; ?>
                </p>

                <p><strong>Colores:</strong>
                    <?php echo implode(", ", $detalles['colores_disponibles'] ?? []); ?>
                </p>

                <p><strong>Ideal para:</strong>
                    <?php echo $detalles['ideal_para'] ?? 'N/A'; ?>
                </p>
            </div>

        <?php
        }
        ?>

    </div>
</main>
<?php include('./partials/footer.php'); ?>
</body>

</html>