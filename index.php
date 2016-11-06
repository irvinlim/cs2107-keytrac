<?php include("header.php") ?>

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
      <div class="row align-center">
        <div class="columns large-12" style="text-align: center;">
          <h3>Login to your AmazingWebServices console</h3>
          <p>This is a demo website to demonstrate how 3FA using keystroke biometrics can be implemented on an online service.</p>
        </div>
      </div>

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

<script type="text/javascript">
function onSubmit() {
  alert("Unfortunately, AmazingWebServices isn't that amazing after all. You have forgotten your password, please go and reset your password.");
  return false;
}
</script>

<?php include("footer.php") ?>