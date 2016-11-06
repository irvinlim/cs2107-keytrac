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

      <?php if ($_GET['registered']) : ?>
        <div class="row">
          <div class="large-12 columns">
            <div class="callout secondary">
              <p>Successfully registered!</p>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="large-12 columns">
          <div class="callout success">
            <h5>DEMO NOTE</h5>
            <p>
              For the 3FA demo, please click <strong>"sign up"</strong> to register an account to register your details, 
              followed by <strong>"forgot your password"</strong> to verify your identity.
            </p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <div class="callout">
            <h3>Login to your AmazingWebServices console</h3>
            
            <div class="row align-center">
              <div class="columns large-6">
                <form action="index.php" method="post" onsubmit="onSubmit()">
                  <div class="row align-justify">
                    <div class="large-12 columns">
                      <label>Email</label>
                      <input type="text" name="email" />
                    </div>
                  </div>
                  <div class="row align-justify">
                    <div class="large-12 columns">
                      <label>Password</label>
                      <input type="password" name="password" />
                    </div>
                  </div>
                  <div class="row align-justify align-middle">
                    <div class="large-6 columns">
                      <button type="submit" class="button">Login</button>
                    </div>
                    <div class="large-6 columns">
                      <div style="text-align: right; font-size: 14px;">
                        <a href="register.php">Sign up today!</a><br>
                        <a href="forgot.php">Forgot your password?</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">
function onSubmit() {
  alert("Unfortunately, AmazingWebServices isn't that amazing after all. You have forgotten your password, please go and reset your password.");
  return false;
}
</script>
  </body>
</html>
