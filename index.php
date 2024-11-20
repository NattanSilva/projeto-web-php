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
  <title>Open Music</title>
</head>
<body>
  <?php
    require_once 'database.php';

    $conn = mysqli_connect('localhost', 'root', '', 'openmusic');

    if (!$conn) {
      echo "<script>console.log('Connection failed: $conn->connect_error')</script>";
    }

    create_user_table($conn);
    create_music_table($conn);
  ?>
  <header>
    <nav id="navbar">
      <h1 class="logo"><span>O</span>pen <span>M</span>usic</h1>
      <ul id="menu-navigation">
        <?php
          session_start();
          $icon = strtoupper(substr($_SESSION["username"], 0, 1));
          
          if($_SESSION["status"] == "logged") {
            echo "
              <li class='user-box'>
                <h3>$_SESSION[username]</h3>
                <h3  class='user-icon'>
                  $icon
                </h3>
              </li>
            ";
          } else {
            echo "
              <li>
                <a href='./cadastro.php'>Cadastro</a>
              </li>
              <li>
                <a href='./login.php'>Login</a>
              </li>
            ";
          }
        ?>
      </ul>
    </nav>
  </header>
  <main class="main-container">
    <section class="filter-container">
      <h3 class="title">Gênero Musical</h3>
      <ul>
        <li><button class="filter-btn selected">Todos</button></li>
        <li><button class="filter-btn">Pop</button></li>
        <li><button class="filter-btn">MPB</button></li>
        <li><button class="filter-btn">Forró</button></li>
        <li><button class="filter-btn">Samba</button></li>
      </ul>
    </section>
    <section class="album-container">
      <h3 class="title">Albuns Encontrados</h3>
      <ul class="album-list">
        <li class="album-card">
          <img src="./assets/cover-1.png" alt="Album cover">
          <div class="album-info-container">
            <h4 class="album-title">Acabou o Chorare</h4>
            <div class="info-box">
              <p>Novos Baianos</p>
              <span>MPB</span>
            </div>
            <div class="price-box">
              <p>R$137,91</p>
              <button class="buy-btn">Comprar</button>
            </div>
          </div>
        </li>
        <li class="album-card">
          <img src="./assets/cover-1.png" alt="Album cover">
          <div class="album-info-container">
            <h4 class="album-title">Acabou o Chorare</h4>
            <div class="info-box">
              <p>Novos Baianos</p>
              <span>MPB</span>
            </div>
            <div class="price-box">
              <p>R$137,91</p>
              <button class="buy-btn">Comprar</button>
            </div>
          </div>
        </li>
        <li class="album-card">
          <img src="./assets/cover-1.png" alt="Album cover">
          <div class="album-info-container">
            <h4 class="album-title">Acabou o Chorare</h4>
            <div class="info-box">
              <p>Novos Baianos</p>
              <span>MPB</span>
            </div>
            <div class="price-box">
              <p>R$137,91</p>
              <button class="buy-btn">Comprar</button>
            </div>
          </div>
        </li>
        <li class="album-card">
          <img src="./assets/cover-1.png" alt="Album cover">
          <div class="album-info-container">
            <h4 class="album-title">Acabou o Chorare</h4>
            <div class="info-box">
              <p>Novos Baianos</p>
              <span>MPB</span>
            </div>
            <div class="price-box">
              <p>R$137,91</p>
              <button class="buy-btn">Comprar</button>
            </div>
          </div>
        </li>
        <li class="album-card">
          <img src="./assets/cover-1.png" alt="Album cover">
          <div class="album-info-container">
            <h4 class="album-title">Acabou o Chorare</h4>
            <div class="info-box">
              <p>Novos Baianos</p>
              <span>MPB</span>
            </div>
            <div class="price-box">
              <p>R$137,91</p>
              <button class="buy-btn">Comprar</button>
            </div>
          </div>
        </li>
        <li class="album-card">
          <img src="./assets/cover-1.png" alt="Album cover">
          <div class="album-info-container">
            <h4 class="album-title">Acabou o Chorare</h4>
            <div class="info-box">
              <p>Novos Baianos</p>
              <span>MPB</span>
            </div>
            <div class="price-box">
              <p>R$137,91</p>
              <button class="buy-btn">Comprar</button>
            </div>
          </div>
        </li>
      </ul>
    </section>
  </main>
  <footer>
    <h3 class="logo"><span>O</span>pen <span>M</span>usic</h3>
    <p>Todos os direitos reservados &copy</p>
  </footer>
</body>
</html>