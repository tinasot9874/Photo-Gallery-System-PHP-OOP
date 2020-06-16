<?php

 require_once ("core/init.php");
if (!$session->is_signed_in()){redirect("login.php"); return false;}

// DELETE PHOTO
if (isset($_GET['photo'])){
    $photo = Photo::find_by_id($_GET['photo']);
    if ($photo){
        echo "<pre>";
        print_r($photo);
        echo "</pre>";
        $photo->delete();

        redirect('photos.php');
    }else{
        redirect('photos.php');
    }
}