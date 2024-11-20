<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./styles/reset.css">
  <link rel="stylesheet" href="./styles/home.css">
  <link rel="stylesheet" href="./styles/cadastro.css">
  <title>Open Music</title>
</head>
<body>
  <header>
    <nav id="navbar">
      <h1 class="logo"><span>O</span>pen <span>M</span>usic</h1>
      <ul id="menu-navigation">
        <li>
          <a href='./index.php'>Home</a>
        </li>
        <li>
          <a href='./cadastro.php'>Cadastro</a>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <form action="" method="post">
      <h2 class="form-title">Login</h2>
      <label class="form-label" for="name">E-mail</label>
      <input class="form-input" type="email" placeholder="Digite seu e-mail">
      <label class="form-label" for="name">Senha</label>
      <input class="form-input" type="password" placeholder="Digite sua senha">
      <button class="form-btn" type="submit">Entrar</button>
    </form>
    <?php
      $connection = mysqli_connect('localhost', 'root', '', 'openmusic');
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $query = "SELECT * FROM users WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'";
      }
    ?>
  </main>
</body>
</html>