<?php
  function create_user_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS users (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(200) NOT NULL,
      email VARCHAR(200) NOT NULL,
      password VARCHAR(30) NOT NULL
    )";
  }

  function create_music_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS music (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      title VARCHAR(200) NOT NULL,
      artist VARCHAR(200) NOT NULL,
      album VARCHAR(200) NOT NULL,
      genre VARCHAR(200) NOT NULL,
      year INT(4) NOT NULL,
      cover VARCHAR(250) NOT NULL
    )";
  }
  
?>