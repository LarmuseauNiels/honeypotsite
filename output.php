<?php
 class output
 {
    public static function navigation($activepage,$loggedin,$role){
        echo '<div class="col-sm-3 sidenav"><h4>CCCP chat</h4><ul class="nav nav-pills nav-stacked">';
           
          if(!$loggedin){
                echo "<li";
                if($activepage == 'loggin'){echo '  class="active" ';}
                echo '><a href="#">loggin</a></li>';
           }
           else{   
                echo "<li";
                if($activepage == 'profile'){echo '  class="active" ';}
                echo '><a href="#">profile</a></li>';
           }

           $tabs = array("1"=>"chat", "2"=>"members", "3"=>"feadback");
           foreach($tabs as $x => $dis) {
                echo "<li";
                if($activepage == $dis){echo '  class="active" ';}
                echo '><a href="'.$x.'">'.$dis.'</a></li>';
            }
            
            if($role == 'a'){
                echo "<li";
                if($activepage == 'admin'){echo '  class="active" ';}
                echo '><a href="#">admin</a></li>';
            }
            ?>
                                </ul><br>
                            </div>
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