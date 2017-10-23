<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("feadback",$authenticator->getLogedin(),$authenticator->getRole());
?>
<h4>Leave feadback:</h4>
<form role="form">
  <div class="form-group">
    <textarea class="form-control" rows="6" required></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>
<?php

output::pageend();