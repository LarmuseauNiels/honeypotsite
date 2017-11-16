<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("login",$authenticator->getLogedin(),$authenticator->getRole());

$error = false;
$emailError = '';
$passError = '';
$errMSG = null;




if( isset($_POST['btn-login']) ) {

	$response = $_POST["g-recaptcha-response"];
	
	if(!captcha::checkresponce($response)){$error = true;$errMSG = "Wrong Captcha";}
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}

		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}

		// if there's no error, continue to login
		if (!$error) {
            $authenticator->login($email,$pass);
            $userid = $authenticator->getUserid();
			if( $userid == null ) {
                $errMSG = "Incorrect Credentials, Try again...";
			} else {
				header("Location: chat.php");
			}

        }
	
}

?>

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

    	<div class="col-md-12">

        	<div class="form-group">
            	<h2 class="">Sign In.</h2>
            </div>

        	<div class="form-group">
            	<hr />
            </div>

            <?php
			if ( $errMSG != null) {

				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Your Email" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>

            <div class="form-group">
            	<hr />
				<div class="captcha_wrapper">
					<div class="g-recaptcha" data-sitekey="6Lfu_DgUAAAAAFSmpIZaudHNfZlJDq5GbHBa5Ofz"></div>
				</div>
            </div>

            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>

            <div class="form-group">
            	<hr />
            </div>

            <div class="form-group">
            	<a href="register.php">Sign Up Here...</a>
            </div>

        </div>

    </form>
    </div>

<?php 
output::pageend();?>

