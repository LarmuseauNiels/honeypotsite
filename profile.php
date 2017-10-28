<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
$userid=$authenticator->getUserid();
$db = dbrepo::getdbinstance();
output::navigation("loggin",$authenticator->getLogedin(),$authenticator->getRole());

if (isset($_GET['id'])) {
    $curprofileid = $_GET['id'];
    if($db->getUserFromID($curprofileid) == null){$curprofileid = $userid;}
}else{
    $curprofileid = $userid;
}
$username=$db->getUserFromID($curprofileid)->username;

$pictureExists=$db->getPictureForUser($curprofileid);
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

$profileMessagesObj=$db->getProfileMessagesForUser($curprofileid);
if($curprofileid == $userid){viewProfileHead($username,$profilePicturePath);}
else { viewOtherProfileHead($username,$profilePicturePath);}

viewBodyProfile($profileMessagesObj,$db,$curprofileid);

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

function viewOtherProfileHead($username,$profilePicturePath)
{
   echo "<div id = 'profileHead'>";
   echo         "<figure>";
   echo             "<img id = 'profileImg' src = '".$profilePicturePath."'>";
   echo             "<figcaption >".$username."</figcaption>";
   echo         "</figure>";
   echo     "</div>";
}

function viewBodyProfile($profileMessagesObj,$db,$curprofileid)
{

    ?>
    <div id="commentBox">
        <form role="form" method="POST" action="proceedmessage.php">
            <input type="hidden" value="<?php echo $curprofileid ?>" name="profileid" />
            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Comment profile</button>
        </form>
        <br><br>
        <?php
        echo "<p><span class='badge'>".sizeof($profileMessagesObj)."</span> Messages:</p><br>";
        echo "<div class='row'>";

            function toonAlleMessages($profileMessagesObj,$db)
            {
                foreach ($profileMessagesObj as $obj){
                    $profilePictureObj=$db->getPictureForUser($obj->senderid);
                    $userObj=$db->getUserFromID($obj->senderid);
                    toonProfileMessage($userObj->username,$profilePictureObj->filepath,$obj->timestamp,$obj->message);
                }
            }

            function toonProfileMessage($username,$userPicture,$datePostedComment,$postedProfileMessage)
            {
                echo     "<div>";
                echo         "<div class='col-sm-2 text-center'>";
                echo             "<img src='".$userPicture."' class='img-circle' height='65' width='65' alt='Avatar'>";
                echo         "</div>";
                echo         "<div class='col-sm-10'>";
                echo             "<h4> ".$username." <small>".$datePostedComment."</small></h4>";
                echo             "<p>".$postedProfileMessage."</p>";
                echo             "<br>";
                echo         "</div>";
                echo     "</div>";
            }
            toonAlleMessages($profileMessagesObj,$db);
            ?>
        </div>
    </div>
    <?php
}
output::pageend();