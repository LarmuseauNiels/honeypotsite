<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
$userid=$authenticator->getUserid();
$db = dbrepo::getdbinstance();
$username=$db->getUserFromID($userid)->username;
output::navigation("loggin",$authenticator->getLogedin(),$authenticator->getRole());

$pictureExists=$db->getPictureForUser($userid);
if(isset($pictureExists->filepath))
{
    //getPhotoPth from database
    $profilePicturePath=$pictureExists->filepath;
}
else
{
    //give defaultpicture
    $profilePicturePath="assets/images/default-user-image.png";

}

viewProfileHead($username,$profilePicturePath);
viewBodyProfile();

function viewProfileHead($username,$profilePicturePath)
{


   echo "<div id = 'profileHead' >";
   echo         "<figure >";
   echo             "<a href = '#' id = 'profilePicture' ><img id = 'profileImg' src = '".$profilePicturePath."' >";
   echo                 "<img id = 'changeImgIcon' src = 'assets/images/switch-camera-256.png' ></a >";
   echo             "<form action = 'upload.php' method = 'POST' enctype = 'multipart/form-data' id = 'upload' class='hide' >";
   echo                 "<input type = 'file' name = 'file' accept = 'file_extension|image/*' >";
   echo                 "<button type = 'submit' name = 'submit' id = 'uploadbtn' > upload</button >";
   echo             "</form >";
   echo             "<figcaption >".$username."</figcaption >";
   echo         "</figure >";
   echo     "</div >";

}


function viewBodyProfile()
{
    ?>
    <div id="commentBox">
        <form role="form" method="POST" action="proceedmessage.php">
            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Comment profile</button>
        </form>
        <br><br>
        <p><span class="badge">3</span> Messages:</p><br>
        <div class="row">
            <div>
                <div class="col-sm-2 text-center">
                    <img src="https://i.imgur.com/0W49c50.png" class="img-circle" height="65" width="65" alt="Avatar">
                </div>
                <div class="col-sm-10">
                    <h4>Niels <small>Sep 29, 2017, 9:12 PM</small></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <br>
                </div>
            </div>
            <div class="col-sm-2 text-center">
                <img src="https://i.imgur.com/qWoHxMv.jpg" class="img-circle" height="65" width="65" alt="Avatar">
            </div>
            <div class="col-sm-10">
                <h4>John <small>Sep 25, 2017, 8:25 PM</small></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <br>
            </div>
            <div class="col-sm-2 text-center">
                <img src="https://i.imgur.com/qWoHxMv.jpg" class="img-circle" height="65" width="65" alt="Avatar">
            </div>
            <div class="col-sm-10">
                <h4>John 2 <small>Sep 25, 2017, 8:25 PM</small></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <br>
            </div>

        </div>
    </div>


    <?php
}


output::pageend();