<?php
$db_name = 'devs-book-mvc';
$db_host = 'db';
$db_user = 'devs-book-mvc-user';
$db_password = 'password';

try {
  $my_db_connection = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_password);
  echo "Connected successfully";
} catch (PDOException $e) {
  echo "ERROR: " . $e->getMessage();
  exit;
}

$my_db_connection->query("CREATE TABLE users (
  id INT AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  birthdate DATE NOT NULL,
  city VARCHAR(100),
  work VARCHAR(100),
  avatar VARCHAR(100),
  cover VARCHAR(100),
  token VARCHAR(255),
  PRIMARY KEY (id)
)");

$my_db_connection->query("CREATE TABLE user_relations (
  id INT AUTO_INCREMENT,
  user_from INT NOT NULL,
  user_to INT NOT NULL,
  PRIMARY KEY (id)
)");

$my_db_connection->query("CREATE TABLE posts (
  id INT AUTO_INCREMENT,
  id_user INT NOT NULL,
  type VARCHAR(20) NOT NULL,
  created_at DATETIME NOT NULL,
  body TEXT,
  PRIMARY KEY (id)
)");

$my_db_connection->query("CREATE TABLE posts_comments (
  id INT AUTO_INCREMENT,
  id_post INT NOT NULL,
  id_user INT NOT NULL,
  created_at DATETIME NOT NULL,
  body TEXT,
  PRIMARY KEY (id)
)");

$my_db_connection->query("CREATE TABLE posts_likes (
  id INT AUTO_INCREMENT,
  id_post INT NOT NULL,
  id_user INT NOT NULL,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id)
)");
