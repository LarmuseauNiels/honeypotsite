<?php
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("login",$authenticator->getLogedin(),$authenticator->getRole());
?>
<div class="row">
    <div class="col-sm-6">
        <div class="">
        <form class="form-signin clearfix">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="">Username</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
            <label for="inputPassword" class="">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
        </div> 
    </div>
    <div class="col-sm-6">
        <div class="">
        <form class="form-register clearfix">
            <h2 class="form-register-heading">Register</h2>
            <label for="inputEmail" class="">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputEmail" class="">Username</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
            <label for="inputPassword" class="">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
        </div>
    </div>
</div>
<?php
output::pageend();