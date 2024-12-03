<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO blogs (title, description, category, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $category, $user_id]);

    header('Location: index.html');
}
?>

<!-- Formulário de criação de blog -->
<form action="blog.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" required>
    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    <label for="category">Category:</label>
    <select name="category" required>
        <option value="technology">Technology</option>
        <option value="lifestyle">Lifestyle</option>
        <option value="education">Education</option>
    </select>
    <button type="submit">Create Blog</button>
</form>
