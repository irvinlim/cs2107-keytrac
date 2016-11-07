<?php

require_once("imports/imports.php");

if (!$_POST['email'] || strlen($_POST['email']) <= 0)
  redirect("index.php");

$user = getRowByEmail($_POST['email']);

if (!$user) 
  redirect("forgot.php?error=Invalid%20user%2E");

include("header.php");

global $security_questions;
?>

<div class="row">
  <div class="large-12 columns">

    <p style="text-align: left;"><a href="index.php">&laquo; Back to home</a></p>

    <form action="forgot3.php" method="post" onsubmit="onSubmit()">

      <input type="hidden" name="email" value="<?=$user['email']?>">

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
              <div class="large-12 columns">
                <h4>Security Questions</h4>
                <p>First line of defense: What you know</p>
              </div>
            </div>
            <div class="row align-justify">
              <div class="small-12 columns">
                <label><?=$security_questions[0][$user['security_qn_1']]?></label>
                <input type="text" name="security_ans_1" placeholder="Your answer..." />
              </div>
              <div class="small-12 columns">
                <label><?=$security_questions[1][$user['security_qn_2']]?></label>
                <input type="text" name="security_ans_2" placeholder="Your answer..." />
              </div>
            </div>
          </div>
        </div>
      </div>
        
      <div class="callout">
        <div class="row align-center">
          <div class="columns medium-10 large-8">
            
            <div class="row align-justify">
              <div class="large-12 columns">
                <h4>One-Time Password</h4>
                <p>Second line of defense: What you have</p>
              </div>
            </div>
            <div class="row align-justify">
              <div class="small-12 columns">
                <label>Please enter the one-time password sent to your phone.</label>
                <input type="text" id="sms_otp" name="sms_otp" />
                <p class="help-text">NOTE: Click "Send OTP" to automatically populate this field for the purposes of this demo.</p>
              </div>
              <div class="small-12 columns">
                <button type="button" class="button" onClick="otpOnClick()">Send OTP</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
      function otpOnClick() {
        document.getElementById("sms_otp").value = '123456';
      }
      </script>

      <div class="callout">
        <div class="row align-center">
          <div class="columns medium-10 large-8">
            <div class="row align-justify">
              <div class="large-12 columns">
                <h4>Keystroke Biometrics</h4>
                <p>Third line of defense: What you are</p>
                <hr>
                <p>Your keystrokes recorded earlier in the registration will be used to verify against your identity using the KeyTrac API. A 70% match or higher is sufficient to prove that you are the same person.</p>
                <p>Please key in the text below as how you normally type.</p>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <div class="callout secondary untyped">
                  <p>She had a sister married to a Mr. Phillips, who had been a clerk to their father and succeeded him in the business.</p>
                </div>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <textarea name="keystroke1" id="keystroke1" placeholder="Please enter the text above..." rows="4"></textarea>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <div class="callout secondary untyped">
                  <p>All the time he lived with us the captain made no change whatever in his dress but to buy some stockings from a hawker.</p>
                </div>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <textarea name="keystroke2" id="keystroke2" placeholder="Please enter the text above..." rows="4"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row align-center">
        <div class="columns medium-10 large-8">
          <button type="submit" class="button" style="width: 100%; margin: 20px 0;">Submit</button>
        </div>
      </div>

    </form>
  </div>
</div>

<script type="text/javascript" src="https://api.keytrac.net/keytrac.js"></script>
<script type="text/javascript">
KeyTrac.configure({
  anytextFields: ['#keystroke1', '#keystroke2']
});
</script>

<?php include("footer.php") ?>