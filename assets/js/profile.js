/**
 * Created by massi on 24/10/2017.
 */



var showUploadForm=function ()
{

    $('#upload').removeClass("hide");
};

var hideUploadForm=function ()
{
    $('#upload').addClass("hide");
};

$( document ).ready(function() {
    console.log( "ready!" );
    $('a#profilePicture').on("click",showUploadForm);
    $('#uploadbtn').on("click",hideUploadForm);
});