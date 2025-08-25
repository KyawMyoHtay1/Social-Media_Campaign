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
 
<div class="g-recaptcha" data-type="image"  data-sitekey="6Lc-JTAqAAAAAHogDYj3LxhKYQmd5alBCqE9oABZ">
  
</div>
 
 
      <input type="submit" name="submit" value="Post comment"><br><br>
 
 
    </form>
</body>
 
</html>

 
<?php
 
if(isset($_POST['submit'])){
 
      if(isset($_POST['g-recaptcha-response'])){
 
          $captcha=$_POST['g-recaptcha-response'];
 
      }
        if(!$captcha){
 
          echo '<h2>Please check the the captcha form.</h2>';
 
          exit;
 
        }
        $secretKey = "6Lc-JTAqAAAAADJG-2adT-JvQ-N0vG4Cwh20DP31";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
 
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
 
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
 
        if($responseKeys["success"]) {
 
                echo '<h2>Thanks for posting comment!</h2>';
 
        }
         else {
 
                echo '<h2>reCaptcha verification failed.</h2>';
 
        }
  }
 
?>