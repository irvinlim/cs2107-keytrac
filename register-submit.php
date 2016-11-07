<?php

require_once('imports/imports.php');
require('vendor/nategood/httpful/bootstrap.php');

global $config, $db;

// Check for API token
if (!$config['keytrac_auth_token'])
  die('No KeyTrac auth_token defined');

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


// Check email if already exists.
$existingUser = getRowByEmail($_POST['email']);

if ($existingUser)
  redirect("register.php?error=Email%20already%20exists%2E");


// Use existing user if not already enrolled
$existingUserCanBeUsed = false;
if ($config['keytrac_existing_user'] && !getRowByKeytracUserId($config['keytrac_existing_user']))
  $existingUserCanBeUsed = true;


// Register new user if we cannot use the existing user.
if (!$existingUserCanBeUsed) {
  $registerResponse = \Httpful\Request::post("https://api.keytrac.net/users")
    ->addHeader('Authorization', $config['keytrac_auth_token'])
    ->send();

  $keytracUserId = $registerResponse->body->id;
} else {
  $keytracUserId = $config['keytrac_existing_user'];
}

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
  global $db;

  $stmt = $db->prepare(
    "INSERT INTO users (email, password, mobile, security_qn_1, security_ans_1, security_qn_2, security_ans_2, keytrac_user_id) 
     VALUES (:email, :password, :mobile, :security_qn_1, :security_ans_1, :security_qn_2, :security_ans_2, :keytrac_user_id)"
  );

  $stmt->bindParam(':email', $_POST['email']);
  $stmt->bindParam(':password', md5salt($_POST['password']));
  $stmt->bindParam(':mobile', intval($_POST['mobile']));
  $stmt->bindParam(':security_qn_1', intval($_POST['security_qn_1']));
  $stmt->bindParam(':security_ans_1', md5salt($_POST['security_ans_1']));
  $stmt->bindParam(':security_qn_2', intval($_POST['security_qn_2']));
  $stmt->bindParam(':security_ans_2', md5salt($_POST['security_ans_2']));
  $stmt->bindParam(':keytrac_user_id', $keytracUserId);
  $stmt->execute();
} catch (PDOException $e) {
  die("PDO Exception: " . $e->getMessage());
}

// Close connection.
$db = null;

// Redirect to home.
redirect("index.php?registered=1");