<?php

function redirect($url) {
  header('Location: ' . $url);
  die();
}

function md5salt($string) {
  global $config;

  return md5($config['random_salt'] . $string);
}

function getRowByEmail($email) {
  try {
    global $db;

    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $row = $stmt->fetch();

    return $row;
  } catch (PDOException $e) {
    die("PDO Error: <br><br><pre>" . $e->getMessage() . "</pre>");
  }
}

function getRowByKeytracUserId($keytracUserId) {
  try {
    global $db;

    $stmt = $db->prepare("SELECT * FROM users WHERE keytrac_user_id = :keytracUserId");
    $stmt->bindParam(":keytracUserId", $keytracUserId);
    $stmt->execute();

    $row = $stmt->fetch();

    return $row;
  } catch (PDOException $e) {
    die("PDO Error: <br><br><pre>" . $e->getMessage() . "</pre>");
  }
}