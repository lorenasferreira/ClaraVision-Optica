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

$sql = "DELETE FROM producto WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: products.php");
exit;
?>