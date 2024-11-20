<?php
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

  
?>