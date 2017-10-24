/**
 * Created by massi on 24/10/2017.
 */

$( document ).ready(function() {
    console.log( "ready!" );
    $('#uploadbtn').on("click",hideUploadForm)
});

var hideUploadForm=function ()
{
    $('#upload').removeClass("hide");
};