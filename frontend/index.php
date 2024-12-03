<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=blog_db', 'root', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog PUCPR</title>
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <header>
      <div class="container">
        <div class="header-content">
          <img src="logo-pucpr.png" alt="Logo PUCPR" class="logo" />
          <h1>Blog - PUCPR</h1>
        </div>
        <nav>
          <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="form.php">Criar Blog</a></li>
            <li><a href="about.html">Sobre</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="../backend/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </header>
    <main>
      <?php
      if (isset($_SESSION['user_id'])) {
          echo "<p>Olá, Usuário!</p>";
          // Mostrar os blogs do usuário
          $sql = "SELECT * FROM blogs WHERE user_id = ?";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$_SESSION['user_id']]);
          $blogs = $stmt->fetchAll();

          if ($blogs) {
              foreach ($blogs as $blog) {
                  echo "<div class='mb-4'>
                          <h3 class='text-xl'>{$blog['title']}</h3>
                          <p>{$blog['description']}</p>
                          <p><strong>Categoria:</strong> {$blog['category']}</p>
                        </div>";
              }
          } else {
              echo "<p>Você ainda não tem blogs criados.</p>";
          }
      } else {
          echo "<p><a href='login.php'>Faça login</a> para acessar seus blogs.</p>";
      }
      ?>
    </main>
    <footer>
      <p>&copy; 2024 Blog PUCPR. Todos os direitos reservados.</p>
    </footer>
  </body>
</html>
