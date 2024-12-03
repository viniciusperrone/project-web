<?php
session_start();
require_once 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        try {
            $sql = "SELECT id, password FROM users WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: ../frontend/index.php'); 
                exit();
            } else {
                $_SESSION['auth_error'] = 'E-mail ou senha inválidos.';
                header('Location: ../frontend/login.php');
                exit();
            }
        } catch (PDOException $e) {
            die('Erro no banco de dados: ' . $e->getMessage());
        }
    } else {
        $_SESSION['auth_error'] = 'Por favor, preencha todos os campos.';
        header('Location: ../frontend/login.php');
        exit();
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    exit('Método não permitido');
}
?>
