<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../frontend/login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO blogs (user_id, title, description, category) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $title, $description, $category]);

    header('Location: ../frontend/index.html');
}
?>
