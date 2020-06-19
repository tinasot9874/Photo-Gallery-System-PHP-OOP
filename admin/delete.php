<?php

 require_once ("core/init.php");
if (!$session->is_signed_in()){redirect("login.php"); return false;}

// DELETE PHOTO
if (isset($_GET['photo'])){
    $photo = Photo::find_by_id($_GET['photo']);
    if ($photo){
        $photo->delete();
        redirect('photos.php');
    }else{
        redirect('photos.php');
    }
}

if (isset($_GET['cate'])){
    $cate = Category::find_by_id($_GET['cate']);
    if ($cate){
        $cate->delete();
        redirect('categories.php');
    }else{
        redirect('categories.php');
    }
}