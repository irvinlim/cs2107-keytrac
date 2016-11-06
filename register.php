<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
    <link rel="stylesheet" href="assets/css/foundation.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
  </head>
  <body>
    <div class="container">
      <div class="header row">
        <div class="large-12 columns">
          <img src="assets/images/logo.png" width="200" alt="">
        </div>
      </div>

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
                        <option value="1">What is the first and last name of your first boyfriend or girlfriend?</option>
                        <option value="2">Which phone number do you remember most from your childhood?</option>
                        <option value="3">What was your favorite place to visit as a child?</option>
                        <option value="4">Who is your favorite actor, musician, or artist?</option>
                        <option value="5">What is your favorite movie?</option>
                        <option value="6">What was the make of your second car?</option>
                      </select>
                      <input type="text" name="security_ans_1" placeholder="Your answer..." />
                    </div>
                    <div class="large-12 columns">
                      <label>Security Question 2</label>
                      <select name="security_qn_2" id="security_qn_2" required>
                        <option>Choose a security question...</option>
                        <option value="1">What is the last name of the teacher who gave you your first failing grade?</option>
                        <option value="2">What was the name of the boy/girl you had your second kiss with?</option>
                        <option value="3">Where were you when you had your first alcoholic drink (or cigarette)?</option>
                        <option value="4">Where were you when you had your first kiss?</option>
                        <option value="5">What was the name of your second pet?</option>
                        <option value="6">What was the name of your elementary school?</option>
                      </select>
                      <input type="text" name="security_ans_2" placeholder="Your answer..." />
                    </div>
                  </div>
                  <div class="row align-justify">
                    <div class="large-12 columns">
                      <h4>Keystroke Biometrics</h4>
                      <p>Please enter the following text in the text box below. We will be recording your keystroke patterns only in the following box in order to secure your account further.</p>
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
    </div>

<script type="text/javascript" src="https://api.keytrac.net/keytrac.js"></script>
<script type="text/javascript">
KeyTrac.configure({
  anytextFields: ['#keystroke1', '#keystroke2']
});
</script>

  </body>
</html>
