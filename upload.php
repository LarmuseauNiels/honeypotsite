<?php
/**
 * Created by PhpStorm.
 * User: massi
 * Date: 24/10/2017
 * Time: 21:57
 */
session_start();
require_once 'autoloader.php';
if(isset($_POST['submit']))
{
    $file=$_FILES['file']; // file var die ALLE info hierin opslaat in een array
    //echo "<script>console.log('$file')</script>";
    $fileName =$_FILES['file']['name'];
    $fileTmpName =$_FILES['file']['tmp_name'];
    $fileSize =$_FILES['file']['size'];
    $fileError =$_FILES['file']['error'];
    $fileType =$_FILES['file']['type'];

    $fileExt = explode('.', $fileName); // neemt een extensie vd file
    $fileActualExt = strtolower(end($fileExt)); // extensie vd file lowercase maken

    $allowed = array('jpg','jpeg','png'); //controle op welke files toegelaten zijn op extensie

    // controle process
    if(in_array($fileActualExt, $allowed))
    {
        if($fileError===0) // aantal errors bepalen
        {
            if($fileSize<1000000) // maximum grootte vd file bepalen in kb
            {
                $fileNameNew=uniqid('', true).".".$fileActualExt; // de filenaam maken met een unique id+extensie
                $fileDestenation = 'uploads/'.$fileNameNew; // waar de file moet worden upgeload
                move_uploaded_file($fileTmpName,$fileDestenation); // de file wordt nu geupload naar waar hij moet
                // de tijdelijke plaats van de file wordt naar de eindbestemming gebracht
                header("Location: profile.php?uploadsucces");
            }
            else
            {
                echo "Your file is too big!";
            }

        }
        echo "There was an error uploading your file";

    }
    else
    {
        echo "You cannot upload files of this type!";
    }
}