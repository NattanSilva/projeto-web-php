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
          <a href='./login.php'>Login</a>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <form action="" method="post">
      <h2 class="form-title">Cadastro</h2>
      <label class="form-label" for="name">Nome Completo</label>
      <input required minLength="5" class="form-input" type="text" name="name" id="name" placeholder="Digite seu nome completo">
      <label class="form-label" for="email">E-mail</label>
      <input required class="form-input" type="email" name="email" id="email" placeholder="Digite seu e-mail">
      <label class="form-label" for="password">Senha</label>
      <input required minLength="8" class="form-input" type="password" name="password" id="password" placeholder="Digite sua senha">
      <button class="form-btn" type="submit">Cadastrar</button>
    </form>
    <?php
      $connection = mysqli_connect('localhost', 'root', '', 'openmusic');
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $query = "INSERT INTO users (name, email, password) VALUES ('{$_POST['name']}', '{$_POST['email']}', '{$_POST['password']}')";
        $result = mysqli_query($connection, $query);
        header('Location: ./login.php');
      }
    ?>
  </main>
</body>
</html>