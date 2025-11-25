<?php include('db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>ClaraVisión Óptica</title>
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/home.css">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
<link rel="shortcut icon" href="favicon.ico">
</head>

<body>

  <?php include('./partials/header.php'); ?>

  <?php
$sqlDest = "SELECT * FROM producto WHERE destacado = 1";
$destacados = $conn->query($sqlDest);
$slides = $destacados->fetch_all(MYSQLI_ASSOC);
?>
<main>
  <section class="hero-slider">
    <div class="slides">
        <?php foreach ($slides as $s): ?>
            <div class="slide">
                <img src="./assets/img/<?php echo $s['imagen']; ?>" alt="<?php echo $s['nombre']; ?>">

                <div class="hero-text">
                    <h2><?php echo $s['nombre']; ?></h2>

                    <?php 
                        $det = json_decode($s['detalles_tecnicos'], true); 
                    ?>

                    <p><?php echo $det['material'] ?? ''; ?></p>

                    <a href="./catalogue.php" class="hero-btn">Ver catálogo</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="hero-prev">❮</button>
    <button class="hero-next">❯</button>
</section>

</main>
<?php include('./partials/footer.php'); ?>

  <script src="./assets/js/script.js"></script>
</body>

</html>