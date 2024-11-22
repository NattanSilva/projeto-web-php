<?php
  function seed_music_table($conn) {
    // Array de músicas a serem inseridas
    $musics = [
        ['Agora Vai', 'Novos Baianos', 'Agora Vai', 'MPB', 2020, '', 19.99],
        ['O Sol', 'Jorge Ben Jor', 'O Sol', 'Samba', 2018, '', 15.99],
        ['Chega de Saudade', 'João Gilberto', 'Chega de Saudade', 'Bossa Nova', 1959, '', 17.50],
        ['Aquarela do Brasil', 'Ary Barroso', 'Aquarela do Brasil', 'Samba', 1947, '', 14.80],
        ['Mas Que Nada', 'Sergio Mendes', 'Mas Que Nada', 'Bossa Nova', 1963, '', 16.99],
        ['Sampa', 'Caetano Veloso', 'Sampa', 'MPB', 1982, '', 18.50],
        ['Lanterna dos Afogados', 'Os Paralamas do Sucesso', 'Lanterna dos Afogados', 'Rock', 1991, '', 20.00],
        ['Meu Abrigo', 'Melim', 'Meu Abrigo', 'Pop', 2019, '', 17.30],
        ['Deixa', 'Lagum', 'Deixa', 'Pop', 2020, '', 16.40],
        ['O Leãozinho', 'Caetano Veloso', 'O Leãozinho', 'MPB', 1977, '', 18.20],
    ];

    foreach ($musics as $music) {
        // SQL para verificar se o registro já existe antes de inserir
        $sql = "
        INSERT INTO musics (title, artist, album, genre, year, cover, price)
        SELECT ?, ?, ?, ?, ?, ?, ? 
        WHERE NOT EXISTS (
            SELECT 1 FROM musics WHERE title = ? AND artist = ? AND album = ? AND year = ?
        )";

        // Preparar a query
        $stmt = $conn->prepare($sql);

        // Passar os parâmetros corretamente: 7 para a inserção e 4 para a verificação WHERE
        $stmt->bind_param(
            'ssssdsdssss', // Tipos de dados dos parâmetros
            $music[0], $music[1], $music[2], $music[3], $music[4], $music[5], $music[6], 
            $music[0], $music[1], $music[2], $music[4] // Para a condição WHERE
        );

        // Executar a query
        if ($stmt->execute()) {
            echo "<script>console.log('Music '{$music[0]}' inserted successfully')</script>";
        } else {
            echo "<script>console.log('Music '{$music[0]}' already exists or error: " . $stmt->error . "')</script>";
        }
    }
  }




  function create_user_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS users (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(200) NOT NULL,
      email VARCHAR(200) NOT NULL,
      password VARCHAR(30) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
      echo "<script>console.log('User Table created successfully')</script>";
    } else {
      echo "<script>console.log('Error creating User table: $conn->error')</script>";
    }
  }

  function create_music_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS musics (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      title VARCHAR(200) NOT NULL,
      artist VARCHAR(200) NOT NULL,
      album VARCHAR(200) NOT NULL,
      genre VARCHAR(200) NOT NULL,
      year INT(4) NOT NULL,
      cover VARCHAR(250) NOT NULL,
      price DECIMAL(10, 2)
    )";

    if ($conn->query($sql) === TRUE) {
      echo "<script>console.log('Music Table created successfully')</script>";
      seed_music_table($conn);
    } else {
      echo "<script>console.log('Error creating Music table: $conn->error')</script>";
    }
  }

  function validate_unique_email($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = '$email'";

    if ($conn->query($sql)->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }

  function validate_email_password($conn, $email, $password) {
    // Consulta SQL com placeholders
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    
    // Prepara a consulta
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
      die("Erro ao preparar a consulta: " . $conn->error);
    }

    // Vincula os parâmetros à consulta
    $stmt->bind_param("ss", $email, $password);

    // Executa a consulta
    $stmt->execute();

    // Obtém o resultado
    $result = $stmt->get_result();

    // Verifica se há registros correspondentes
    if ($result->num_rows > 0) {
        return true; // Usuário encontrado
    } else {
        return false; // Nenhum usuário encontrado
    }
  }


  function get_user_data($conn, $email) {
    // Consulta SQL usando prepared statements
    $sql = "SELECT name, email FROM users WHERE email = ?";
    
    // Prepara a consulta
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    // Vincula o parâmetro
    $stmt->bind_param("s", $email);

    // Executa a consulta
    $stmt->execute();

    // Obtém o resultado
    $result = $stmt->get_result();

    // Verifica se há resultados
    if ($result->num_rows > 0) {
        // Retorna o primeiro registro como array associativo
        return $result->fetch_assoc();
    } else {
        return null; // Nenhum usuário encontrado
    }
  }

  function get_all_musics($conn) {
    $sql = "SELECT * FROM musics";
    $result = $conn->query($sql);
    return $result;
  }

  function get_music_genres($conn) {
    $sql = "SELECT DISTINCT TRIM(LOWER(genre)) AS genre FROM musics";
    $result = $conn->query($sql);
    
    if ($result === false) {
      die("Erro na consulta: " . $conn->error);
    }

    $genres = [];
    
    while ($row = $result->fetch_assoc()) {
      $genre = ucfirst(strtolower($row['genre']));
      $genres[] = $genre;
    }

    return $genres;
  }
  
?>