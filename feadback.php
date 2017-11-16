<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("feadback",$authenticator->getLogedin(),$authenticator->getRole());
?>
<h4>Leave feadback:</h4>
<form role="form" action="feedbackSubmit.php" method = "post">
  <div class="form-group">
    <textarea class="form-control" rows="6" name="feedback" required></textarea>
  </div>
  <div class="captcha_wrapper">
					<div class="g-recaptcha" data-sitekey="6Lfu_DgUAAAAAFSmpIZaudHNfZlJDq5GbHBa5Ofz"></div>
		</div>
  <button type="submit" class="btn btn-success" name="submit">Submit</button>
</form>
<?php

output::pageend();