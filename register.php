<?php 
require_once("imports/imports.php");
include("header.php");

global $security_questions; ?>

<div class="row">
  <div class="large-12 columns">
    <div class="callout success">
      <h5>DEMO NOTE</h5>
      <p>Typically, the sign up form should not be so long (principle of psychological acceptability), but for the purposes of this demo, we enforce all three factors of verification at this step.</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="large-12 columns">

    <p style="text-align: left;"><a href="index.php">&laquo; Back to home</a></p>

    <div class="callout">
      <div class="row align-center">
        <div class="columns" style="text-align: center;">
          <h3>Register for AmazingWebServices</h3>
          <p>Thank you for choosing AmazingWebServices. We promise you that we are amazing!</p>
        </div>
      </div>
      
      <div class="row align-center">
        <div class="columns medium-10 large-8">
          <form action="register-submit.php" method="post" onsubmit="onSubmit()">
            <div class="row align-justify">
              <div class="large-12 columns">
                <label>Email</label>
                <input type="text" name="email" required />
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <label>Password</label>
                <input type="password" name="password" required />
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <label>Password Again</label>
                <input type="password" name="password2" required />
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <h4>Account Security</h4>
                <p>For added security, please complete the rest of the form below.</p>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <label>Mobile Number</label>
                <input type="text" name="mobile" placeholder="Mobile number" required />
                <p class="help-text">Your mobile will be used to send OTPs as a secondary method of authentication.<br><strong>DEMO NOTE:</strong> We will not be demonstrating SMS OTP verification in this demo.</p>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <label>Security Question 1</label>
                <select name="security_qn_1" id="security_qn_1" required>
                  <option>Choose a security question...</option>
                  <?php foreach ($security_questions[0] as $key => $qn) : ?>
                    <option value="<?=$key?>"><?=$qn?></option>
                  <?php endforeach; ?>
                </select>
                <input type="text" name="security_ans_1" placeholder="Your answer..." />
              </div>
              <div class="large-12 columns">
                <label>Security Question 2</label>
                <select name="security_qn_2" id="security_qn_2" required>
                  <option>Choose a security question...</option>
                  <?php foreach ($security_questions[1] as $key => $qn) : ?>
                    <option value="<?=$key?>"><?=$qn?></option>
                  <?php endforeach; ?>
                </select>
                <input type="text" name="security_ans_2" placeholder="Your answer..." />
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <h4>Keystroke Biometrics</h4>
                <p>Please enter the following text in the text box below as how you would normally type. We will be recording your keystroke patterns only in the following box in order to secure your account further.</p>
                <p>Your keystrokes will be used as a challenge in the event you have forgotten your password.</p>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <div class="callout secondary untyped">
                  <p>The blue and white room was bright with sunlight. Outside the sky was blue and the leaves were rustling in a stiff breeze.</p>
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
                  <p>Darcy only smiled; and the general pause which ensued made Elizabeth tremble lest her mother should be exposing herself again.</p>
                </div>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <textarea name="keystroke2" id="keystroke2" placeholder="Please enter the text above..." rows="4"></textarea>
              </div>
            </div>
            <div class="row align-justify">
              <div class="large-12 columns">
                <button type="submit" class="button">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://api.keytrac.net/keytrac.js"></script>
<script type="text/javascript">
KeyTrac.configure({
  anytextFields: ['#keystroke1', '#keystroke2']
});
</script>

<?php include("footer.php") ?>
