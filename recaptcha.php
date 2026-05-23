<?php
require_once __DIR__ . '/config.php';
$recaptchaSiteKey = get_recaptcha_site_key();
?>
<!DOCTYPE html>
 
<html>
 
<head>
 
    <meta charset="utf-8">
 
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>reCaptcha</title>
 
    <script src='https://www.google.com/recaptcha/api.js' async defer>
</script>
 
</head>
 
<body>
 
  <h1>Google reCaptcha Demo</h1>
 
    <form action="recaptcha.php" method="post">
 
      <input type="email" placeholder="Type your email" size="40"><br><br>
 
      <textarea name="comment" rows="8" cols="39"></textarea><br><br>
 
<?php if ($recaptchaSiteKey !== '') { ?>
<div class="g-recaptcha" data-type="image" data-sitekey="<?php echo htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>">
  
</div>
<?php } else { ?>
<p>reCAPTCHA is not configured. Set <code>RECAPTCHA_SITE_KEY</code> and <code>RECAPTCHA_SECRET_KEY</code>.</p>
<?php } ?>
 
 
      <input type="submit" name="submit" value="Post comment"><br><br>
 
 
    </form>
</body>
 
</html>

 
<?php
 
if(isset($_POST['submit'])){
 
      $captcha = $_POST['g-recaptcha-response'] ?? '';
        if(!$captcha){
 
          echo '<h2>Please check the the captcha form.</h2>';
 
          exit;
 
        }
        if (verify_recaptcha_response($captcha, $_SERVER['REMOTE_ADDR'] ?? '')) {
 
                echo '<h2>Thanks for posting comment!</h2>';
 
        }
         else {
 
                echo '<h2>reCaptcha verification failed.</h2>';
 
        }
  }
 
?>
