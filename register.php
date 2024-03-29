<?php
//ob_start();
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("login",$authenticator->getLogedin(),$authenticator->getRole());

$error = false;
$nameError = '';
$emailError = '';
$passError = '';

	if ( isset($_POST['btn-signup']) ) {
        $response = $_POST["g-recaptcha-response"];
        if(!captcha::checkresponce($response)){$error = true;$errTyp = "danger";
            $errMSG = "Incorrect Captcha";}

		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);

		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}

		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
            $db = dbrepo::getdbinstance();
            $emailuserid = $db->getUseridFromEmail($email);
            $db->closeDB();
			if($emailuserid){
				$error = true;
				$emailError = "Provided Email is already in use.";
			}
		}
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}

		// if there's no error, continue to signup
		if( !$error ) {
            try{
                $db = dbrepo::getdbinstance();
                $db->addUser($name,$pass,$email);
                $db->closeDB();
                $errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
            } 
            catch(Exception $e){
                $errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";
            }
		}
	}

?>
<div id="login-form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

    <div class="col-md-12">

        <div class="form-group">
            <h2 class="">Sign Up.</h2>
        </div>

        <div class="form-group">
            <hr />
        </div>

        <?php
        if ( isset($errMSG) ) {

            ?>
            <div class="form-group">
            <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
            </div>
            </div>
            <?php
        }
        ?>

        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="" />
            </div>
            <span class="text-danger"><?php echo $nameError; ?></span>
        </div>

        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="" />
            </div>
            <span class="text-danger"><?php echo $emailError; ?></span>
        </div>

        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
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
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
        </div>

        <div class="form-group">
            <hr />
        </div>

        <div class="form-group">
            <a href="login.php">Sign in Here...</a>
        </div>

    </div>

</form>
</div>

<?php 


output::pageend();?>