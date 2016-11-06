<?php

global $config;

if (!$config['mysql_host'] || !$config['mysql_user'] || !$config['mysql_pass'] || !$config['mysql_db'])
  die('No MySQL config details defined');
if (!$config['random_salt'] || strlen($config['random_salt']) <= 0)
  die('No random salt defined.');

// Setup PDO
try {
  global $db;

  $servername = $config['mysql_host'];
  $dbname = $config['mysql_db'];
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $config['mysql_user'], $config['mysql_pass']);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Set up table if it doesn't exist
  $result = $db->query("
    CREATE TABLE IF NOT EXISTS users
    ( email           VARCHAR(255),
      password        VARCHAR(255),
      mobile          INTEGER,
      security_qn_1   INTEGER,
      security_ans_1  VARCHAR(255),
      security_qn_2   INTEGER,
      security_ans_2  VARCHAR(255),
      keytrac_user_id VARCHAR(255),
      CONSTRAINT pk_email PRIMARY KEY (email) )
    ");
} catch(PDOException $e) {
  die("Error: " . $e->getMessage());
}