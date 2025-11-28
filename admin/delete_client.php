<?php
session_start();
require_once('../db_connect.php');

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {

    $id = intval($_GET["id"]);
    $sql = "DELETE FROM cliente WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: clients.php");
        exit;
    } else {
        echo "Error deleting client.";
    }
} else {
    header("Location: clients.php");
    exit;
}