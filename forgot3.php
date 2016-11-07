<?php

require('vendor/nategood/httpful/bootstrap.php');
require_once("imports/imports.php");

$requiredFields = [
  'email', 'security_ans_1', 'security_ans_2', 'keytrac_keystroke1', 'keytrac_keystroke2'
];

if (!$_POST) 
  redirect('forgot.php');

foreach ($requiredFields as $field) {
  if (!$_POST[$field] || strlen($_POST[$field]) <= 0)
    redirect('forgot.php');
  else 
    $_POST[$field] = trim($_POST[$field]);
}

$user = getRowByEmail($_POST['email']);

if (!$user) 
  redirect("forgot.php?error=Invalid%20user%2E");


// Verify security questions
$isUserSecurityQuestionsCorrect = true;

if (md5salt($_POST['security_ans_1']) != $user['security_ans_1'] || md5salt($_POST['security_ans_2']) != $user['security_ans_2'])
  $isUserSecurityQuestionsCorrect = false;


// Verify keystrokes
$authResponse = \Httpful\Request::post("https://api.keytrac.net/anytext/authenticate")
  ->sendsJson()
  ->addHeader('Authorization', $config['keytrac_auth_token'])
  ->body(json_encode([
      'user_id' => $user['keytrac_user_id'],
      'samples' => [
        $_POST['keytrac_keystroke1'],
        $_POST['keytrac_keystroke2'],
      ]
    ]))
  ->send();

if (!isset($authResponse->body->authenticated))
  die("Could not authenticate user. Server response is below.<br><br><pre>" . $authResponse . "</pre>");

$isUserKeytracVerified = $authResponse->body->authenticated;
$keytracScore = $authResponse->body->score;

include("header.php");
?>

<div class="row">
  <div class="large-12 columns">

    <p style="text-align: left;"><a href="index.php">&laquo; Back to home</a></p>

    <div class="callout">
      <div class="row align-center">
        <div class="columns" style="text-align: center;">
          <h3>Forgot Password</h3>
          <p>Don't worry, it happens to all of us.</p>
        </div>
      </div>
    </div>

    <div class="callout">
      <div class="row align-center">
        <div class="columns medium-10 large-8">
          
          <div class="row align-justify">
            <div class="large-12 columns" style="text-align: center;">
              <p>Security Questions: 
                <?php if ($isUserSecurityQuestionsCorrect) : ?>
                  <span class="success label">Correct</span>
                <?php else : ?>
                  <span class="alert label">Incorrect</span>
                <?php endif; ?>
              </p>

              <p>Keystroke Verification: 
                <?php if ($isUserKeytracVerified) : ?>
                  <span class="success label"><?=$keytracScore?>% Match</span>
                <?php else : ?>
                  <span class="alert label"><?=$keytracScore?>% Match</span>
                <?php endif; ?>
              </p>

              <?php if ($isUserKeytracVerified && $isUserSecurityQuestionsCorrect) : ?>
                <p>Your can now reset your password! How amazing!</p>
              <?php else : ?>
                <p>We could not verify your identity. <a href="forgot.php">Try again?</a></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include("footer.php") ?>