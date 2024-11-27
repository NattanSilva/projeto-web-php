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
      <input required class="form-input" name="email" id="email" type="email" placeholder="Digite seu e-mail">
      <label class="form-label" for="name">Senha</label>
      <input required class="form-input" name="password" id="password" type="password" placeholder="Digite sua senha">
      <button class="form-btn" type="submit">Entrar</button>
    </form>
    <?php
      require_once 'database.php';
      $conn = mysqli_connect('localhost', 'root', '', 'openmusic');

      if (!$conn) {
        echo "<script>console.log('Connection failed: $conn->connect_error')</script>";
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(validate_email_password($conn, $_POST['email'], $_POST['password'])){
          session_start();
          $user_data = json_encode(get_user_data($conn, $_POST['email']));
          $_SESSION["status"] = "logged";
          $_SESSION['username'] = json_decode($user_data, true)["name"];
          $_SESSION['email'] = json_decode($user_data, true)["email"];
          header('Location: ./index.php');
        }
      }
    ?>
  </main>
</body>
</html>