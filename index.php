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
          
          if(isset($_SESSION["username"])) {
            $icon = strtoupper(substr($_SESSION["username"], 0, 1));
            echo "
              <li class='user-box'>
                <h3>$_SESSION[username]</h3>
                <h3  class='user-icon'>
                  $icon
                </h3>
                <a href='./logout.php'>Logout</a>
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
        <?php
          $genres = get_music_genres($conn);

          echo "<li><button class='filter-btn selected'>Todos</button></li>";

          foreach ($genres as $genre) {
            echo "
              <li><button class='filter-btn'>$genre</button></li>
            ";
          }
        ?>
      </ul>
    </section>
    <section class="album-container">
      <h3 class="title">Albuns Encontrados</h3>
      <ul class="album-list">
        <?php
          // Busca todas as músicas
          $musics = get_all_musics($conn);

          function validate_cover($cover) {
            if ($cover == '') {
              return './assets/default-album-cover.png';
            }
            
            // Verifica se a imagem pode ser acessada
            if(@getimagesize($cover) === false) {
              return './assets/default-album-cover.png';
            };

            return $cover;
          }

          foreach ($musics as $music) {
            echo "
              <li class='album-card'>
                <img src='". validate_cover($music['cover']) ."' alt='Album cover'>
                <div class='album-info-container'>
                  <h4 class='album-title'>$music[title]</h4>
                  <div class='info-box'>
                    <p>$music[artist]</p>
                    <span class='album-genre'>$music[genre]</span>
                  </div>
                  <div class='price-box'>
                    <p>$music[price]</p>
                    <button class='buy-btn'>Comprar</button>
                  </div>
                </div>
              </li>
            ";
          }
        ?>
      </ul>
    </section>
  </main>
  <footer>
    <h3 class="logo"><span>O</span>pen <span>M</span>usic</h3>
    <p>Todos os direitos reservados &copy</p>
  </footer>
  <script>
    const buttons = document.querySelectorAll('.filter-btn');

    function filterAlbums(genre) {
      console.log(genre);
      // Obtém todos os itens da lista
      const albums = document.querySelectorAll('.album-card');

      // Caso o filtro seja para "todos", remove a classe 'hidden' de todos os álbuns
      if (genre.trim().toLowerCase() === 'todos') {
        albums.forEach(album => {
          album.classList.remove("hidden"); // Remove a classe 'hidden' de todos os álbuns
        });
        return; // Sai da função, pois não é necessário fazer mais nada
      }

      // Itera sobre cada item da lista
      albums.forEach(album => {
        const item = album.querySelector('.album-genre');

        // Compara o texto do gênero com o filtro
        if (item.textContent.trim().toLowerCase() !== genre.trim().toLowerCase()) {
          album.classList.add("hidden"); // Adiciona a classe 'hidden' no item da lista
        } else {
          album.classList.remove("hidden"); // Remove a classe 'hidden' para exibir o item
        }
      });
    }
    
    // Adiciona o evento de clique em cada botão
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove a classe 'selected' de todos os botões
            buttons.forEach(btn => btn.classList.remove('selected'));
            
            // Adiciona a classe 'selected' no botão clicado
            button.classList.add('selected');

            filterAlbums(button.textContent);
        });
    });

    
  </script>
</body>
</html>