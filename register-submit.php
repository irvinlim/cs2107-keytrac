<?php

require('vendor/nategood/httpful/bootstrap.php');
require('config.php');

global $config;

function redirect($url) {
  header('Location: ' . $url);
  die();
}

// Check for config
if (!$config['keytrac_auth_token'])
  die('No KeyTrac auth_token defined');
if (!$config['mysql_host'] || !$config['mysql_user'] || !$config['mysql_pass'] || !$config['mysql_db'])
  die('No MySQL config details defined');
if (!$config['random_salt'] || strlen($config['random_salt']) <= 0)
  die('No random salt defined.');

// Setup PDO
try {
  $servername = $config['mysql_host'];
  $dbname = $config['mysql_db'];
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $config['mysql_user'], $config['mysql_pass']);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Set up table if it doesn't exist
  $result = $conn->query("
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

// Check for $_POST
$requiredFields = [
  'email', 'password', 'password2', 'mobile', 'security_qn_1', 'security_ans_1', 'security_qn_2', 'security_ans_2', 'keytrac_keystroke1', 'keytrac_keystroke2'
];

if (!$_POST) 
  redirect('index.php');

foreach ($requiredFields as $field) {
  if (!$_POST[$field] || strlen($_POST[$field]) <= 0)
    redirect('index.php');
  else 
    $_POST[$field] = trim($_POST[$field]);
}

if ($_POST['password'] != $_POST['password2'])
  redirect("register.php?error=Password%20mismatch%2E");

// Register new user
$registerResponse = \Httpful\Request::post("https://api.keytrac.net/users")
  ->addHeader('Authorization', $config['keytrac_auth_token'])
  ->send();

$keytracUserId = $registerResponse->body->id;
$keytracUserId = 'fc26cf1c-b2db-457c-977b-d2ffb63754cd'; // TEMP

if (!$keytracUserId)
  die("Could not register user. Server response is below.<br><br><pre>" . $registerResponse . "</pre>");

// Enrol the user
$enrolResponse = \Httpful\Request::post("https://api.keytrac.net/anytext/enrol")
  ->sendsJson()
  ->addHeader('Authorization', $config['keytrac_auth_token'])
  ->body(json_encode([
      'user_id' => $keytracUserId,
      'samples' => [
        $_POST['keytrac_keystroke1'],
        $_POST['keytrac_keystroke2'],
      ]
    ]))
  ->send();

if (!$enrolResponse->body->OK) 
  die("Could not enrol user. Server response is below.<br><br><pre>" . $enrolResponse . "</pre>");

// Save to database
try {
  $stmt = $conn->prepare(
    "INSERT INTO users (email, password, mobile, security_qn_1, security_ans_1, security_qn_2, security_ans_2, keytrac_user_id) 
     VALUES (:email, :password, :mobile, :security_qn_1, :security_ans_1, :security_qn_2, :security_ans_2, :keytrac_user_id)"
  );

  $stmt->bindParam(':email', $_POST['email']);
  $stmt->bindParam(':password', md5($config['random_salt'] . $_POST['password']));
  $stmt->bindParam(':mobile', intval($_POST['mobile']));
  $stmt->bindParam(':security_qn_1', intval($_POST['security_qn_1']));
  $stmt->bindParam(':security_ans_1', md5($config['random_salt'] . $_POST['security_ans_1']));
  $stmt->bindParam(':security_qn_2', intval($_POST['security_qn_2']));
  $stmt->bindParam(':security_ans_2', md5($config['random_salt'] . $_POST['security_ans_2']));
  $stmt->bindParam(':keytrac_user_id', $keytracUserId);
  $stmt->execute();
} catch (PDOException $e) {
  die("PDO Exception: " . $e->getMessage());
}

// Close connection.
$conn = null;

// Redirect to home.
redirect("index.php?registered=1");