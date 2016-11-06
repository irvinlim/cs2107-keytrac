<?php include("header.php") ?>

<div class="row">
  <div class="large-12 columns">

    <p style="text-align: left;"><a href="index.php">&laquo; Back to home</a></p>

    <?php if ($_GET['error']) : ?>
      <div class="callout warning" style="text-align: center;">
        <?=filter_var($_GET['error'], FILTER_SANITIZE_STRING)?>
      </div>
    <?php endif; ?>

    <div class="callout">
      <div class="row align-center">
        <div class="columns" style="text-align: center;">
          <h3>Forgot Password</h3>
          <p>Don't worry, it happens to all of us.</p>
        </div>
      </div>
      
      <div class="row align-center">
        <div class="columns medium-10 large-8">
          <form action="forgot2.php" method="post" onsubmit="onSubmit()">
            <div class="row align-justify">
              <div class="large-12 columns">
                <label>Enter your email</label>
                <input type="text" name="email" required />
              </div>
            </div>
            <div class="row align-right">
              <div class="large-12 columns" style="text-align: right;">
                <button type="submit" class="button">Next</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("footer.php") ?>