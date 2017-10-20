<?php
 class output
 {
    public static function navigation($activepage,$loggedin,$role){
           
            <div class="col-sm-3 sidenav"><h4>CCCP chat</h4><ul class="nav nav-pills nav-stacked">
           
           
           if($activepage){$result += 'class="active"'}
           
                <li><a href="#">Chat</a></li>
                <li><a href="#">Members</a></li>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">Featback</a></li>
                <li><a href="#">Admins</a></li>
                </ul><br>
            </div>
            ?>
                        <div class="col-sm-9">
                    <?php
    }

    public static function htmlheader(){
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Bootstrap Example</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/main.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            </head>
            <body>
                <div class="container-fluid">
                    <div class="row content">
        <?php
    }


    public static function pageend(){
        ?>
                        </div>

                    </div>
                </div>
            <footer class="container-fluid">
                <p>Honeypot site, group 17</p>
            </footer>
            </body>
            </html>
        <?php
    }

 }