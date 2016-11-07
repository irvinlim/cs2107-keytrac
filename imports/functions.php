<?php

function redirect($url) {
  header('Location: ' . $url);
  die();
}

function md5salt($string) {
  global $config;

  return md5($config['random_salt'] . $string);
}

function getDbRow($key, $value) {
  try {
    global $db;

    $stmt = $db->prepare("SELECT * FROM users WHERE :key = :value");
    $stmt->bindParam(":key", $key);
    $stmt->bindParam(":value", $value);
    $stmt->execute();

    $row = $stmt->fetch();

    return $row ?: null;
  } catch (PDOException $e) {
    die("PDO Error: <br><br><pre>" . $e->getMessage() . "</pre>");
  }
}